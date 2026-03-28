# TelcoVantage — Planner App API Documentation

> **Local Test Base URL (ngrok):**
> ```
> https://disguisedly-enarthrodial-kristi.ngrok-free.dev/api/v1
> ```
>
> **Note:** Add this header on every request when using ngrok:
> ```
> ngrok-skip-browser-warning: true
> ```

---

## Allowed Roles

Only the following roles can login and use the write endpoints:

| Role | Value |
|---|---|
| Admin | `admin` |
| Project Manager | `project_manager` |
| Executives | `executives` |

---

## Headers (All Requests)

```
Content-Type: application/json
Accept: application/json
ngrok-skip-browser-warning: true
```

After login, add:
```
Authorization: Bearer {token}
```

---

## 1. Authentication

### Login
```
POST /api/v1/login
```

**Request Body:**
```json
{
  "email": "admin@example.com",
  "password": "yourpassword"
}
```

**Response `200`:**
```json
{
  "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "user": {
    "id": 1,
    "name": "Juan dela Cruz",
    "email": "admin@example.com",
    "role": "project_manager"
  }
}
```

**Error `401`** — wrong credentials
**Error `403`** — role not allowed

---

### Logout
```
POST /api/v1/logout
Authorization: Bearer {token}
```

---

### Get Current User
```
GET /api/v1/me
Authorization: Bearer {token}
```

---

## 2. Bulk Upload (Recommended) ⭐⭐⭐

Upload a single JSON file containing one **node + all its poles + all its pole spans** in one shot.

Accepts **plain `.json`** or **gzip-compressed `.json.gz`** file.

> Use `from_pole_code` / `to_pole_code` (string) for pole spans — no need to know database IDs.
> The server resolves pole codes to IDs automatically.

