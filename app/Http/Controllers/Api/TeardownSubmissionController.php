<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeardownLog;
use App\Models\TeardownSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TeardownSubmissionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = TeardownSubmission::with(['project', 'node'])
            ->orderByDesc('report_date')
            ->orderByDesc('created_at');

        if ($request->has('node_id')) {
            $query->where('node_id', $request->node_id);
        }
        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        return response()->json($query->get());
    }

    public function show(TeardownSubmission $teardownSubmission): JsonResponse
    {
        return response()->json(
            $teardownSubmission->load([
                'project',
                'node',
                'items.teardownLog.poleSpan.fromPole',
                'items.teardownLog.poleSpan.toPole',
                'items.teardownLog.images',
                'remarks',
            ])
        );
    }

    public function remarks(TeardownSubmission $teardownSubmission): JsonResponse
    {
        return response()->json(
            $teardownSubmission->remarks()->latest()->get()
        );
    }

    /**
     * Auto-fill totals from teardown_logs for a given node + date.
     * GET /api/v1/teardown-submissions/autofill?node_id=X&date=Y
     */
    public function autoFill(Request $request): JsonResponse
    {
        $request->validate([
            'node_id' => 'required|integer|exists:nodes,id',
            'date'    => 'nullable|date',
        ]);

        $date = $request->date ? Carbon::parse($request->date)->toDateString() : today()->toDateString();

        $logs = TeardownLog::where('node_id', $request->node_id)
            ->whereDate('finished_at', $date)
            ->get();

        // If no finished_at logs, fall back to synced_at_server date
        if ($logs->isEmpty()) {
            $logs = TeardownLog::where('node_id', $request->node_id)
                ->whereDate('synced_at_server', $date)
                ->get();
        }

        // Sum strand from pole_spans.length_meters for all spans torn down
        $spanIds = $logs->pluck('pole_span_id')->filter()->unique()->values()->all();
        $totalStrand = 0;
        if (!empty($spanIds)) {
            $totalStrand = \App\Models\PoleSpan::whereIn('id', $spanIds)->sum('length_meters');
        }

        return response()->json([
            'date'                    => $date,
            'total_cable'             => (float) $logs->sum('collected_cable'),
            'total_strand_length'     => (float) $totalStrand,
            'total_node'              => (int) $logs->sum('collected_node'),
            'total_amplifier'         => (int) $logs->sum('collected_amplifier'),
            'total_extender'          => (int) $logs->sum('collected_extender'),
            'total_tsc'               => (int) $logs->sum('collected_tsc'),
            'total_powersupply'       => (int) $logs->sum('collected_powersupply'),
            'total_powersupply_housing' => (int) $logs->sum('collected_powersupply_housing'),
            'log_count'               => $logs->count(),
        ]);
    }

    /**
     * Create or update a daily report draft.
     * POST /api/v1/teardown-submissions
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'node_id'                   => 'required|integer|exists:nodes,id',
            'project_id'                => 'required|integer|exists:projects,id',
            'report_date'               => 'nullable|date',
            'total_cable'               => 'nullable|numeric|min:0',
            'total_strand_length'       => 'nullable|numeric|min:0',
            'total_node'                => 'nullable|integer|min:0',
            'total_amplifier'           => 'nullable|integer|min:0',
            'total_extender'            => 'nullable|integer|min:0',
            'total_tsc'                 => 'nullable|integer|min:0',
            'total_powersupply'         => 'nullable|integer|min:0',
            'total_powersupply_housing' => 'nullable|integer|min:0',
            'item_status'               => 'nullable|string',
            'warehouse_location'        => 'nullable|string|max:255',
        ]);

        $reportDate = isset($data['report_date'])
            ? Carbon::parse($data['report_date'])->toDateString()
            : today()->toDateString();

        // One submission per node per date — upsert
        $submission = TeardownSubmission::firstOrNew([
            'node_id'     => $data['node_id'],
            'report_date' => $reportDate,
        ]);

        // Block only fully approved reports; allow updating submitted/rework ones
        // (lineman may do more spans after first submission on the same day)
        $locked = ['telcovantage_approved', 'pm_approved'];
        if ($submission->exists && in_array($submission->status, $locked)) {
            return response()->json(['message' => 'Report is already approved and cannot be edited.'], 422);
        }

        // If previously submitted to PM, reset to draft so lineman can re-submit
        // with the new updated totals (autofill always provides cumulative totals)
        $wasSubmitted = $submission->exists && $submission->status === 'submitted_to_pm';

        $submission->fill([
            'project_id'                => $data['project_id'],
            'report_date'               => $reportDate,
            'total_cable'               => $data['total_cable']               ?? $submission->total_cable               ?? 0,
            'total_strand_length'       => $data['total_strand_length']       ?? $submission->total_strand_length       ?? 0,
            'total_node'                => $data['total_node']                ?? $submission->total_node                ?? 0,
            'total_amplifier'           => $data['total_amplifier']           ?? $submission->total_amplifier           ?? 0,
            'total_extender'            => $data['total_extender']            ?? $submission->total_extender            ?? 0,
            'total_tsc'                 => $data['total_tsc']                 ?? $submission->total_tsc                 ?? 0,
            'total_powersupply'         => $data['total_powersupply']         ?? $submission->total_powersupply         ?? 0,
            'total_powersupply_housing' => $data['total_powersupply_housing'] ?? $submission->total_powersupply_housing ?? 0,
            'item_status'               => $data['item_status']               ?? $submission->item_status               ?? 'onfield',
            'warehouse_location'        => $data['warehouse_location']        ?? $submission->warehouse_location,
            'status'                    => $wasSubmitted ? 'draft' : ($submission->status ?: 'draft'),
            'entry_mode'                => 'reported',
        ]);

        $submission->save();

        return response()->json($submission->load(['project', 'node']), $submission->wasRecentlyCreated ? 201 : 200);
    }

    /**
     * Submit report to PM.
     * POST /api/v1/teardown-submissions/{id}/submit
     */
    public function submit(TeardownSubmission $teardownSubmission, Request $request): JsonResponse
    {
        if (! in_array($teardownSubmission->status, ['draft', 'pm_for_rework'])) {
            return response()->json(['message' => 'Report is already submitted.'], 422);
        }

        $teardownSubmission->update([
            'status'       => 'submitted_to_pm',
            'submitted_by' => $request->user()->name,
            'submitted_at' => now(),
            'item_status'  => 'ready_for_delivery',
        ]);

        return response()->json($teardownSubmission->fresh(['project', 'node']));
    }
}
