<?php

namespace App\Services;

use App\Models\MediaFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function upload(UploadedFile $file, $folderId = null, $isPublic = true)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $fileSize = $file->getSize();
        
        $fileType = $this->determineFileType($mimeType, $extension);
        $subFolder = $this->getSubFolder($fileType);
        
        $folderPrefix = '';
        if ($folderId) {
            $folderObj = \App\Models\MediaFolder::find($folderId);
            if ($folderObj) {
                $safeFolderName = Str::slug($folderObj->name);
                $folderPrefix = "{$safeFolderName}/";
            }
        }
        
        $fileName = Str::uuid() . '.' . $extension;
        $path = $file->storeAs("media/{$folderPrefix}{$subFolder}", $fileName, 'public');

        $mediaData = [
            'file_name' => $fileName,
            'original_name' => $originalName,
            'file_type' => $fileType,
            'mime_type' => $mimeType,
            'extension' => $extension,
            'file_size' => $fileSize,
            'file_path' => $path,
            'folder_id' => $folderId,
            'is_public' => $isPublic,
        ];

        if ($fileType === 'image' && !in_array(strtolower($extension), ['svg', 'ico'])) {
            $imageMetadata = $this->imageService->processImage($file, $path);
            $mediaData = array_merge($mediaData, $imageMetadata);
        }

        return MediaFile::create($mediaData);
    }

    public function delete(MediaFile $mediaFile)
    {
        // Soft delete the database record
        $mediaFile->delete();
        
        return true;
    }

    protected function determineFileType($mimeType, $extension)
    {
        $extension = strtolower($extension);
        
        if (str_starts_with($mimeType, 'image/') || in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico'])) {
            return 'image';
        }
        
        if (str_starts_with($mimeType, 'video/') || in_array($extension, ['mp4', 'webm', 'mov'])) {
            return 'video';
        }
        
        return 'document';
    }

    protected function getSubFolder($fileType)
    {
        return match($fileType) {
            'image' => 'images',
            'video' => 'videos',
            'document' => 'documents',
            default => 'misc'
        };
    }
}
