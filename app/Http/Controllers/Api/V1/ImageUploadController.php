<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\InventoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'entity_type' => 'required|in:alat,kegiatan',
            'entity_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('inventory', 'public');
            $url = asset('storage/' . $path);

            $inventoryImage = InventoryImage::create([
                'entity_type' => $request->entity_type,
                'entity_id' => $request->entity_id,
                'image_url' => $url
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'data' => [
                    'image_url' => $url,
                    'record' => $inventoryImage
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No image file provided',
            'data' => null
        ], 400);
    }
}
