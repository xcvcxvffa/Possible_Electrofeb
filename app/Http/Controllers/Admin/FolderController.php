<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFolderRequest;
use App\Models\MediaFolder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function store(StoreFolderRequest $request)
    {
        $folder = MediaFolder::create([
            'name'      => $request->name,
            'parent_id' => $request->filled('parent_id') ? $request->parent_id : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Folder '{$folder->name}' created successfully.",
            'folder'  => $folder,
        ]);
    }

    public function update(Request $request, MediaFolder $mediaFolder)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $mediaFolder->update(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'message' => "Folder renamed to '{$mediaFolder->name}'.",
            'folder'  => $mediaFolder,
        ]);
    }

    public function destroy(MediaFolder $mediaFolder)
    {
        // Move all files in this folder back to root (null)
        $mediaFolder->files()->update(['folder_id' => null]);

        $mediaFolder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Folder deleted. Files moved to root.',
        ]);
    }
}
