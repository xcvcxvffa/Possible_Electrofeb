<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\MediaFile;
use App\Models\MediaFolder;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected MediaService $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $query = MediaFile::with(['folder', 'uploader']);

        // Fix: treat empty string as null
        $folderId = $request->filled('folder_id') ? $request->folder_id : null;

        // If filtering by type or searching, make it global across all folders
        if ($request->filled('type') || $request->filled('search')) {
            if ($request->filled('type')) {
                $query->where('file_type', $request->type);
            }
        } else {
            // Otherwise restrict to current folder
            if ($folderId) {
                $query->where('folder_id', $folderId);
            } else {
                $query->whereNull('folder_id');
            }
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('original_name', 'like', '%' . $request->search . '%')
                  ->orWhere('file_name', 'like', '%' . $request->search . '%')
                  ->orWhere('extension', 'like', '%' . $request->search . '%');
            });
        }

        $sort  = in_array($request->get('sort'), ['created_at', 'file_size', 'original_name']) ? $request->get('sort') : 'created_at';
        $order = $request->get('order', 'desc') === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sort, $order);

        $files = $query->paginate(24)->withQueryString();

        // Sidebar shows ALL folders, we will build a tree.
        $allFolders = MediaFolder::with('parent')->orderBy('name')->get();
        $folders = $allFolders->whereNull('parent_id');

        // To render an infinite tree easily, we can just build a hierarchical array or use relations.
        // But since we just fetched all folders, we can manually map their children:
        foreach ($allFolders as $f) {
            $f->setRelation('children', collect());
        }
        foreach ($allFolders as $f) {
            if ($f->parent_id) {
                $parent = $allFolders->firstWhere('id', $f->parent_id);
                if ($parent) {
                    $parent->children->push($f);
                }
            }
        }
        $stats = [
            'total'     => MediaFile::count(),
            'images'    => MediaFile::where('file_type', 'image')->count(),
            'documents' => MediaFile::where('file_type', 'document')->count(),
            'videos'    => MediaFile::where('file_type', 'video')->count(),
            'storage'   => MediaFile::sum('file_size') ?? 0,
        ];

        // Fetch folders for the current directory (for grid display)
        $currentFoldersQuery = \App\Models\MediaFolder::query();
        if ($folderId) {
            $currentFoldersQuery->where('parent_id', $folderId);
        } else {
            $currentFoldersQuery->whereNull('parent_id');
        }
        if ($request->filled('search')) {
            $currentFoldersQuery->where('name', 'like', '%' . $request->search . '%');
        }
        $currentFolders = $request->filled('type') ? collect() : $currentFoldersQuery->orderBy('name')->get();

        $activeFolder = null;
        $breadcrumbs = [];
        if ($folderId) {
            $activeFolder = \App\Models\MediaFolder::find($folderId);
            $curr = $activeFolder;
            while ($curr) {
                array_unshift($breadcrumbs, $curr);
                $curr = $curr->parent;
            }
        }

        return view('admin.media.index', compact('files', 'folders', 'stats', 'currentFolders', 'activeFolder', 'breadcrumbs', 'allFolders'));
    }

    public function store(StoreMediaRequest $request)
    {
        try {
            $folderId = $request->filled('folder_id') ? $request->folder_id : null;

            if (!$folderId && $request->filled('folder_name')) {
                $folderName = trim($request->folder_name);
                $folder = \App\Models\MediaFolder::firstOrCreate([
                    'name' => $folderName,
                    'parent_id' => null,
                ]);
                $folderId = $folder->id;
            }

            $uploadedFiles = [];
            foreach ($request->file('files') as $file) {
                $uploadedFiles[] = $this->mediaService->upload($file, $folderId);
            }

            return response()->json([
                'success' => true,
                'message' => count($uploadedFiles) . ' file(s) uploaded successfully.',
                'files'   => $uploadedFiles,
            ]);
        } catch (\Exception $e) {
            \Log::error('Media Upload Error: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateMediaRequest $request, MediaFile $mediaFile)
    {
        $mediaFile->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'File details updated.',
            'file'    => $mediaFile,
        ]);
    }

    public function destroy(MediaFile $mediaFile)
    {
        $this->mediaService->delete($mediaFile);

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully.',
        ]);
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);

        $files = MediaFile::whereIn('id', $request->ids)->get();
        foreach ($files as $file) {
            $this->mediaService->delete($file);
        }

        return response()->json([
            'success' => true,
            'message' => count($files) . ' file(s) deleted.',
        ]);
    }

    public function move(Request $request, MediaFile $mediaFile)
    {
        $request->validate([
            'folder_id' => 'nullable|exists:media_folders,id',
        ]);

        $mediaFile->update([
            'folder_id' => $request->filled('folder_id') ? $request->folder_id : null,
        ]);

        $destination = $request->filled('folder_id')
            ? \App\Models\MediaFolder::find($request->folder_id)?->name ?? 'folder'
            : 'Root';

        return response()->json([
            'success' => true,
            'message' => "File moved to \"{$destination}\" successfully.",
        ]);
    }

    public function bulkMove(Request $request)
    {
        $request->validate([
            'ids'       => 'required|array',
            'ids.*'     => 'integer',
            'folder_id' => 'nullable|exists:media_folders,id',
        ]);

        $folderId = $request->filled('folder_id') ? $request->folder_id : null;

        MediaFile::whereIn('id', $request->ids)->update(['folder_id' => $folderId]);

        $destination = $folderId
            ? \App\Models\MediaFolder::find($folderId)?->name ?? 'folder'
            : 'Root';

        return response()->json([
            'success' => true,
            'message' => count($request->ids) . " file(s) moved to \"{$destination}\".",
        ]);
    }
}
