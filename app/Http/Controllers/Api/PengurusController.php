<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PengurusResource;
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
     * Display a listing of pengurus.
     */
    public function index()
    {
        $penguruses = Pengurus::orderBy('urutan')->get();
        return PengurusResource::collection($penguruses);
    }

    /**
     * Store a newly created pengurus.
     */
    public function store(StorePengurusRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->uploadAndConvert($request->file('foto'), 'uploads/pengurus');
        }

        $pengurus = Pengurus::create($validated);

        return new PengurusResource($pengurus);
    }

    /**
     * Display the specified pengurus.
     */
    public function show(Pengurus $pengurus)
    {
        return new PengurusResource($pengurus);
    }

    /**
     * Update the specified pengurus.
     */
    public function update(UpdatePengurusRequest $request, Pengurus $pengurus)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->uploadAndConvert($request->file('foto'), 'uploads/pengurus', $pengurus->foto);
        }

        $pengurus->update($validated);

        return new PengurusResource($pengurus);
    }

    /**
     * Remove the specified pengurus.
     */
    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->foto && File::exists(public_path($pengurus->foto))) {
            File::delete(public_path($pengurus->foto));
        }

        $pengurus->delete();

        return response()->json(['message' => 'Data pengurus berhasil dihapus.']);
    }
}