```
POST /api/v1/bulk-upload
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Form field:**

| Field | Type | Required | Notes |
|---|---|---|---|
| `file` | file | **YES** | `.json` or `.json.gz` (gzip) |

---

### JSON File Structure

```json
{
  "project_id": 1,
  "node": {
    "node_id": "TY-5232",
    "node_name": "Taytay Area 1",
    "city": "Taytay",
    "province": "Rizal",
    "team": "Team Alpha",
    "date_start": "2026-03-24",
    "due_date": "2026-04-30",
    "total_strand_length": 1500.50,
    "expected_cable": 1600.00,
    "node_count": 1,
    "amplifier": 2,
    "extender": 3,
    "tsc": 1
  },
  "poles": [
    {
      "pole_code": "001",
      "pole_name": "Pole 1",
      "map_latitude": 14.5547,
      "map_longitude": 121.1234
    },
    {
      "pole_code": "002",
      "pole_name": "Pole 2",
      "map_latitude": 14.5551,
      "map_longitude": 121.1240
    },
    {
      "pole_code": "003",
      "pole_name": "Pole 3",
      "map_latitude": 14.5555,
      "map_longitude": 121.1245
    }
  ],
  "pole_spans": [
    {
      "from_pole_code": "001",
      "to_pole_code": "002",
      "pole_span_code": "TY:5232-001-002",
      "length_meters": 48.50,
      "runs": 1,
      "expected_cable": 49.00,
      "expected_amplifier": 1
    },
    {
      "from_pole_code": "002",
      "to_pole_code": "003",
      "pole_span_code": "TY:5232-002-003",
      "length_meters": 52.00,
      "runs": 1,
      "expected_cable": 53.00
    }
  ]
}
```

### Node Fields

| Field | Type | Required | Default | Notes |
|---|---|---|---|---|
| `node_id` | string | **YES** | — | e.g. `TY-5232`. Unique per project |
| `node_name` | string | no | null | |
| `sites` | string | no | null | |
| `province` | string | no | null | |
| `city` | string | no | null | |
| `team` | string | no | null | |
| `status` | string | no | `pending` | |
| `date_start` | date | no | null | `YYYY-MM-DD` |
| `due_date` | date | no | null | `YYYY-MM-DD` |
| `total_strand_length` | decimal | no | `0` | |
| `expected_cable` | decimal | no | `0` | |
| `extender` | integer | no | `0` | |
| `node_count` | integer | no | `1` | |
| `amplifier` | integer | no | `0` | |
| `tsc` | integer | no | `0` | |

### Pole Fields (each item in `poles` array)

| Field | Type | Required | Default | Notes |
|---|---|---|---|---|
| `pole_code` | string | **YES** | — | Unique per node. e.g. `001` |
| `pole_name` | string | no | null | |
| `status` | string | no | `active` | |
| `remarks` | string | no | null | |
| `map_latitude` | decimal | no | null | Between `-90` and `90` |
| `map_longitude` | decimal | no | null | Between `-180` and `180` |

### Pole Span Fields (each item in `pole_spans` array)

| Field | Type | Required | Default | Notes |
|---|---|---|---|---|
| `from_pole_code` | string | **YES** | — | Must match a `pole_code` in the `poles` array above |
| `to_pole_code` | string | **YES** | — | Must match a `pole_code` in the `poles` array above, must differ from `from_pole_code` |
| `pole_span_code` | string | no | null | Globally unique. e.g. `TY:5232-001-002` |
| `length_meters` | decimal | no | `0` | |
| `runs` | integer | no | `1` | |
| `expected_cable` | decimal | no | `0` | |
| `expected_node` | integer | no | `0` | |
| `expected_amplifier` | integer | no | `0` | |
| `expected_extender` | integer | no | `0` | |
| `expected_tsc` | integer | no | `0` | |
| `expected_powersupply` | integer | no | `0` | |
| `expected_powersupply_housing` | integer | no | `0` | |

---

### Response `201`

```json
{
  "message": "Bulk upload successful.",
  "data": {
    "node": {
      "id": 10,
      "node_id": "TY-5232",
      "action": "created"
    },
    "poles": [
      { "pole_code": "001", "id": 55, "action": "created" },
      { "pole_code": "002", "id": 56, "action": "created" },
      { "pole_code": "003", "id": 57, "action": "created" }
    ],
    "pole_spans": [
      { "pole_span_code": "TY:5232-001-002", "from_pole_code": "001", "to_pole_code": "002", "id": 200, "action": "created" },
      { "pole_span_code": "TY:5232-002-003", "from_pole_code": "002", "to_pole_code": "003", "id": 201, "action": "created" }
    ],
    "summary": {
      "poles_count": 3,
      "pole_spans_count": 2
    }
  }
}
```

> `action` is either `"created"` or `"updated"` — re-uploading the same file is safe (upsert behavior).

---

### Bulk Upload — curl Example

**Plain JSON file:**
```bash
curl -X POST https://disguisedly-enarthrodial-kristi.ngrok-free.dev/api/v1/bulk-upload \
  -H "Accept: application/json" \
  -H "ngrok-skip-browser-warning: true" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -F "file=@/path/to/node-upload.json"
```

**Gzip-compressed JSON file:**
```bash
# Compress first
gzip -k node-upload.json          # creates node-upload.json.gz

# Upload
curl -X POST https://disguisedly-enarthrodial-kristi.ngrok-free.dev/api/v1/bulk-upload \
  -H "Accept: application/json" \
  -H "ngrok-skip-browser-warning: true" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -F "file=@/path/to/node-upload.json.gz"
