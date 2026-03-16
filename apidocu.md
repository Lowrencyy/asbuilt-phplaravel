All API Endpoints
Base URL: https://disguisedly-enarthrodial-kristi.ngrok-free.dev/api/v1

Always add this header to every request:


ngrok-skip-browser-warning: 1
Accept: application/json
1. LOGIN (no token needed)

POST /api/v1/login
Body (JSON):
{
  "email": "your@email.com",
  "password": "yourpassword"
}
Copy the token from the response — use it for all requests below as Authorization: Bearer {token} (1|2V1aDlCM4wo5pNz2REpYzjy24KD1nqXtjc8DfFON3a58b819)

2. Who am I

GET /api/v1/me
3. Projects

GET /api/v1/projects
GET /api/v1/projects/1
4. Nodes

GET /api/v1/nodes
GET /api/v1/nodes?project_id=1
GET /api/v1/nodes/1
GET /api/v1/nodes/1/poles        ← poles under node 1
GET /api/v1/nodes/1/spans        ← all spans under node 1
5. Poles

GET /api/v1/poles/1
GET /api/v1/poles/1/spans        ← outgoing spans from pole 1
6. Submit Teardown Log

POST /api/v1/teardown-logs
Body (JSON):
{
  "node_id": 1,
  "pole_span_id": 1,
  "team": "Team A",
  "did_collect_all_cable": true,
  "collected_cable": 150.5,
  "unrecovered_cable": 0,
  "did_collect_components": true,
  "collected_node": 1,
  "collected_amplifier": 0,
  "collected_extender": 2,
  "collected_tsc": 0,
  "submitted_by": "Juan dela Cruz",
  "captured_latitude": 14.6760,
  "captured_longitude": 121.0437,
  "gps_accuracy_meters": 5.2,
  "gps_source": "device_gps",
  "offline_mode": false,
  "captured_at_device": "2026-03-10T10:32:00+08:00"
}
7. Upload Image

POST /api/v1/teardown-logs/1/images
Body (form-data):
  image      → [file]
  pole_id    → 1
  photo_type → before   (before / after / pole_tag / supporting / missing_cable)
8. View Logs

GET /api/v1/teardown-logs
GET /api/v1/teardown-logs?node_id=1
GET /api/v1/teardown-logs/1
9. Teardown Submissions

GET /api/v1/teardown-submissions
GET /api/v1/teardown-submissions?node_id=1
GET /api/v1/teardown-submissions/1
GET /api/v1/teardown-submissions/1/remarks
10. Logout

POST /api/v1/logout