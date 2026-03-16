
# TelcoVantage Application Documentation

## System Overview
TelcoVantage is a telecom infrastructure teardown tracking system used to manage the dismantling of aerial cable networks between poles.

The application tracks the full lifecycle of teardown operations including:

- Projects
- Nodes
- Poles
- Pole Spans
- Teardown Logs
- Image Evidence
- Cable Recovery
- Component Recovery

This system mirrors real-world telecom teardown operations performed by subcontractor teams.

---

# System Hierarchy

The data structure of the system follows this hierarchy:

Project
└── Node
    └── Pole
        └── Pole Span
            └── Teardown Log
                └── Images

Each level represents a more granular piece of the telecom infrastructure.

---

# Project

A Project represents a telecom teardown contract.

Example:

- Skycable
- Globe Telecom

A project can contain multiple Nodes.

Fields:

- project_name
- project_code
- client
- status
- project_logo

---

# Node

A Node represents a network segment inside a project.

Node IDs follow a format:

AA-0000

Example:

MC-2342
AB-0091
TX-4412

Each node tracks expected cable and components that should exist within that network segment.

Node fields include:

- project_id
- node_id
- status
- total_strand_length
- expected_cable
- actual_cable
- amplifier
- extender
- tsc

---

# Pole

Poles are physical infrastructure points where cables are mounted.

Example pole codes:

F13-292
F13-293
F13-294

Each pole belongs to a node.

Pole fields:

- node_id
- pole_code
- status
- remarks

Pole statuses:

pending
in_progress
completed

---

# Pole Span

A Pole Span represents a cable connection between two poles.

Example:

F13-292 → F13-294

Cable exists **between poles**, so teardown operations must occur at the span level.

Span fields:

- node_id
- from_pole_id
- to_pole_id
- length_meters
- runs
- expected_cable
- expected_node
- expected_amplifier
- expected_extender
- expected_tsc
- status

Cable calculation:

expected_cable = length_meters × runs

Example:

30 meters × 3 runs = 90 meters

Span statuses:

- pending
- in_progress
- completed
- blocked

---

# Teardown Workflow

Field teams may begin teardown from **any pole**.

Example:

Start at pole F13-292

Connected spans may be:

F13-292 → F13-293
F13-292 → F13-294
F13-292 → F13-295

The user selects which span to teardown.

---

# Span Teardown Process

Example span:

F13-292 → F13-294

Step 1 – Starting pole

The team captures:

- before photo
- after photo
- pole tag

Step 2 – Destination pole

The team captures:

- before photo
- after photo
- pole tag

Step 3 – Cable collection

System asks:

Did you collect all cable?

If NO:

User must input:

- unrecovered cable meters
- reason
- photo evidence

---

# Component Recovery

Next question:

Did you collect collectable components?

Expected values come from the span.

Example expected:

node = 0
amplifier = 1
extender = 0
tsc = 10

User inputs collected values.

---

# Teardown Logs

Each completed span generates a teardown log.

Fields stored:

- project_id
- node_id
- pole_span_id
- team
- status
- did_collect_all_cable
- collected_cable
- unrecovered_cable
- unrecovered_reason
- unrecovered_image
- did_collect_components
- collected_node
- collected_amplifier
- collected_extender
- collected_tsc
- expected snapshots
- started_at
- finished_at
- submitted_by

---

# Teardown Images

Each teardown log stores images for verification.

Image types:

- before
- after
- pole_tag
- missing_cable

Example:

Pole A
before
after
pole_tag

Pole B
before
after
pole_tag

Images are stored as:

teardown/{log_id}/before.jpg
teardown/{log_id}/after.jpg
teardown/{log_id}/pole_tag.jpg

---

# Automatic Pole Status Logic

When a span is completed:

pole_spans.status = completed

System recalculates pole status.

Rules:

If all spans connected to a pole are completed:

pole.status = completed

If some spans are completed:

pole.status = in_progress

If none are completed:

pole.status = pending

---

# Mobile Application Flow

User taps a pole on the map.

System returns all connected spans.

Example:

[
  { "span_id": 12, "from": "F13-292", "to": "F13-293", "status": "pending" },
  { "span_id": 13, "from": "F13-292", "to": "F13-294", "status": "completed" }
]

User selects span and submits teardown report.

---

# Features

Node based teardown tracking
Span level cable accounting
Component recovery tracking
Missing cable reporting
Before and after verification
Pole tag verification
Automatic pole completion logic
Multi-team field operations
Mobile friendly workflow

---

# Future Improvements

Recommended upgrades:

- GPS capture
- Offline mobile sync
- QR pole scanning
- Map visualization
- Cable inventory reconciliation
- Analytics dashboard

---

# Architecture Principle

Cable exists **between poles**.

Therefore teardown must be recorded **per span**.

This guarantees:

- accurate cable accounting
- correct infrastructure tracking
- reliable pole completion logic

token for mobile app:


const API_BASE = 'https://disguisedly-enarthrodial-kristi.ngrok-free.dev/api/v1';
const TOKEN = '4|T1chFnsfYC2VaLzlWxCBDM0XcMvle0rkQwrXlem6f37c437b';

fetch(`${API_BASE}/projects`, {
  headers: {
    'Authorization': `Bearer ${TOKEN}`,
    'Accept': 'application/json',
    'ngrok-skip-browser-warning': '1',
  }
});

bearer token: 4|T1chFnsfYC2VaLzlWxCBDM0XcMvle0rkQwrXlem6f37c437b