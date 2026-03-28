<?php

namespace Database\Seeders;

use App\Models\TeardownLog;
use App\Models\TeardownSubmission;
use App\Models\TeardownSubmissionItem;
use App\Models\WarehouseReceipt;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeardownDailyReportSeeder extends Seeder
{
    public function run(): void
    {
        // ── Existing data ─────────────────────────────────────────────────────
        $projectId  = 1;        // SKY CABLE
        $nodeId     = 2;        // TAYTAY:1104
        $linemanId  = 1;        // Test User (lineman)
        $pmId       = 3;        // Admin (acts as PM approver)
        $warehouse  = 'Innoverge Warehouse';
        $today      = now()->toDateString();

        // Only use spans that don't already have a TeardownLog (unique constraint)
        $usedSpanIds = \App\Models\TeardownLog::pluck('pole_span_id')->all();
        $allSpanIds  = \App\Models\PoleSpan::where('node_id', $nodeId)
            ->whereNotIn('id', $usedSpanIds)
            ->orderBy('id')
            ->limit(15)
            ->pluck('id')
            ->values();

        $batches = [
            array_slice($allSpanIds->all(), 0, 3),
            array_slice($allSpanIds->all(), 3, 2),
            array_slice($allSpanIds->all(), 5, 2),
            array_slice($allSpanIds->all(), 7, 3),
            array_slice($allSpanIds->all(), 10, 2),
        ];

        // Vary collected quantities per batch
        $quantities = [
            ['node' => 2, 'amplifier' => 1, 'tsc' => 1, 'cable' => 120.5],
            ['node' => 1, 'amplifier' => 2, 'tsc' => 0, 'cable' => 85.0],
            ['node' => 3, 'amplifier' => 0, 'tsc' => 2, 'cable' => 200.0],
            ['node' => 1, 'amplifier' => 1, 'tsc' => 1, 'cable' => 95.5],
            ['node' => 2, 'amplifier' => 2, 'tsc' => 0, 'cable' => 150.0],
        ];

        foreach ($batches as $i => $spanIds) {
            if (empty($spanIds)) {
                continue;
            }

            $qty = $quantities[$i];

            // 1. Create TeardownLogs for each span in this batch
            $logIds = [];
            foreach ($spanIds as $spanId) {
                $log = TeardownLog::create([
                    'project_id'          => $projectId,
                    'node_id'             => $nodeId,
                    'pole_span_id'        => $spanId,
                    'status'              => 'submitted',
                    'did_collect_all_cable'   => true,
                    'collected_cable'         => round($qty['cable'] / count($spanIds), 1),
                    'collected_node'          => $i === 0 ? 1 : 0,
                    'collected_amplifier'     => $i % 2 === 0 ? 1 : 0,
                    'collected_tsc'           => $i % 3 === 0 ? 1 : 0,
                    'did_collect_components'  => true,
                    'submitted_by'            => (string) $linemanId,
                    'started_at'              => now()->subHours(4),
                    'finished_at'             => now()->subHours(2),
                    'received_at_server'      => now()->subHours(2),
                    'synced_at_server'        => now()->subHours(2),
                ]);
                $logIds[] = $log->id;
            }

            // 2. Create TeardownSubmission (PM-approved, ready for warehouse)
            $submission = TeardownSubmission::create([
                'project_id'          => $projectId,
                'node_id'             => $nodeId,
                'report_date'         => $today,
                'status'              => 'pm_approved',
                'total_cable'         => $qty['cable'],
                'total_node'          => $qty['node'],
                'total_amplifier'     => $qty['amplifier'],
                'total_tsc'           => $qty['tsc'],
                'item_status'         => 'intransit',
                'warehouse_location'  => $warehouse,
                'submitted_by'        => (string) $linemanId,
                'submitted_at'        => now()->subHours(3),
                'pm_reviewed_by'      => (string) $pmId,
                'pm_reviewed_at'      => now()->subHours(1),
            ]);

            // 3. Link logs to submission via TeardownSubmissionItem
            foreach ($logIds as $logId) {
                TeardownSubmissionItem::create([
                    'teardown_submission_id' => $submission->id,
                    'teardown_log_id'        => $logId,
                ]);
            }

            // 4. Create WarehouseReceipt — expected today at this warehouse
            WarehouseReceipt::create([
                'warehouse_receipt_id'    => 'WR-' . now()->format('Ymd') . '-' . str_pad($submission->id, 4, '0', STR_PAD_LEFT),
                'teardown_submission_id'  => $submission->id,
                'project_id'             => $projectId,
                'node_id'                => $nodeId,
                'delivery_date'          => $today,
                'teardown_date'          => $today,
                'pole_source'            => 'Multiple spans — batch ' . ($i + 1),
                'collected_cable'        => $qty['cable'],
                'collected_node'         => $qty['node'],
                'collected_amplifier'    => $qty['amplifier'],
                'collected_tsc'          => $qty['tsc'],
                'warehouse_location'     => $warehouse,
                'status'                 => 'pending_delivery',
                'entry_mode'             => 'reported',
            ]);
        }

        $this->command->info('Created 5 teardown submissions with warehouse receipts for today.');
    }
}
