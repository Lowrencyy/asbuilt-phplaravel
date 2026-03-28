<?php
/**
 * Tinker Script: Create Node TY-1121 with 30 Poles
 * Run: php artisan tinker --execute="require base_path('tinker-TY-1121.php');"
 */

use App\Models\Node;
use App\Models\Pole;

// ── 1. Create the node ───────────────────────────────────────────────────────
$node = Node::firstOrCreate(
    ['node_id' => 'TY-1121'],
    [
        'project_id'          => 1,
        'data_source'         => 'Manual',
        'sites'               => 'Taguig',
        'province'            => 'Metro Manila',
        'city'                => 'Taguig City',
        'team'                => 'Team Alpha',
        'status'              => 'pending',
        'total_strand_length' => 0,
        'expected_cable'      => 0,
        'actual_cable'        => 0,
        'extender'            => 0,
        'node_count'          => 0,
        'amplifier'           => 0,
        'tsc'                 => 0,
        'progress_percentage' => 0,
    ]
);

echo "Node: {$node->node_id} (id={$node->id})" . PHP_EOL;

// ── 2. Pole GPS coordinates (30 poles) ──────────────────────────────────────
$coords = [
    [14.539691, 121.108614],
    [14.540268, 121.107747],
    [14.539953, 121.107921],
    [14.540012, 121.107721],
    [14.539955, 121.107922],
    [14.540022, 121.107726],
    [14.539967, 121.108678],
    [14.540179, 121.108748],
    [14.540421, 121.108825],
    [14.540683, 121.108907],
    [14.540126, 121.109712],
    [14.539877, 121.109640],
    [14.539403, 121.109471],
    [14.540172, 121.108784],
    [14.539721, 121.107806],
    [14.539454, 121.107779],
    [14.538999, 121.108323],
    [14.538873, 121.108526],
    [14.538918, 121.107941],
    [14.539083, 121.108007],
    [14.539279, 121.107453],
    [14.539699, 121.107803],
    [14.539904, 121.107247],
    [14.540020, 121.106974],
    [14.540040, 121.109200],
    [14.539905, 121.109651],
    [14.540103, 121.106717],
    [14.540286, 121.106704],
    [14.540247, 121.107519],
    [14.540434, 121.107593],
];

// ── 3. Insert poles ──────────────────────────────────────────────────────────
$created = 0;
$skipped = 0;

foreach ($coords as $i => [$lat, $lng]) {
    $seq      = str_pad($i + 1, 3, '0', STR_PAD_LEFT);
    $poleCode = 'TY-1121-P' . $seq;

    $exists = Pole::where('node_id', $node->id)
                  ->where('pole_code', $poleCode)
                  ->exists();

    if ($exists) {
        $skipped++;
        continue;
    }

    Pole::create([
        'node_id'       => $node->id,
        'pole_code'     => $poleCode,
        'status'        => 'active',
        'map_latitude'  => $lat,
        'map_longitude' => $lng,
    ]);

    echo "  Created pole #{$seq}: {$poleCode} @ {$lat}, {$lng}" . PHP_EOL;
    $created++;
}

echo PHP_EOL;
echo "Done! Created: {$created} poles, Skipped (already exist): {$skipped}" . PHP_EOL;
echo "Node ID: {$node->id} | Node Code: {$node->node_id}" . PHP_EOL;

// ── 4. Summary ───────────────────────────────────────────────────────────────
$total = Pole::where('node_id', $node->id)->count();
echo "Total poles in TY-1121: {$total}" . PHP_EOL;
