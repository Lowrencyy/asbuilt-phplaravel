# TelcoVantage Mobile App Plan

## Overview

React Native app para sa linemen sa field.
Laravel backend = API + Admin Dashboard.

---

## Architecture

```
Laravel (existing)
├── Admin Web Dashboard     → supervisor/admin
├── REST API (/api/v1/...)  → React Native
└── Sanctum Auth            → mobile token-based auth

React Native App
├── Auth (Login)
├── View assigned Nodes & Poles
├── Submit Teardown Logs
└── Upload Image Evidence (with embedded overlay + mini map)
```

---

## Image Requirements

### 1. Compression via Laravel Intervention Image
- Package: `intervention/image`
- Max file size: **100kb** after processing
- Format: JPEG (best compression ratio)
- Resize: max 1080px width, maintain aspect ratio

### 2. Image Overlay (Watermark sa loob ng picture)
Pagka-upload ng lineman, mag-a-apply ng overlay sa image:

```
┌─────────────────────────────────────────────┐
│                                             │
│           (photo ng lineman)                │
│                                             │
│                                             │
├─────────────────────────┬───────────────────┤
│ Location: Quezon City   │   [Mini Map]      │
│ Coordinates: 14.6760,   │   showing pin     │
│              121.0437   │   on actual loc   │
│ Date: 2026-03-10        │                   │
│ Time: 10:32 AM PHT      │                   │
│ Pole ID: P-00123        │                   │
│ Node ID: N-0045         │                   │
└─────────────────────────┴───────────────────┘
```

### 3. Mini Map (sa loob ng image)
- Gamit: **Static Map API** (Google Static Maps o OpenStreetMap/Staticmap)
- Size: ~200x200px, i-embed sa lower-right ng image
- Nagpapakita ng pin sa exact coordinates ng lineman

---

## Laravel API Endpoints

### Auth
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/login` | Mag-login, ibalik ang token |
| POST | `/api/v1/logout` | Invalidate token |

### Field Data
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/nodes` | List ng assigned nodes |
| GET | `/api/v1/nodes/{id}/poles` | Poles under a node |
| GET | `/api/v1/poles/{id}/spans` | Spans ng isang pole |

### Teardown Log
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/teardown-logs` | Submit teardown log |
| GET | `/api/v1/teardown-logs/{id}` | View single log |

### Image Upload
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/images/upload` | Upload image with metadata |

**Image Upload Payload (multipart/form-data):**
```json
{
  "image": "<file>",
  "pole_id": "P-00123",
  "node_id": "N-0045",
  "latitude": 14.6760,
  "longitude": 121.0437,
  "location_name": "Quezon City",
  "captured_at": "2026-03-10T10:32:00+08:00"
}
```

---

## Laravel Image Processing Flow

```
1. Receive image + metadata from React Native
2. Use Intervention Image:
   a. Resize to max 1080px width
   b. Fetch Static Map tile using coordinates (Google/OSM)
   c. Composite map tile sa lower-right ng image
   d. Write text overlay (location, coords, date/time PHT, pole/node ID)
   e. Encode as JPEG quality 70 (target ≤100kb)
   f. Save to storage/app/public/evidence/
3. Return image URL + metadata sa React Native
```

---

## Laravel Packages Needed

```bash
composer require intervention/image
```

Config para sa `config/image.php`:
- Driver: `gd` (built-in sa PHP) o `imagick` (mas maayos ang font rendering)

---

## React Native Flow (Lineman Side)

```
1. Login → get Sanctum token
2. Piliin ang Node → Pole → Span
3. Pindutin ang "Take Photo"
4. React Native kumuha ng:
   - GPS coordinates (expo-location)
   - Current datetime (moment.js or dayjs + PHT timezone)
5. I-send sa Laravel API (multipart upload)
6. Laravel mag-process ng image (overlay + map + compress)
7. Ibalik ng Laravel ang processed image URL
8. Ipakita sa lineman ang preview ng processed photo
```

---

## React Native Libraries

