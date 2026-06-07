<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\InventoryKegiatan;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = InventoryKegiatan::with(['creator', 'alats', 'images'])->get();
        return response()->json([
            'success' => true,
            'message' => 'List of activities',
            'data' => $kegiatans
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'status' => 'in:draft,ongoing,completed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $createData = [
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'status' => $request->status ?? 'draft',
            'created_by' => auth('api')->id(),
        ];
        if ($request->id) {
            $createData['id'] = $request->id;
        }
        $kegiatan = InventoryKegiatan::create($createData);

        return response()->json([
            'success' => true,
            'message' => 'Activity created',
            'data' => $kegiatan
        ], 201);
    }

    public function show($id)
    {
        $kegiatan = InventoryKegiatan::with(['creator', 'alats', 'images'])->find($id);
        if (!$kegiatan) {
            return response()->json([
                'success' => false,
                'message' => 'Activity not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Activity detail',
            'data' => $kegiatan
        ]);
    }

    public function update(Request $request, $id)
    {
        $kegiatan = InventoryKegiatan::find($id);
        if (!$kegiatan) {
            return response()->json([
                'success' => false,
                'message' => 'Activity not found',
                'data' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'description' => 'string',
            'date' => 'date',
            'status' => 'in:draft,ongoing,completed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $oldStatus = $kegiatan->status;
        $newStatus = $request->status ?? $oldStatus;

        DB::beginTransaction();
        try {
            $kegiatan->update($request->all());

            // Logic: if status changed to completed, restore equipment quantities
            if ($oldStatus !== 'completed' && $newStatus === 'completed') {
                foreach ($kegiatan->alats as $alat) {
                    $alat->available_qty += $alat->pivot->qty;
                    $alat->save();
                }
            }
            // Logic: if status changed FROM completed to something else (e.g. ongoing), reduce quantities again
            else if ($oldStatus === 'completed' && $newStatus !== 'completed') {
                foreach ($kegiatan->alats as $alat) {
                    $alat->available_qty -= $alat->pivot->qty;
                    $alat->save();
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Activity updated',
                'data' => $kegiatan
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating activity: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function destroy($id)
    {
        $kegiatan = InventoryKegiatan::find($id);
        if (!$kegiatan) {
            return response()->json([
                'success' => false,
                'message' => 'Activity not found',
                'data' => null
            ], 404);
        }

        // If not completed, restore equipment quantities before deleting
        if ($kegiatan->status !== 'completed') {
            foreach ($kegiatan->alats as $alat) {
                $alat->available_qty += $alat->pivot->qty;
                $alat->save();
            }
        }

        $kegiatan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Activity deleted',
            'data' => null
        ]);
    }
}
