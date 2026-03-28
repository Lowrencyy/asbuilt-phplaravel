<?php
// Tinker: BGC:1104 - BGC Taguig ~40 poles along real streets
// Run: php artisan tinker --execute="require base_path('tinker-BGC-1104.php');"
use App\Models\Node;
use App\Models\Pole;
use App\Models\PoleSpan;

$old = Node::where('node_id', 'BGC:1104')->first();
if ($old) {
    PoleSpan::where('node_id', $old->id)->delete();
    Pole::where('node_id', $old->id)->delete();
    $old->delete();
    echo "Cleared old BGC:1104.\n";
}

$node = Node::create([
    'node_id'             => 'BGC:1104',
    'project_id'          => 1,
    'data_source'         => 'Manual',
    'sites'               => 'BGC',
    'province'            => 'Metro Manila',
    'city'                => 'Taguig City',
    'team'                => 'BGC TAGUIG CITY SUBCON',
    'status'              => 'pending',
    'total_strand_length' => 1529,
    'expected_cable'      => 3357,
    'actual_cable'        => 0,
    'extender'            => 13,
    'node_count'          => 20,
    'amplifier'           => 8,
    'tsc'                 => 6,
    'progress_percentage' => 0,
]);
echo "Node: {$node->node_id} (id={$node->id})\n";

// 4 poles per street, placed evenly along actual OSM road geometry
$coords = [
    [14.5576143, 121.0537312], // 9th Avenue – P001
    [14.5580537, 121.0538785], // 9th Avenue – P002
    [14.5584932, 121.0540257], // 9th Avenue – P003
    [14.5589327, 121.0541727], // 9th Avenue – P004
    [14.5489607, 121.0528463], // 11th Avenue – P005
    [14.5494915, 121.0530247], // 11th Avenue – P006
    [14.5500224, 121.0532031], // 11th Avenue – P007
    [14.5505532, 121.0533815], // 11th Avenue – P008
    [14.5559023, 121.0511895], // 7th Avenue – P009
    [14.5565485, 121.0514134], // 7th Avenue – P010
    [14.5571953, 121.0516355], // 7th Avenue – P011
    [14.5578422, 121.0518573], // 7th Avenue – P012
    [14.5578422, 121.0518573], // 36th Street – P013
    [14.557943, 121.0515478], // 36th Street – P014
    [14.5580436, 121.0512382], // 36th Street – P015
    [14.5581443, 121.0509286], // 36th Street – P016
    [14.558219, 121.0580707], // 38th Street – P017
    [14.5582347, 121.0576537], // 38th Street – P018
    [14.558233, 121.0572359], // 38th Street – P019
    [14.5582706, 121.0568202], // 38th Street – P020
    [14.5513186, 121.0581817], // 32nd Street – P021
    [14.551405, 121.0579015], // 32nd Street – P022
    [14.5514913, 121.0576213], // 32nd Street – P023
    [14.5515777, 121.0573411], // 32nd Street – P024
    [14.551567, 121.0516945], // 30th Street – P025
    [14.5517047, 121.0512648], // 30th Street – P026
    [14.5518421, 121.050835], // 30th Street – P027
    [14.5519794, 121.0504051], // 30th Street – P028
    [14.5524898, 121.0556745], // Rizal Drive – P029
    [14.5527466, 121.055554], // Rizal Drive – P030
    [14.5530035, 121.0554336], // Rizal Drive – P031
    [14.5532573, 121.0553066], // Rizal Drive – P032
    [14.5527172, 121.0571348], // University Parkway – P033
    [14.5536771, 121.057218], // University Parkway – P034
    [14.5545923, 121.0575111], // University Parkway – P035
    [14.5553949, 121.0580893], // University Parkway – P036
    [14.5497197, 121.0550762], // McKinley Parkway – P037
    [14.5498974, 121.0551366], // McKinley Parkway – P038
    [14.5500752, 121.0551968], // McKinley Parkway – P039
    [14.5502536, 121.0552552], // McKinley Parkway – P040
];