| Library | Gamit |
|---------|-------|
| `expo-location` | GPS coordinates |
| `expo-image-picker` / `expo-camera` | Camera access |
| `dayjs` + `timezone` plugin | PHT date/time format |
| `axios` | HTTP requests sa Laravel API |
| `react-native-maps` | Map preview sa app (optional) |
| `@react-native-async-storage` | Store token locally |

---

## PHT Timezone Note

Sa Laravel overlay, palaging i-convert sa **Asia/Manila (UTC+8)**:

```php
$capturedAt = Carbon::parse($request->captured_at)->setTimezone('Asia/Manila');
// Output: "March 10, 2026 10:32 AM PHT"
```

---

## Next Steps (Priority Order)

- [ ] 1. Install `intervention/image` sa Laravel
- [ ] 2. Gumawa ng `ImageProcessingService` (resize + overlay + map embed)
- [ ] 3. Gumawa ng API routes + controllers (Auth, Nodes, Poles, Images)
- [ ] 4. Setup Laravel Sanctum para sa mobile token auth
- [ ] 5. Init React Native project (Expo)
- [ ] 6. Build login + navigation flow
- [ ] 7. Build camera + GPS + upload feature
- [ ] 8. Test end-to-end



Yes, sample is good. For audit, hindi kailangang sobrang exact. Ang importante ay:

may photo proof

may approximate GPS

may captured time

may source pole/span

may way kayo puntahan yung area later

At para dito, huwag mong iasa sa PHP lang.
Si PHP backend ang storage and validation mo.
Ang frontend/device ang kukuha ng:

GPS

device time

photo

Best setup for your case
Store coordinates in 2 places
1. poles table

Ito ang official / map coordinate ng pole, if meron.

map_latitude
map_longitude
2. teardown_logs table

Ito ang actual audit coordinate ng lineman habang nagsusubmit.

captured_latitude
captured_longitude
gps_accuracy_meters
captured_at_device
received_at_server
synced_at_server
gps_source
offline_mode
Bakit ganito

poles = permanent location

teardown_logs = proof kung saan sila banda noong nag-picture / nag-submit

Ito ang pinakamagandang audit setup.

Important truth about offline GPS
Puwede bang makakuha ng GPS kahit walang signal?

Yes, sometimes.
Ang GPS ng phone ay puwedeng gumana kahit walang mobile data, pero:

mas mabagal makakuha ng fix

minsan inaccurate

minsan cached/last known location lang

sa loob ng masikip na area o ilalim ng bubong, mas mahina

So for your audit use case, okay na okay ang:

“approximate location near the pole”

Hindi mo kailangan centimeter-level accuracy.

PHT time without signal
Best answer

Kunin mo ang device time sa phone, then sa backend i-store mo rin ang server receive time.

So dapat meron kang dalawa:

device time

Ito ang oras noong nag-picture / nag-submit sa field

captured_at_device
server time

Ito ang oras noong dumating sa backend

received_at_server
synced_at_server
PHT handling

Sa backend mo, set mo ang app timezone to:

APP_TIMEZONE=Asia/Manila

or sa Laravel config:

'timezone' => 'Asia/Manila',

Then lahat ng server-side dates mo PHT na.

Pero tandaan:

captured_at_device = oras ng phone

received_at_server = oras ng backend

Magkaiba sila, at parehong useful.

Best offline architecture for your setup

Dahil PHP app ka, ang practical architecture ay:

PHP backend + JS frontend offline capture

Meaning:

PHP/Laravel stores data

browser/mobile frontend captures GPS and photo

kapag offline, local muna ang save

kapag may internet, saka i-sync sa PHP backend

Huwag mo gawin na:

“submit agad sa server or wala na”

Kasi offline field workflow yan.

Recommended flow
Step 1 — Lineman opens teardown form

For selected span:

from pole

to pole

photos

collectables

cable fields

Step 2 — Device tries to get GPS

Frontend gets:

latitude

longitude

accuracy

device timestamp

Step 3 — User takes photo

You store:

image file locally first if offline

metadata locally

Step 4 — If offline

Store all data in local queue:

form data

GPS

timestamp

image path/blob

pending sync status

Step 5 — If online later

Sync all queued records to PHP backend

Step 6 — Backend saves

Into:

teardown_logs

teardown_log_images

and marks:

offline_mode = true

synced_at_server = now()