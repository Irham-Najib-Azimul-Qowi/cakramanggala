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
        return view('dashboard.pengurus.index', compact('penguruses'));
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
