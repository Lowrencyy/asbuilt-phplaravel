<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PoleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Pole::query();

        if ($request->has('node_id')) {
            $query->where('node_id', $request->node_id);
        }

        return response()->json($query->with('node')->get());
    }

    public function show(Pole $pole): JsonResponse
    {
        return response()->json($pole->load('node'));
    }

    public function spans(Pole $pole): JsonResponse
    {
        return response()->json(
            $pole->outgoingSpans()->with(['toPole'])->get()
        );
    }

    public function updateGps(Request $request, Pole $pole): JsonResponse
    {
        $request->validate([
            'map_latitude'  => 'required|numeric|between:-90,90',
            'map_longitude' => 'required|numeric|between:-180,180',
        ]);

        $pole->update([
            'map_latitude'  => $request->map_latitude,
            'map_longitude' => $request->map_longitude,
        ]);

        return response()->json(['message' => 'GPS coordinates saved.']);
    }
}