$poles = [];
foreach ($coords as $i => [$lat, $lng]) {
    $code = 'BGC:5232-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT);
    $poles[] = Pole::create([
        'node_id'       => $node->id,
        'pole_code'     => $code,
        'status'        => 'not started',
        'map_latitude'  => $lat,
        'map_longitude' => $lng,
    ]);
}
echo count($poles) . " poles created.\n";

// Spans — same-street adjacent only, no crossing
$spans_data = [
    [0, 1, 51, 3, 153, 1, 1, 0, 0], // 9th Avenue
    [1, 2, 51, 1, 51, 1, 0, 2, 1], // 9th Avenue
    [2, 3, 51, 1, 51, 0, 0, 2, 1], // 9th Avenue
    [4, 5, 62, 3, 186, 0, 1, 1, 0], // 11th Avenue
    [5, 6, 62, 3, 186, 0, 0, 1, 0], // 11th Avenue
    [6, 7, 62, 1, 62, 2, 0, 0, 0], // 11th Avenue
    [8, 9, 76, 1, 76, 1, 0, 0, 0], // 7th Avenue
    [9, 10, 76, 3, 228, 0, 0, 0, 0], // 7th Avenue
    [10, 11, 76, 3, 228, 1, 0, 0, 0], // 7th Avenue
    [12, 13, 35, 1, 35, 1, 0, 0, 0], // 36th Street
    [13, 14, 35, 3, 105, 0, 0, 0, 1], // 36th Street
    [14, 15, 35, 3, 105, 0, 0, 1, 1], // 36th Street
    [16, 17, 45, 3, 135, 0, 0, 0, 0], // 38th Street
    [17, 18, 45, 1, 45, 0, 1, 0, 0], // 38th Street
    [18, 19, 45, 3, 135, 2, 0, 1, 0], // 38th Street
    [20, 21, 32, 1, 32, 0, 1, 1, 0], // 32nd Street
    [21, 22, 32, 1, 32, 0, 0, 0, 0], // 32nd Street
    [22, 23, 32, 3, 96, 2, 0, 0, 0], // 32nd Street
    [24, 25, 49, 3, 147, 2, 0, 0, 1], // 30th Street
    [25, 26, 49, 3, 147, 1, 0, 1, 0], // 30th Street
    [26, 27, 49, 1, 49, 0, 2, 0, 0], // 30th Street
    [28, 29, 31, 3, 93, 2, 0, 0, 0], // Rizal Drive
    [29, 30, 31, 1, 31, 0, 0, 0, 0], // Rizal Drive
    [30, 31, 31, 3, 93, 0, 0, 0, 0], // Rizal Drive
    [32, 33, 107, 3, 321, 0, 0, 0, 0], // University Parkway
    [33, 34, 107, 3, 321, 0, 0, 1, 0], // University Parkway
    [34, 35, 109, 1, 109, 1, 0, 0, 0], // University Parkway
    [36, 37, 21, 1, 21, 0, 0, 0, 1], // McKinley Parkway
    [37, 38, 21, 3, 63, 2, 2, 2, 0], // McKinley Parkway
    [38, 39, 21, 1, 21, 1, 0, 0, 0], // McKinley Parkway
];
$sc = 0;
foreach ($spans_data as [$fi, $ti, $len, $runs, $cable, $nd, $am, $ex, $tsc]) {
    PoleSpan::create([
        'node_id'            => $node->id,
        'from_pole_id'       => $poles[$fi]->id,
        'to_pole_id'         => $poles[$ti]->id,
        'length_meters'      => $len,
        'runs'               => $runs,
        'expected_cable'     => $cable,
        'expected_node'      => $nd,
        'expected_amplifier' => $am,
        'expected_extender'  => $ex,
        'expected_tsc'       => $tsc,
        'status'             => 'pending',
    ]);
    $sc++;
}
echo "$sc spans created.\n";
echo "\n=== DONE: {$node->node_id} ===\n";
echo "Poles              : " . count($poles) . "\n";
echo "Spans              : $sc\n";
echo "Total Strand Length: 1529 m\n";
echo "Expected Cable     : 3357 m\n";
echo "Extender           : 13 pcs\n";
echo "TSC                : 6 pcs\n";
echo "Node Devices       : 20 pcs\n";
echo "Amplifier          : 8 pcs\n";