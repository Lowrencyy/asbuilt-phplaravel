# AsBuilt IQ — API Integration Specification

> **Status:** Planning / Draft
> **Scope:** Separate API layer for the AsBuilt IQ desktop tool (Python/Next.js DXF map reader).
> This is NOT part of the mobile lineman app. It is a backend team tool.

---

## Overview

AsBuilt IQ is an internal tool that reads CAD/DXF engineering drawings using a trained CNN model. It auto-detects poles, spans (strands), and equipment shapes from the map, then syncs the extracted data into the Laravel backend so that:

1. Linemen see the correct nodes, poles, and spans in the mobile app
2. When a lineman completes a teardown, AsBuilt IQ can poll the status and mark the span **red** on the map

---

## How It Fits In

```
[DXF Map File]
      │
      ▼
[AsBuilt IQ Tool]  ←── CNN reads strand numbers (→ pole_span_code)
      │                  Shape detection (circles/rects/triangles → equipment)
      │
      │  POST via AsBuilt IQ API
      ▼
[Laravel Backend]
      │
      ├── nodes
      ├── poles (with GPS coords from DXF)
      ├── pole_spans (with pole_span_code = strand number)
      └── equipment inventory
      │
      ▼
[Mobile Lineman App]  ←── Lineman sees and teardowns spans
      │
      ▼
[Span status = completed]
      │
      ▼
[AsBuilt IQ polls GET /spans/{pole_span_code}/status]
      └── marks span RED on map
```

---

## Planned API Endpoints

Base prefix: `/api/asbuilt/v1`

Auth: Bearer token (Sanctum), role-gated to `project_manager` or `asbuilt` role.

---

### 1. Authentication

#### `POST /api/asbuilt/v1/login`
Login and get an API token.

**Request:**
```json
{
  "email": "user@telcovantage.com",
  "password": "secret"
}
```

**Response:**
```json
{
  "token": "1|abcdef...",
  "user": {
    "id": 1,
    "name": "Renzo Toledo",
    "role": "project_manager"
  }
}
```

---

### 2. Projects

#### `GET /api/asbuilt/v1/projects`
List all projects the authenticated user has access to.

**Response:**
```json
[
  { "id": 1, "name": "BGC Fiber Rollout", "status": "active" }
]
```

---

### 3. Nodes

#### `GET /api/asbuilt/v1/projects/{project_id}/nodes`
List all nodes under a project.

#### `POST /api/asbuilt/v1/projects/{project_id}/nodes`
Add a single node.

**Request:**
```json
{
  "node_id": "QC-1104",
  "node_name": "Bagong Silang Exchange",
  "city": "Quezon City",
  "province": "NCR",
  "status": "ON GOING IMPLEMENTATION"
}
```

#### `POST /api/asbuilt/v1/projects/{project_id}/nodes/bulk`
Bulk-create nodes from DXF-detected rectangles (node shapes).

**Request:**
```json
{
  "nodes": [
    {
      "node_id": "QC-1104",
      "node_name": "Bagong Silang Exchange",
      "city": "Quezon City",
      "province": "NCR"
    }
  ]
}
```

**Response:**
```json
{
  "created": 3,
  "skipped": 1,
  "nodes": [ ... ]
}
```

> `skipped` = nodes whose `node_id` already exists under this project.

---

### 4. Poles

#### `GET /api/asbuilt/v1/nodes/{node_id}/poles`
List all poles under a node.

#### `POST /api/asbuilt/v1/nodes/{node_id}/poles`
Add a single pole.

**Request:**
```json
{
  "pole_code": "QC-1104-001",
  "map_latitude": 14.6792,
  "map_longitude": 121.0452,
  "slot": "DA",
  "remarks": "Near corner post"
}
```

#### `POST /api/asbuilt/v1/nodes/{node_id}/poles/bulk`
Bulk-create poles from DXF coordinates.

**Request:**
```json
{
  "poles": [
    {
      "pole_code": "QC-1104-001",
      "map_latitude": 14.6792,
      "map_longitude": 121.0452
    }
  ]
}
```

**Response:**
```json
{
  "created": 12,
  "skipped": 0,
  "poles": [ ... ]
}
```

---

### 5. Pole Spans

#### `GET /api/asbuilt/v1/nodes/{node_id}/spans`
List all spans under a node.

#### `POST /api/asbuilt/v1/nodes/{node_id}/spans`
Add a single pole span.

**Request:**
```json
{
  "pole_span_code": "7",
  "from_pole_code": "QC-1104-001",
  "to_pole_code": "QC-1104-002",
  "strand_length": 48.5,
  "expected_powersupply": 2,
  "expected_powersupply_housing": 1,
  "status": "pending"
}
```

> `pole_span_code` is the strand number read by the CNN from the DXF. Nullable — if not read, leave blank.

#### `POST /api/asbuilt/v1/nodes/{node_id}/spans/bulk`
Bulk-create spans from DXF OCR output.

**Request:**
```json
{
  "spans": [
    {
      "pole_span_code": "7",
      "from_pole_code": "QC-1104-001",
      "to_pole_code": "QC-1104-002",
      "strand_length": 48.5
    }
  ]
}
```

