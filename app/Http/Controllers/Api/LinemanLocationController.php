<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LinemanLocation;
use Illuminate\Http\Request;

class LinemanLocationController extends Controller
{
    /**
     * Mobile app pings live location (upsert — one row per lineman).
     * POST /api/v1/lineman-location
     */
    public function ping(Request $request)
    {
        $data = $request->validate([
            'latitude'  => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        LinemanLocation::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'latitude'     => $data['latitude'],
                'longitude'    => $data['longitude'],
                'last_seen_at' => now(),
            ]
        );

        return response()->json(['success' => true]);
    }

    /**
     * Web dashboard polls all active linemen locations.
     * GET /api/v1/lineman-locations
     */
    public function index()
    {
        $locations = LinemanLocation::with('user:id,name')
            ->orderByDesc('last_seen_at')
            ->get()
            ->map(fn ($loc) => [
                'user_id'      => $loc->user_id,
                'name'         => $loc->user?->name ?? 'Lineman',
                'team'         => null,
                'photo_url'    => null, // extend if you add profile photos
                'latitude'     => (float) $loc->latitude,
                'longitude'    => (float) $loc->longitude,
                'last_seen_at' => $loc->last_seen_at?->toIso8601String(),
            ]);

        return response()->json($locations);
    }
}
