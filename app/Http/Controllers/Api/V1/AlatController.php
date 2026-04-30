<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with(['images'])->get();
        return response()->json([
            'success' => true,
            'message' => 'List of equipment',
            'data' => $alats
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category' => 'nullable|string',
            'total_qty' => 'required|integer|min:0',
            'condition' => 'in:good,damaged'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $alat = Alat::create([
            'name' => $request->name,
            'category' => $request->category,
            'total_qty' => $request->total_qty,
            'available_qty' => $request->total_qty, // Initially all are available
            'condition' => $request->condition ?? 'good',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Equipment created',
            'data' => $alat
        ], 201);
    }

    public function show($id)
    {
        $alat = Alat::with(['images'])->find($id);
        if (!$alat) {
            return response()->json([
                'success' => false,
                'message' => 'Equipment not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Equipment detail',
            'data' => $alat
        ]);
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::find($id);
        if (!$alat) {
            return response()->json([
                'success' => false,
                'message' => 'Equipment not found',
                'data' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'category' => 'string',
            'total_qty' => 'integer|min:0',
            'condition' => 'in:good,damaged'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        // If total_qty is updated, we need to adjust available_qty
        if ($request->has('total_qty')) {
            $diff = $request->total_qty - $alat->total_qty;
            $alat->available_qty += $diff;
        }

        $alat->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Equipment updated',
            'data' => $alat
        ]);
    }

    public function destroy($id)
    {
        $alat = Alat::find($id);
        if (!$alat) {
            return response()->json([
                'success' => false,
                'message' => 'Equipment not found',
                'data' => null
            ], 404);
        }

        $alat->delete();
        return response()->json([
            'success' => true,
            'message' => 'Equipment deleted',
            'data' => null
        ]);
    }
}
