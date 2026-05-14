<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Alat;
use App\Models\KegiatanAlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KegiatanAlatController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'alat_id' => 'required|exists:alat,id',
            'qty' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $kegiatan = Kegiatan::find($request->kegiatan_id);
        $alat = Alat::find($request->alat_id);

        if ($alat->available_qty < $request->qty) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock',
                'data' => [
                    'available' => $alat->available_qty,
                    'requested' => $request->qty
                ]
            ], 400);
        }

        DB::beginTransaction();
        try {
            $kegiatanAlat = KegiatanAlat::create([
                'kegiatan_id' => $request->kegiatan_id,
                'alat_id' => $request->alat_id,
                'qty' => $request->qty
            ]);

            // Only reduce stock if activity is NOT completed
            if ($kegiatan->status !== 'completed') {
                $alat->available_qty -= $request->qty;
                $alat->save();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Tool added to activity',
                'data' => $kegiatanAlat
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function getAlatByKegiatan($id)
    {
        $kegiatan = Kegiatan::with('alats')->find($id);
        if (!$kegiatan) {
            return response()->json([
                'success' => false,
                'message' => 'Activity not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tools for activity ' . $kegiatan->name,
            'data' => $kegiatan->alats
        ]);
    }
}
