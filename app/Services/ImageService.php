<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ImageService
{
    protected ?ImageManager $manager = null;
    protected bool $driverAvailable = false;
    protected string $driverName = 'none';

    public function __construct()
    {
        $this->initializeDriver();
    }

    /**
     * Detect and initialize the best available image driver.
     * Priority: GD → Imagick → None (graceful fallback)
     */
    protected function initializeDriver(): void
    {
        // Try GD first
        if (extension_loaded('gd') && function_exists('gd_info')) {
            try {
                $driver = new \Intervention\Image\Drivers\Gd\Driver();
                $this->manager = new ImageManager($driver);
                $this->driverAvailable = true;
                $this->driverName = 'GD';
                return;
            } catch (\Exception $e) {
                Log::warning('GD driver failed to initialize: ' . $e->getMessage());
            }
        }

        // Try Imagick as fallback
        if (extension_loaded('imagick') && class_exists('Imagick')) {
            try {
                $driver = new \Intervention\Image\Drivers\Imagick\Driver();
                $this->manager = new ImageManager($driver);
                $this->driverAvailable = true;
                $this->driverName = 'Imagick';
                return;
            } catch (\Exception $e) {
                Log::warning('Imagick driver failed to initialize: ' . $e->getMessage());
            }
        }

        // No driver available — graceful fallback
        $this->driverAvailable = false;
        $this->driverName = 'none';
        Log::warning(
            'ImageService: No image driver (GD or Imagick) is available in the web context. ' .
            'Thumbnail generation will be skipped. ' .
            'To fix: Enable the GD extension in XAMPP → php.ini (Apache), then restart Apache.'
        );
    }

    /**
     * Process an uploaded image: extract dimensions and generate thumbnail.
     * Returns null values gracefully if no driver is available.
     */
    public function processImage(UploadedFile $file, string $originalPath): array
    {
        // Graceful fallback — no driver available
        if (!$this->driverAvailable || $this->manager === null) {
            return [
                'width'          => null,
                'height'         => null,
                'thumbnail_path' => null,
            ];
        }

        try {
            $image = $this->manager->read($file->getPathname());

            $width  = $image->width();
            $height = $image->height();

            $thumbnailPath = $this->generateThumbnail($image, $file);

            return [
                'width'          => $width,
                'height'         => $height,
                'thumbnail_path' => $thumbnailPath,
            ];
        } catch (\Exception $e) {
            Log::error('Image Processing Failed: ' . $e->getMessage());
            return [
                'width'          => null,
                'height'         => null,
                'thumbnail_path' => null,
            ];
        }
    }

    /**
     * Generate a 300×300 thumbnail and save to storage.
     */
    protected function generateThumbnail($image, UploadedFile $file): ?string
    {
        try {
            // Clone the image object to avoid mutating the original
            $thumb = $this->manager->read($file->getPathname());
            $thumb->scaleDown(width: 300, height: 300);

            $ext      = strtolower($file->getClientOriginalExtension());
            $fileName = Str::uuid() . '-thumb.' . $ext;
            $path     = "media/thumbnails/{$fileName}";

            $encoded = $thumb->encodeByExtension($ext);
            Storage::disk('public')->put($path, (string) $encoded);

            return $path;
        } catch (\Exception $e) {
            Log::error('Thumbnail Generation Failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Check if an image driver is available.
     */
    public function isDriverAvailable(): bool
    {
        return $this->driverAvailable;
    }

    /**
     * Get the name of the driver currently in use.
     */
    public function getDriverName(): string
    {
        return $this->driverName;
    }
}
