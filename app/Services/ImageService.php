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

            $extension = strtolower($file->getClientOriginalExtension());
            $name = time() . '_' . Str::random(10) . '.webp';
            $fullPath = $uploadPath . '/' . $name;

            // Priority 1: Imagick conversion (robust, supports HEIC, JPEG, PNG, WebP)
            if (class_exists('Imagick')) {
                try {
                    $imagick = new \Imagick();
                    $imagick->readImage($file->getRealPath());
                    
                    // Auto-orient based on EXIF metadata (critical for phone portrait uploads)
                    try {
                        $orientation = $imagick->getImageOrientation();
                        switch ($orientation) {
                            case \Imagick::ORIENTATION_BOTTOMRIGHT: // 3
                                $imagick->rotateImage(new \ImagickPixel('none'), 180);
                                break;
                            case \Imagick::ORIENTATION_RIGHTTOP: // 6
                                $imagick->rotateImage(new \ImagickPixel('none'), 90);
                                break;
                            case \Imagick::ORIENTATION_LEFTBOTTOM: // 8
                                $imagick->rotateImage(new \ImagickPixel('none'), -90);
                                break;
                            case \Imagick::ORIENTATION_TOPRIGHT: // 2
                                $imagick->flopImage();
                                break;
                            case \Imagick::ORIENTATION_BOTTOMLEFT: // 4
                                $imagick->flipImage();
                                break;
                            case \Imagick::ORIENTATION_LEFTTOP: // 5
                                $imagick->rotateImage(new \ImagickPixel('none'), 90);
                                $imagick->flopImage();
                                break;
                            case \Imagick::ORIENTATION_RIGHTBOTTOM: // 7
                                $imagick->rotateImage(new \ImagickPixel('none'), -90);
                                $imagick->flopImage();
                                break;
                        }
                        $imagick->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
                    } catch (\Exception $ex) {
                        Log::warning('Failed to auto-orient image via Imagick: ' . $ex->getMessage());
                    }
                    
                    $imagick->setImageFormat('webp');
                    $imagick->setImageCompressionQuality(80);
                    $imagick->writeImage($fullPath);
                    $imagick->clear();
                    $imagick->destroy();
                    return $folder . '/' . $name;
                } catch (\Exception $e) {
                    Log::warning('Imagick conversion failed: ' . $e->getMessage() . '. Falling back to GD.');
                }
            }

            // Priority 2: GD conversion (standard fallback)
            if (extension_loaded('gd')) {
                $imageInfo = @getimagesize($file);
                if ($imageInfo) {
                    $mime = $imageInfo['mime'];
                    $image = null;

                    switch ($mime) {
                        case 'image/jpeg':
                            $image = @imagecreatefromjpeg($file);
                            if ($image && function_exists('exif_read_data')) {
                                try {
                                    $exif = @exif_read_data($file);
                                    if (!empty($exif['Orientation'])) {
                                        switch ($exif['Orientation']) {
                                            case 3:
                                                $image = imagerotate($image, 180, 0);
                                                break;
                                            case 6:
                                                $image = imagerotate($image, -90, 0);
                                                break;
                                            case 8:
                                                $image = imagerotate($image, 90, 0);
                                                break;
                                        }
                                    }
                                } catch (\Exception $e) {}
                            }
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
                }
            }

            // Priority 3: Save original file as final fallback
            $safeName = time() . '_' . Str::random(10) . '.' . $extension;
            $file->move($uploadPath, $safeName);
            return $folder . '/' . $safeName;

        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());

            // Ultimate fallback
            try {
                $extension = strtolower($file->getClientOriginalExtension());
                $safeName = time() . '_' . Str::random(10) . '.' . $extension;
                $file->move(public_path($folder), $safeName);
                return $folder . '/' . $safeName;
            } catch (\Exception $e2) {
                Log::error('Image fallback also failed: ' . $e2->getMessage());
                return null;
            }
        }
    }
}
