<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();

        return view('dashboard.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string',
            'hero_description' => 'required|string',
            'periode_pengurus' => 'required|string|max:100',
            'hero_image' => 'nullable|custom_image|max:2048',
            'hero_video' => 'nullable|file|mimes:mp4,webm,ogg|max:10240', // Max 10MB
        ]);

        // Save simple texts
        Setting::updateOrCreate(['key' => 'hero_title'], ['value' => $request->hero_title]);
        Setting::updateOrCreate(['key' => 'hero_description'], ['value' => $request->hero_description]);
        Setting::updateOrCreate(['key' => 'periode_pengurus'], ['value' => $request->periode_pengurus]);

        // Handle Image Upload
        if ($request->hasFile('hero_image')) {
            $oldImage = Setting::getValue('hero_image');
            $imagePath = $this->imageService->uploadAndConvert($request->file('hero_image'), 'uploads/settings', $oldImage);
            if ($imagePath) {
                Setting::updateOrCreate(['key' => 'hero_image'], ['value' => $imagePath]);
            }
        }

        // Handle Video Upload
        if ($request->hasFile('hero_video')) {
            $oldVideo = Setting::getValue('hero_video');
            if ($oldVideo && File::exists(public_path($oldVideo))) {
                File::delete(public_path($oldVideo));
            }

            $videoFile = $request->file('hero_video');
            $uploadFolder = 'uploads/settings';
            $uploadPath = public_path($uploadFolder);

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $extension = $videoFile->getClientOriginalExtension();
            $videoName = 'hero_video_' . Str::random(10) . '.' . strtolower($extension);
            $videoFile->move($uploadPath, $videoName);

            Setting::updateOrCreate(['key' => 'hero_video'], ['value' => $uploadFolder . '/' . $videoName]);
        }

        // Clear homepage cache
        Cache::forget('home_data');

        return redirect()->back()->with('success', 'Pengaturan web berhasil diperbarui!');
    }
}
