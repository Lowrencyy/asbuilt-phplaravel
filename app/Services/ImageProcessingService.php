<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;

class ImageProcessingService
{
    protected ImageManager $manager;
    protected string $boldFont;
    protected string $regularFont;

    public function __construct()
    {
        $this->manager     = new ImageManager(new Driver());
        $this->boldFont    = public_path('fonts/Bold.ttf');
        $this->regularFont = public_path('fonts/Regular.ttf');
    }

    /**
     * Process, stamp, and save an uploaded image.
     *
     * @param  UploadedFile  $file
     * @param  string        $storagePath  e.g. "SKYLAB/N-001/P-001"
     * @param  string        $filename     e.g. "P-001_P-002_before.jpg"
     * @param  array         $meta         GPS + label metadata
     * @return string        Stored relative path
     */
    public function process(
        UploadedFile $file,
        string $storagePath,
        string $filename,
        array $meta = []
    ): string {
        $image = $this->manager->read($file->getRealPath());

        // Add full overlay (text + map thumbnail)
        $this->addOverlay($image, $meta);

        // Encode as JPEG quality 82
        $encoded = $image->toJpeg(quality: 82);

        $fullPath = $storagePath . '/' . $filename;
        Storage::disk('public')->put($fullPath, (string) $encoded);

        return $fullPath;
    }

    protected function addOverlay($image, array $meta): void
    {
        $W = $image->width();
        $H = $image->height();

        // ── Metadata ─────────────────────────────────────────────────────────
        $lat    = isset($meta['latitude'])  ? (float) $meta['latitude']  : null;
        $lng    = isset($meta['longitude']) ? (float) $meta['longitude'] : null;
        $latStr = $lat !== null ? number_format($lat, 6) . '° N' : null;
        $lngStr = $lng !== null ? number_format($lng, 6) . '° E' : null;
        $coordStr = ($latStr && $lngStr) ? "{$latStr}  {$lngStr}" : null;

        try {
            $dt = Carbon::parse($meta['captured_at'] ?? 'now')->setTimezone('Asia/Manila');
            $dateStr = $dt->format('M d, Y  H:i:s');
        } catch (\Throwable) {
            $dateStr = Carbon::now('Asia/Manila')->format('M d, Y  H:i:s');
        }

        $fromPole  = $meta['from_pole'] ?? null;
        $toPole    = $meta['to_pole']   ?? null;
        $poleType  = $meta['pole_type'] ?? null;
        $nodeCode  = $meta['node_code'] ?? null;

        // Reverse geocode — split into street + city/province
        $street      = null;
        $cityProvince = $meta['location_name'] ?? null;

        if ($lat && $lng) {
            $geo         = $this->reverseGeocode($lat, $lng);
            $street      = $geo['street'];
            $cityProvince = $cityProvince ?? $geo['city_province'];
        }

        // Pole type label mapping
        $poleTypeMap = ['before' => 'BEFORE', 'after' => 'AFTER', 'poletag' => 'POLE TAG'];
        $poleTypeLabel = $poleType ? ($poleTypeMap[strtolower($poleType)] ?? strtoupper($poleType)) : null;

        $spanStr = ($fromPole && $toPole)
            ? strtoupper("{$fromPole} → {$toPole}") . ($poleTypeLabel ? "  ({$poleTypeLabel})" : '')
            : null;

        $nodeStr = $nodeCode ? "Node ID:  {$nodeCode}" : null;

        // ── Layout sizes ─────────────────────────────────────────────────────
        $fontSize = max(20, (int) ($W * 0.030));
        $lineH    = (int) ($fontSize * 1.75);
        $pad      = (int) ($fontSize * 1.2);
        $mapW     = (int) ($W * 0.36);
        $mapH     = (int) ($mapW * 0.65);

        $lines = array_values(array_filter([
            $dateStr,
            $street,
            $cityProvince,
            $coordStr,
            $spanStr,
            $nodeStr,
        ]));

        $textH    = $pad * 2 + count($lines) * $lineH;
        $overlayH = max($textH, $mapH + $pad * 2);
        $overlayY = $H - $overlayH;

        // ── Semi-transparent black bar ────────────────────────────────────────
        $image->drawRectangle(0, $overlayY, function ($r) use ($W, $H) {
            $r->size($W, $H);
            $r->background('rgba(0, 0, 0, 0.65)');
        });

        // ── Text lines (left side) ────────────────────────────────────────────
        $y = $overlayY + $pad;
        foreach ($lines as $i => $line) {
            $font = $i === 0 ? $this->boldFont : $this->regularFont;
            $image->text($line, $pad, $y, function (FontFactory $ff) use ($font, $fontSize) {
                $ff->file($font);
                $ff->size($fontSize);
                $ff->color('ffffff');
                $ff->align('left');
                $ff->valign('top');
            });
            $y += $lineH;
        }

        // ── Map thumbnail from OSM tiles (free, no API key) ──────────────────
        if ($lat && $lng) {
            try {
                $mapImg = $this->buildOsmThumbnail($lat, $lng, $mapW, $mapH);
                if ($mapImg) {
                    $mapX = $W - $mapW - $pad;
                    $mapY = $overlayY + (int) (($overlayH - $mapH) / 2);
                    $image->place($mapImg, 'top-left', $mapX, $mapY);
                }
            } catch (\Throwable $e) {
                Log::warning('Map thumbnail failed: ' . $e->getMessage());
            }
        }
    }