**Response:**
```json
{
  "created": 8,
  "skipped": 2,
  "spans": [ ... ]
}
```

---

### 6. Equipment

#### `GET /api/asbuilt/v1/nodes/{node_id}/equipment`
List all equipment under a node.

#### `POST /api/asbuilt/v1/nodes/{node_id}/equipment/bulk`
Bulk-add equipment detected from DXF shapes.

**Request:**
```json
{
  "equipment": [
    {
      "type": "splitter",
      "quantity": 1,
      "pole_code": "QC-1104-003",
      "dxf_layer": "SPLITTER",
      "cx": 14.6794,
      "cy": 121.0455
    },
    {
      "type": "extender",
      "quantity": 1,
      "pole_code": "QC-1104-007",
      "dxf_layer": "EXTENDER",
      "cx": 14.6800,
      "cy": 121.0460
    }
  ]
}
```

**Equipment Types (from DXF shape detection):**

| DXF Shape | Layer Keywords | Equipment Type |
|-----------|---------------|----------------|
| Circle | splitter, tapoff | `splitter` (2-way tap) |
| Square | tapoff | `tap_4way` (4-way tap) |
| Hexagon | tapoff | `tap_8way` (8-way tap) |
| Rectangle | node, amplifier | `node_device` |
| Triangle | extender | `line_extender` |

---

### 7. Span Status Sync (for AsBuilt IQ map coloring)

#### `GET /api/asbuilt/v1/spans/status`
Bulk check span statuses by `pole_span_code`. Used by AsBuilt IQ to color spans on the map.

**Request:**
```json
{
  "pole_span_codes": ["7", "8", "12", "15"]
}
```

**Response:**
```json
{
  "spans": [
    { "pole_span_code": "7",  "status": "completed", "date_finished": "2026-03-15" },
    { "pole_span_code": "8",  "status": "pending",   "date_finished": null },
    { "pole_span_code": "12", "status": "ongoing",   "date_finished": null }
  ]
}
```

> AsBuilt IQ colors: `completed` → RED, `ongoing` → YELLOW, `pending` → GRAY

#### `GET /api/asbuilt/v1/spans/{pole_span_code}/status`
Single span status check.

**Response:**
```json
{
  "pole_span_code": "7",
  "status": "completed",
  "date_finished": "2026-03-15",
  "lineman": "Juan dela Cruz"
}
```

---

## Data Flow Summary

```
DXF Upload in AsBuilt IQ
  │
  ├── CNN OCR  →  strand numbers  →  pole_span_code
  ├── Shape detection
  │     circles    →  splitter equipment
  │     rectangles →  node devices
  │     triangles  →  line extenders
  │     squares    →  4-way tap
  │     hexagons   →  8-way tap
  │
  └── AsBuilt IQ posts to Laravel:
        1. POST /nodes/bulk
        2. POST /nodes/{id}/poles/bulk
        3. POST /nodes/{id}/spans/bulk   ← includes pole_span_code
        4. POST /nodes/{id}/equipment/bulk

Mobile Lineman App
  └── Teardown completed → span.status = "completed"

AsBuilt IQ (polling)
  └── GET /spans/status?codes=7,8,12
        → colors spans on map
```

---

## Notes

- `pole_span_code` is nullable. It is the raw strand number string from CNN OCR output (e.g. `"7"`, `"12"`). Not unique globally — unique only within a node.
- Bulk endpoints should be **idempotent**: skip records that already exist (match by `pole_span_code` or `pole_code` + `node_id`) instead of throwing errors.
- Auth is Laravel Sanctum bearer tokens. Role check: `project_manager` or a new `asbuilt` role.
- This API is separate from the mobile lineman API (`/api/v1/`). Different prefix, different middleware group.
- Equipment table needs to be created — no existing table yet as of March 2026.
- `pole_span_code` uniqueness: unique per node (not globally) — migration should be `unique` scoped or just nullable non-unique with application-level logic.

---

## TODO (Implementation Order)

- [ ] Create `asbuilt` middleware / role guard
- [ ] `POST /api/asbuilt/v1/login`
- [ ] `GET /api/asbuilt/v1/projects`
- [ ] Nodes CRUD + bulk endpoint
- [ ] Poles CRUD + bulk endpoint
- [ ] Spans CRUD + bulk endpoint (with pole_span_code)
- [ ] Equipment table migration + bulk endpoint
- [ ] Span status sync endpoints
- [ ] Wire up AsBuilt IQ frontend to call these endpoints instead of Excel export



POST /api/asbuilt/v1/login          → get token
GET  /api/asbuilt/v1/projects       → pick project id
POST /api/asbuilt/v1/projects/{id}/nodes/bulk   → upload nodes
POST /api/asbuilt/v1/nodes/{id}/poles/bulk      → upload poles
POST /api/asbuilt/v1/nodes/{id}/spans/bulk      → upload spans (with pole_span_code)
POST /api/asbuilt/v1/spans/status   → poll span colors for map