```

---

## 3. Projects (Read Only)

### List All Projects
```
GET /api/v1/projects
Authorization: Bearer {token}
```

**Response:**
```json
[
  {
    "id": 1,
    "project_name": "Taytay Expansion",
    "project_code": "TY-2026",
    "client": "PLDT",
    "status": "ongoing"
  }
]
```

### Get Project with Nodes
```
GET /api/v1/projects/{id}
Authorization: Bearer {token}
```

---

## 4. Nodes

### List Nodes
```
GET /api/v1/nodes
GET /api/v1/nodes?project_id=1
GET /api/v1/nodes?search=TY
Authorization: Bearer {token}
```

### Get Node Detail
```
GET /api/v1/nodes/{id}
Authorization: Bearer {token}
```

### Get Poles of a Node
```
GET /api/v1/nodes/{id}/poles
Authorization: Bearer {token}
```

### Get Spans of a Node
```
GET /api/v1/nodes/{id}/spans
Authorization: Bearer {token}
```

### Create Node (single)
```
POST /api/v1/nodes
Authorization: Bearer {token}
```

```json
{
  "project_id": 1,
  "node_id": "TY-5232",
  "node_name": "Taytay Area 1",
  "city": "Taytay",
  "province": "Rizal",
  "team": "Team Alpha",
  "date_start": "2026-03-24",
  "due_date": "2026-04-30",
  "total_strand_length": 1500.50,
  "expected_cable": 1600.00,
  "node_count": 1,
  "amplifier": 2,
  "extender": 3,
  "tsc": 1
}
```

---

## 5. Poles

### List Poles
```
GET /api/v1/poles
GET /api/v1/poles?node_id=10
GET /api/v1/poles?search=001
Authorization: Bearer {token}
```

### Get Pole Detail
```
GET /api/v1/poles/{id}
Authorization: Bearer {token}
```

### Create Pole (single)
```
POST /api/v1/poles
Authorization: Bearer {token}
```

```json
{
  "node_id": 10,
  "pole_code": "001",
  "pole_name": "Pole 1",
  "map_latitude": 14.5547,
  "map_longitude": 121.1234
}
```

> `node_id` here is the **integer ID** from the nodes table, not the string `node_id`.

---

## 6. Pole Spans

### List Pole Spans
```
GET /api/v1/pole-spans
GET /api/v1/pole-spans?node_id=10
GET /api/v1/pole-spans?search=001
Authorization: Bearer {token}
```

### Create Pole Span (single)
```
POST /api/v1/pole-spans
Authorization: Bearer {token}
```

```json
{
  "node_id": 10,
  "from_pole_id": 55,
  "to_pole_id": 56,
  "pole_span_code": "TY:5232-001-002",
  "length_meters": 48.50,
  "runs": 1,
  "expected_cable": 49.00,
  "expected_amplifier": 1,
  "expected_powersupply": 1,
  "expected_powersupply_housing": 1
}
```

> `from_pole_id` and `to_pole_id` are **integer IDs** from the poles table.
> Use `/bulk-upload` to avoid dealing with IDs — it accepts pole codes directly.

---

## Typical Workflow

### Option A — Bulk Upload (Recommended)
```
1. POST /api/v1/login              → get token
2. GET  /api/v1/projects           → get project_id
3. POST /api/v1/bulk-upload        → upload one .json file with node + poles + spans
```

### Option B — One by One
```
1. POST /api/v1/login              → get token
2. GET  /api/v1/projects           → get project_id (integer)
3. POST /api/v1/nodes              → get node id (integer)
4. POST /api/v1/poles  (×N)        → get pole id (integer) per pole
5. POST /api/v1/pole-spans  (×N)   → create each span using pole integer IDs
```

---

## Common Errors

| Code | Reason | Fix |
|---|---|---|
| `401` | Missing or invalid token | Re-login and use the new token |
| `403` | Role not allowed | Use `admin`, `project_manager`, or `executives` account |
| `422` | Validation error | Check `errors` object in response for exact field issues |
| `422` | `from_pole_code` not found | The pole code must exist in the `poles` array of the same upload |
| `500` | Server error | Check server logs |

---

## ngrok Login Test

```bash
curl -X POST https://disguisedly-enarthrodial-kristi.ngrok-free.dev/api/v1/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "ngrok-skip-browser-warning: true" \
  -d '{"email":"admin@example.com","password":"password"}'
```