    protected function buildOsmThumbnail(float $lat, float $lng, int $mapW, int $mapH): mixed
    {
        $zoom     = 17;
        $tileSize = 256;
        $n        = pow(2, $zoom);

        // Center tile coordinates
        $cx = ($lng + 180) / 360 * $n;
        $cy = (1 - log(tan(deg2rad($lat)) + 1 / cos(deg2rad($lat))) / M_PI) / 2 * $n;

        $tileX = (int) floor($cx);
        $tileY = (int) floor($cy);

        // Pixel offset of the exact point within the 3x3 tile grid
        $pixOffX = (int) (($cx - $tileX + 1) * $tileSize);
        $pixOffY = (int) (($cy - $tileY + 1) * $tileSize);

        // Stitch a 3x3 grid of tiles into one GD canvas
        $canvas = imagecreatetruecolor($tileSize * 3, $tileSize * 3);
        $fetched = false;

        for ($dy = -1; $dy <= 1; $dy++) {
            for ($dx = -1; $dx <= 1; $dx++) {
                $tx  = $tileX + $dx;
                $ty  = $tileY + $dy;
                $url = "https://tile.openstreetmap.org/{$zoom}/{$tx}/{$ty}.png";

                $r = Http::timeout(5)
                    ->withHeaders(['User-Agent' => 'TelcoVantage/1.0 (field-ops)'])
                    ->get($url);

                if ($r->ok()) {
                    $tile = @imagecreatefromstring($r->body());
                    if ($tile) {
                        imagecopy($canvas, $tile, ($dx + 1) * $tileSize, ($dy + 1) * $tileSize, 0, 0, $tileSize, $tileSize);
                        imagedestroy($tile);
                        $fetched = true;
                    }
                }
            }
        }

        if (! $fetched) {
            imagedestroy($canvas);
            return null;
        }

        // Crop around the center point
        $cropX   = max(0, $pixOffX - (int) ($mapW / 2));
        $cropY   = max(0, $pixOffY - (int) ($mapH / 2));
        $cropped = imagecreatetruecolor($mapW, $mapH);
        imagecopy($cropped, $canvas, 0, 0, $cropX, $cropY, $mapW, $mapH);
        imagedestroy($canvas);

        // Draw teardrop location pin
        $tipX  = (int) ($pixOffX - $cropX);
        $tipY  = (int) ($pixOffY - $cropY);
        $pinR  = max(10, (int) round($mapW * 0.07));   // radius scales with map size
        $headY = $tipY - $pinR * 2 - (int) ($pinR * 0.4);  // circle center above the tip

        $red    = imagecolorallocate($cropped, 220, 38, 38);
        $white  = imagecolorallocate($cropped, 255, 255, 255);
        $shadow = imagecolorallocatealpha($cropped, 0, 0, 0, 90);

        // Drop shadow under circle head
        imagefilledellipse($cropped, $tipX + 2, $headY + 2, $pinR * 2 + 4, $pinR * 2 + 4, $shadow);

        // Pin tail (triangle: base at bottom of circle → tip point)
        $tailBaseW = (int) ($pinR * 0.65);
        $tailBaseY = $headY + (int) ($pinR * 0.7);
        imagefilledpolygon($cropped, [
            $tipX - $tailBaseW, $tailBaseY,
            $tipX + $tailBaseW, $tailBaseY,
            $tipX,              $tipY,
        ], $red);

        // Red filled circle head
        imagefilledellipse($cropped, $tipX, $headY, $pinR * 2, $pinR * 2, $red);

        // White border ring
        imageellipse($cropped, $tipX, $headY, $pinR * 2 + 2, $pinR * 2 + 2, $white);

        // White inner dot (hole effect)
        $dotR = (int) ($pinR * 0.42);
        imagefilledellipse($cropped, $tipX, $headY, $dotR * 2, $dotR * 2, $white);

        // Convert to PNG string and wrap as Intervention image
        ob_start();
        imagepng($cropped);
        $png = ob_get_clean();
        imagedestroy($cropped);

        return $this->manager->read($png);
    }

    protected function reverseGeocode(float $lat, float $lng): array
    {
        try {
            $r = Http::timeout(5)
                ->withHeaders(['User-Agent' => 'TelcoVantage/1.0 (field-ops)'])
                ->get('https://nominatim.openstreetmap.org/reverse', [
                    'lat'    => $lat,
                    'lon'    => $lng,
                    'format' => 'json',
                ]);

            if ($r->ok()) {
                $addr    = $r->json()['address'] ?? [];
                $street  = $addr['road']
                    ?? $addr['pedestrian']
                    ?? $addr['footway']
                    ?? $addr['street']
                    ?? $addr['path']
                    ?? $addr['neighbourhood']
                    ?? null;
                $city     = $addr['city'] ?? $addr['town'] ?? $addr['municipality'] ?? $addr['village'] ?? $addr['suburb'] ?? '';
                $province = $addr['state'] ?? $addr['county'] ?? '';
                $cityProvince = implode(', ', array_filter([$city, $province])) ?: null;

                return ['street' => $street, 'city_province' => $cityProvince];
            }
        } catch (\Throwable $e) {
            Log::warning('Reverse geocode failed: ' . $e->getMessage());
        }

        return ['street' => null, 'city_province' => null];
    }
}
