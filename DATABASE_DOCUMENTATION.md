# TelcoVantage Database Documentation

This document explains the core database design of the TelcoVantage Teardown System so the next developer can quickly understand how data flows through the app.

## Overview

The system tracks telecom teardown operations at the **span level**.

Important principle:

- A **pole** is a location / junction point.
- A **pole span** is the actual cable connection between two poles.
- A **teardown log** is the real field transaction submitted by a team for one selected span.

Because cable exists **between poles**, teardown must be recorded on `pole_spans`, not directly on `poles`.

## Core Data Flow

```text
Project
  -> Node
      -> Pole
      -> PoleSpan
           -> TeardownLog
                -> TeardownLogImage
```

## Tables

### 1) `projects`

Represents a teardown contract or client project.

Typical fields:

- `id`
- `project_name`
- `project_code`
- `client`
- `status`
- `project_logo`
- `created_at`
- `updated_at`

Example records:

- Skycable
- Globe Telecom

---

### 2) `nodes`

Represents a logical network segment within a project.

Important note:
- `node_id` is **unique per project**, not globally unique.
- Example: `MC-2342`, `AB-1022`

Typical fields:

- `id`
- `project_id`
- `node_id`
- `data_source` (`manual` or `ai`)
- `sites`
- `province`
- `city`
- `team`
- `status`
- `approved_by`
- `date_start`
- `due_date`
- `date_finished`
- `file`
- `total_strand_length`
- `expected_cable`
- `actual_cable`
- `extender`
- `node_count`
- `amplifier`
- `tsc`
- `progress_percentage`
- timestamps

#### Meaning of key node metrics

- `total_strand_length` = total physical span distance inside the node
- `expected_cable` = expected cable to recover from all spans under the node
- `actual_cable` = actual recovered cable reported later by teams
- `extender`, `amplifier`, `tsc`, `node_count` = expected totals for the node

#### Relationship

- one project has many nodes
- one node belongs to one project

---

### 3) `poles`

Represents individual poles inside a node.

Typical fields:

- `id`
- `node_id`
- `pole_code`
- `status`
- `remarks`
- timestamps

Example pole codes:

- `F13-292`
- `F13-293`
- `F13-294`

#### Pole status meaning

- `pending` = no connected spans completed yet
- `in_progress` = some connected spans completed
- `completed` = all connected spans completed

#### Important rule

A pole is **not** completed just because one side is cut.

Example:

```text
F13-292 --- F13-293 --- F13-298
```

If only `F13-292 -> F13-293` is completed, then:

- `F13-292` may become completed if it has no other connected spans
- `F13-293` is still `in_progress` because it is still connected to `F13-298`

---

### 4) `pole_spans`

Represents the connection between two poles.

This is the **most important operational table**.

Typical fields:

- `id`
- `node_id`
- `from_pole_id`
- `to_pole_id`
- `length_meters`
- `runs`
- `expected_cable`
- `expected_node`
- `expected_amplifier`
- `expected_extender`
- `expected_tsc`
- `status`
- timestamps

#### Why this table exists

A single pole can connect to multiple directions. Example:

```text
F13-292 -> F13-293
F13-292 -> F13-294
F13-292 -> F13-295
F13-292 -> F13-296
```

The real work is done per **span**, not per pole.

#### Core formula

```text
expected_cable = length_meters * runs
```

Example:

```text
30 meters * 3 runs = 90 meters
```

#### Span status meaning

- `pending`
- `in_progress`
- `completed`
- `blocked`

#### Unique logic

The app currently stores spans using:

- `from_pole_id`
- `to_pole_id`

The next developer should avoid inserting the reverse duplicate of the same span unless the business logic explicitly needs directional duplication.

Example duplicate risk:

- `292 -> 294`
- `294 -> 292`

These usually represent the same physical span.

---

### 5) `teardown_logs`

Represents one actual field submission for one selected span.

This is the **real-world report** submitted by subcontractors or field teams.

Typical fields:

- `id`
- `project_id`
- `node_id`
- `pole_span_id`
- `team`
- `status`
- `did_collect_all_cable`
- `collected_cable`
- `unrecovered_cable`
- `unrecovered_reason`
- `unrecovered_image`
- `did_collect_components`
- `collected_node`
- `collected_amplifier`
- `collected_extender`
- `collected_tsc`
- `expected_cable_snapshot`
- `expected_node_snapshot`
- `expected_amplifier_snapshot`
- `expected_extender_snapshot`
- `expected_tsc_snapshot`
- `started_at`
- `finished_at`
- `submitted_by`
- timestamps

