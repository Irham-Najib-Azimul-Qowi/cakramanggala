<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ImageService
{
    /**
     * Upload image - convert to WebP if GD available, otherwise save original.
     */
    public function uploadAndConvert($file, $folder, $oldFile = null)
    {
        try {
            $uploadPath = public_path($folder);

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Delete old file
            if ($oldFile && File::exists(public_path($oldFile))) {
                File::delete(public_path($oldFile));
            }

            // If GD is not available, just move the file directly
            if (!extension_loaded('gd')) {
                $extension = $file->getClientOriginalExtension();
                $safeName = time() . '_' . Str::random(10) . '.' . strtolower($extension);
                $file->move($uploadPath, $safeName);
                return $folder . '/' . $safeName;
            }

            // GD is available — try WebP conversion
            $name = time() . '_' . Str::random(10) . '.webp';
            $fullPath = $uploadPath . '/' . $name;

            $imageInfo = @getimagesize($file);
            if (!$imageInfo) {
                // Not a valid image, just move it
                $extension = $file->getClientOriginalExtension();
                $safeName = time() . '_' . Str::random(10) . '.' . strtolower($extension);
                $file->move($uploadPath, $safeName);
                return $folder . '/' . $safeName;
            }

            $mime = $imageInfo['mime'];
            $image = null;

            switch ($mime) {
                case 'image/jpeg':
                    $image = @imagecreatefromjpeg($file);
                    break;
                case 'image/png':
                    $image = @imagecreatefrompng($file);
                    if ($image) {
                        imagepalettetotruecolor($image);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                    }
                    break;
                case 'image/gif':
                    $image = @imagecreatefromgif($file);
                    break;
                case 'image/webp':
                    $image = @imagecreatefromwebp($file);
                    break;
            }

            if ($image && function_exists('imagewebp')) {
                imagewebp($image, $fullPath, 80);
                imagedestroy($image);
                return $folder . '/' . $name;
            }

            if ($image) {
                imagedestroy($image);
            }

            // Fallback: save original file
            $extension = $file->getClientOriginalExtension();
            $safeName = time() . '_' . Str::random(10) . '.' . strtolower($extension);
            $file->move($uploadPath, $safeName);
            return $folder . '/' . $safeName;

        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());

            // Ultimate fallback
            try {
                $extension = $file->getClientOriginalExtension();
                $safeName = time() . '_' . Str::random(10) . '.' . strtolower($extension);
                $file->move(public_path($folder), $safeName);
                return $folder . '/' . $safeName;
            } catch (\Exception $e2) {
                Log::error('Image fallback also failed: ' . $e2->getMessage());
                return null;
            }
        }
    }
}
