<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pole;
use App\Models\TeardownLog;
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

        if ($request->filled('search')) {
            $s = '%' . $request->search . '%';
            $query->where('pole_code', 'like', $s);
        }

        return response()->json($query->with('node')->limit(50)->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'node_id'       => 'required|exists:nodes,id',
            'pole_code'     => 'required|string',
            'pole_name'     => 'nullable|string',
            'status'        => 'nullable|string',
            'remarks'       => 'nullable|string',
            'map_latitude'  => 'nullable|numeric|between:-90,90',
            'map_longitude' => 'nullable|numeric|between:-180,180',
            'sitemap_x'     => 'nullable|numeric',
            'sitemap_y'     => 'nullable|numeric',
        ]);

        $untaggedCodes = ['NPT', 'NT'];
        $isUntagged = in_array(strtoupper($validated['pole_code']), $untaggedCodes);

        if ($isUntagged) {
            // NPT/NT: pole_name is required and must be unique per node
            if (empty($validated['pole_name'])) {
                return response()->json(['message' => 'pole_name is required for NPT/NT poles.'], 422);
            }

            $nodeId = $validated['node_id'];
            if (Pole::where('node_id', $nodeId)->where('pole_name', $validated['pole_name'])->exists()) {
                return response()->json(['message' => 'A pole with this name already exists in the node.'], 409);
            }

            // Always insert a new record for untagged poles
            $pole = Pole::create($validated);
            $created = true;
        } else {
            $pole = Pole::updateOrCreate(
                ['node_id' => $validated['node_id'], 'pole_code' => $validated['pole_code']],
                collect($validated)->except(['node_id', 'pole_code'])->all()
            );
            $created = $pole->wasRecentlyCreated;
        }

        return response()->json($pole->load('node'), $created ? 201 : 200);
    }

    public function show(Pole $pole): JsonResponse
    {
        return response()->json($pole->load('node'));
    }

    public function spans(Pole $pole): JsonResponse
    {
        // Outgoing: skip spans that have already been torn down (span status = completed)
        $outgoing = $pole->outgoingSpans()
            ->with(['fromPole', 'toPole'])
            ->where('status', '!=', 'completed')
            ->get();

        // Incoming: skip spans that have already been torn down (span status = completed)
        $incoming = $pole->incomingSpans()
            ->with(['fromPole', 'toPole'])
            ->where('status', '!=', 'completed')
            ->get();

        return response()->json($outgoing->merge($incoming)->unique('id')->values());
    }

    public function completeTeardown(Request $request, Pole $pole): JsonResponse
    {
        // Collect all span IDs connected to this pole (both directions)
        $allSpanIds = $pole->outgoingSpans()->pluck('id')
            ->merge($pole->incomingSpans()->pluck('id'))
            ->unique();

        $totalSpans = $allSpanIds->count();

        // A pole with no spans can never be auto-completed
        if ($totalSpans > 0) {
            // Count distinct spans that have at least one submitted teardown log
            $submittedCount = TeardownLog::whereIn('pole_span_id', $allSpanIds)
                ->where('status', 'submitted')
                ->distinct('pole_span_id')
                ->count('pole_span_id');

            // Only mark completed when every single span is done
            if ($submittedCount >= $totalSpans) {
                $pole->update([
                    'status'       => 'completed',
                    'completed_at' => now(),
                ]);
            } else {
                // Some spans still pending — ensure pole is not stuck as "completed"
                if ($pole->status === 'completed') {
                    $pole->update(['status' => 'active', 'completed_at' => null]);
                }
            }
        } else {
            // No spans assigned yet — revert completed status if somehow set
            if ($pole->status === 'completed') {
                $pole->update(['status' => 'active', 'completed_at' => null]);
            }
        }

        // Return the paired pole (to_pole of the first outgoing span)
        $nextSpan = $pole->outgoingSpans()->with('toPole')->first();
        $nextPole = $nextSpan?->toPole;

        return response()->json([
            'pole'      => $pole->fresh(),
            'next_pole' => $nextPole,
        ]);
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

    public function updateSitemap(Request $request, Pole $pole): JsonResponse
    {
        $request->validate([
            'sitemap_x' => 'required|numeric',
            'sitemap_y' => 'required|numeric',
        ]);

        $pole->update([
            'sitemap_x' => $request->sitemap_x,
            'sitemap_y' => $request->sitemap_y,
        ]);

        return response()->json(['message' => 'Sitemap coordinates saved.']);
    }
}
