<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\StorePengurusRequest;
use App\Http\Requests\UpdatePengurusRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PengurusController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penguruses = Pengurus::orderBy('urutan')->get();
        $periode = \App\Models\Setting::getValue('periode_pengurus', 'PERIODE 2024 — 2025');
        $banner = \App\Models\Setting::getValue('banner_pengurus');
        return view('dashboard.pengurus.index', compact('penguruses', 'periode', 'banner'));
    }

    /**
     * Update active period and banner image for officer page.
     */
    public function updateQuickSettings(Request $request)
    {
        $request->validate([
            'periode_pengurus' => 'required|string|max:100',
            'banner_pengurus' => 'nullable|custom_image|max:2048',
        ]);

        \App\Models\Setting::updateOrCreate(
            ['key' => 'periode_pengurus'],
            ['value' => $request->periode_pengurus]
        );

        if ($request->hasFile('banner_pengurus')) {
            $oldBanner = \App\Models\Setting::getValue('banner_pengurus');
            $bannerPath = $this->uploadAndConvert($request->file('banner_pengurus'), 'uploads/settings', $oldBanner);
            if ($bannerPath) {
                \App\Models\Setting::updateOrCreate(
                    ['key' => 'banner_pengurus'],
                    ['value' => $bannerPath]
                );
            }
        }

        // Clear cache
        \Illuminate\Support\Facades\Cache::forget('home_data');

        return redirect()->route('dashboard.pengurus.index')->with('success', 'Pengaturan banner dan periode pengurus berhasil diperbarui!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengurus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengurusRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->uploadAndConvert($request->file('foto'), 'uploads/pengurus');
        }

        Pengurus::create($validated);

        return redirect()->route('dashboard.pengurus.index')->with('success', 'Data pengurus berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengurus $penguru)
    {
        return view('dashboard.pengurus.edit', ['pengurus' => $penguru]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengurusRequest $request, Pengurus $penguru)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->uploadAndConvert($request->file('foto'), 'uploads/pengurus', $penguru->foto);
        }

        $penguru->update($validated);

        return redirect()->route('dashboard.pengurus.index')->with('success', 'Data pengurus berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengurus $penguru)
    {
        if ($penguru->foto && File::exists(public_path($penguru->foto))) {
            File::delete(public_path($penguru->foto));
        }

        $penguru->delete();

        return redirect()->route('dashboard.pengurus.index')->with('success', 'Data pengurus berhasil dihapus!');
    }
}
