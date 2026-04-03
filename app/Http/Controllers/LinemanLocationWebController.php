<?php

namespace App\Http\Controllers;

use App\Models\LinemanLocation;
use Illuminate\Http\JsonResponse;

class LinemanLocationWebController extends Controller
{
    public function index(): JsonResponse
    {
        $locations = LinemanLocation::with([
                'user:id,name,subcontractor_id,team_id,subcon_role',
                'user.subcon:id,name',
                'user.team:id,team_name',
            ])
            ->orderByDesc('last_seen_at')
            ->get()
            ->map(fn ($loc) => [
                'user_id'      => $loc->user_id,
                'name'         => $loc->user?->name ?? 'Lineman',
                'subcon'       => $loc->user?->subcon?->name ?? null,
                'team'         => $loc->user?->team?->team_name ?? null,
                'role'         => $loc->user?->subcon_role ?? 'lineman',
                'photo_url'    => null,
                'latitude'     => (float) $loc->latitude,
                'longitude'    => (float) $loc->longitude,
                'last_seen_at' => $loc->last_seen_at?->toIso8601String(),
            ]);

        return response()->json($locations);
    }
}