#### Why snapshots exist

Snapshots preserve the expected values shown to the user at the time of submission.

Even if engineering values later change, the submitted record still shows what the field team saw during teardown.

#### Cable logic

If all cable is collected:

```text
collected_cable = expected_cable_snapshot
unrecovered_cable = 0
```

If not all cable is collected:

```text
collected_cable = expected_cable_snapshot - unrecovered_cable
```

#### Example

- span length = 63m
- runs = 4
- expected cable = 252m
- unrecovered cable = 0
- collected cable = 252m

---

### 6) `teardown_log_images`

Represents photo evidence linked to one teardown log.

Typical fields:

- `id`
- `teardown_log_id`
- `pole_id`
- `photo_type`
- `image_path`
- timestamps

#### Supported photo types

- `before`
- `after`
- `pole_tag`
- `missing_cable`
- `supporting` (optional future use)

#### Why images belong here

The same pole can appear in multiple teardown operations.

Example:

- `F13-292 -> F13-294`
- `F13-292 -> F13-293`

That means `F13-292` can have many before/after images across different spans.

Therefore, images should belong to the **teardown log**, not directly to the pole master record.

---

## Business Rules

### 1) Node uniqueness

`node_id` is unique **per project**.

Allowed:

- Project A -> `P-001`
- Project B -> `P-001`

Not allowed:

- Project A -> `P-001`
- Project A -> `P-001` again

---

### 2) Span-based teardown

A teardown operation is always tied to a selected span.

Example:

```text
F13-292 -> F13-294
```

This one span can have:

- cable report
- missing cable report
- collectable report
- before/after photos on both poles
- pole tag verification

---

### 3) Pole completion rule

A pole becomes `completed` only when **all connected spans are completed**.

Pseudo logic:

```text
if connected_completed_spans == total_connected_spans
    pole.status = completed
elseif connected_completed_spans > 0
    pole.status = in_progress
else
    pole.status = pending
```

---

### 4) Expected vs Actual

`pole_spans` stores **expected engineering values**.

`teardown_logs` stores **actual field results**.

This separation is intentional and important.

---

## Relationships Summary

### Project
- hasMany Nodes
- hasMany TeardownLogs

### Node
- belongsTo Project
- hasMany Poles
- hasMany PoleSpans
- hasMany TeardownLogs

### Pole
- belongsTo Node
- hasMany outgoing PoleSpans through `from_pole_id`
- hasMany incoming PoleSpans through `to_pole_id`
- hasMany TeardownLogImages

### PoleSpan
- belongsTo Node
- belongsTo Pole (`fromPole`)
- belongsTo Pole (`toPole`)
- hasMany TeardownLogs

### TeardownLog
- belongsTo Project
- belongsTo Node
- belongsTo PoleSpan
- hasMany TeardownLogImages

### TeardownLogImage
- belongsTo TeardownLog
- belongsTo Pole

---

## Developer Notes

### Recommended API idea

When a user selects a pole in the mobile app, return all connected spans.

Example output:

```json
[
  {
    "span_id": 12,
    "from": "F13-292",
    "to": "F13-293",
    "status": "pending"
  },
  {
    "span_id": 13,
    "from": "F13-292",
    "to": "F13-294",
    "status": "completed"
  }
]
```

### Recommended query pattern

Find all connected spans for one pole:

```php
PoleSpan::where('from_pole_id', $poleId)
    ->orWhere('to_pole_id', $poleId)
    ->get();
```

### Performance note

As the app grows, consider indexing:

- `nodes.project_id`
- `poles.node_id`
- `pole_spans.node_id`
- `pole_spans.from_pole_id`
- `pole_spans.to_pole_id`
- `teardown_logs.project_id`
- `teardown_logs.node_id`
- `teardown_logs.pole_span_id`
- `teardown_log_images.teardown_log_id`
- `teardown_log_images.pole_id`

---

## Seeder / Demo Data Notes

Current demo data generation supports:

- 2 projects
- 105 nodes
- random poles per node
- random spans per node
- 5 sample teardown logs
- before/after/pole tag images

This is intended for UI testing and development.

---

## Future Improvements

Recommended future enhancements:

- offline sync for field teams
- GPS capture
- QR / barcode pole scanning
- audit trail for status changes
- map visualization
- inventory reconciliation
- team/user auth roles
- analytics dashboards

---

## Final Architecture Principle

The most important rule of this system is:

> **Cable exists between poles, so teardown must be recorded on spans.**

That is the reason this app uses:

- `poles` for locations / endpoints
- `pole_spans` for physical connections
- `teardown_logs` for actual field submissions

