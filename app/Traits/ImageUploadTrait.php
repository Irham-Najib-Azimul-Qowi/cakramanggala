<?php

namespace App\Traits;

use App\Services\ImageService;

trait ImageUploadTrait
{
    /**
     * Upload and convert image using ImageService
     */
    public function uploadAndConvert($file, $folder, $oldFile = null)
    {
        return resolve(ImageService::class)->uploadAndConvert($file, $folder, $oldFile);
    }
}
