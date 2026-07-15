<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnggotaController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggotas = Anggota::orderBy('angkatan', 'desc')->orderBy('nama', 'asc')->get();
        return view('dashboard.anggota.index', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'nia' => 'nullable|string|max:255',
            'angkatan' => 'required|string|max:255',
            'status' => 'required|in:anggota baru,anggota,demisioner,alumni',
            'foto' => 'nullable|custom_image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->uploadAndConvert($request->file('foto'), 'uploads/anggota');
        }

        Anggota::create($validated);

        return redirect()->route('dashboard.anggota.index')->with('success', 'Data anggota berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        return view('dashboard.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'nia' => 'nullable|string|max:255',
            'angkatan' => 'required|string|max:255',
            'status' => 'required|in:anggota baru,anggota,demisioner,alumni',
            'foto' => 'nullable|custom_image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->uploadAndConvert($request->file('foto'), 'uploads/anggota', $anggota->foto);
        }

        $anggota->update($validated);

        return redirect()->route('dashboard.anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        if ($anggota->foto && File::exists(public_path($anggota->foto))) {
            File::delete(public_path($anggota->foto));
        }

        $anggota->delete();

        return redirect()->route('dashboard.anggota.index')->with('success', 'Data anggota berhasil dihapus!');
    }
}
