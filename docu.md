TelcoVantage Developer Guide
Overview

TelcoVantage is a telecom teardown tracking system.

It manages the full teardown lifecycle:

Project
→ Node
→ Pole
→ Pole Span
→ Teardown Log
→ Submission Review
→ Warehouse Receipt

The most important design rule is this:

Cable exists between poles, so actual teardown work must be recorded on spans.

That is why:

poles are infrastructure points

pole spans are work units

teardown logs are field evidence

submissions are workflow and approval records

warehouse receipts are delivery and inventory records

Core tables and their roles
projects

Top-level contract or client project.

Used for:

project list

client grouping

project progress dashboard

Main fields:

project_name

project_code

client

status

project_logo

nodes

A network segment inside a project.

Used for:

expected cable totals

expected collectible totals

progress display

grouping poles and spans

Main fields:

project_id

node_id

total_strand_length

expected_cable

actual_cable

amplifier

extender

tsc

progress_percentage

status

poles

Physical poles inside a node.

Used for:

pole list

pole status

showing connected spans

Main fields:

node_id

pole_code

status

remarks

pole_spans

A cable connection between two poles.

Used for:

expected cable calculation

expected collectible items

span completion state

Main fields:

node_id

from_pole_id

to_pole_id

length_meters

runs

expected_cable

expected_node

expected_amplifier

expected_extender

expected_tsc

status

Formula:

expected_cable = length_meters × runs
teardown_logs

Actual field work submitted by linemen.

Used for:

source of truth for actual teardown

actual collected cable

actual collected components

missing cable declaration

Main fields:

project_id

node_id

pole_span_id

team

did_collect_all_cable

collected_cable

unrecovered_cable

unrecovered_reason

did_collect_components

collected_node

collected_amplifier

collected_extender

collected_tsc

started_at

finished_at

submitted_by

teardown_log_images

Photo evidence for a teardown log.

Used for:

before photos

after photos

pole tag photos

missing cable proof

Main fields:

teardown_log_id

pole_id

photo_type

image_path

teardown_submissions

Daily report / workflow batch.

Used for:

PM review

TelcoVantage review

report status

report totals

manual vs reported flag

Main fields:

project_id

node_id

report_date

team

status

total_cable

total_node

total_amplifier

total_extender

total_tsc

item_status

warehouse_location

entry_mode

manual_reason

manually_added_by

submitted_by

submitted_at

pm_reviewed_by

pm_reviewed_at

telcovantage_reviewed_by

telcovantage_reviewed_at

revision_no

teardown_submission_items

Links a submission to its raw teardown logs.

Used for:

traceability

auditability

regenerating totals if needed

Main fields:

teardown_submission_id

teardown_log_id

submission_remarks

Stores review comments and rework notes.

Used for:

PM remarks

TelcoVantage remarks

rework cycle

audit history

Main fields:

teardown_submission_id

teardown_log_id nullable

pole_id nullable

from_role

from_user

action

remarks

warehouse_receipts

Stores grouped delivery / receiving records.

Used for:

warehouse handoff

delivery proof

inventory summary

source pole list

Main fields:

warehouse_receipt_id

teardown_submission_id

project_id

node_id

delivery_date

teardown_date

pole_source

collected_cable

collected_node

collected_amplifier

collected_extender

collected_tsc

delivery_proof

warehouse_location

status

entry_mode

manual_reason

manually_added_by

Model relationships
Project

hasMany Node

hasMany TeardownSubmission

hasMany WarehouseReceipt

Node

belongsTo Project

hasMany Pole

hasMany PoleSpan

hasMany TeardownLog

hasMany TeardownSubmission

hasMany WarehouseReceipt

Pole

belongsTo Node

hasMany outgoing PoleSpan through from_pole_id

hasMany incoming PoleSpan through to_pole_id

hasMany TeardownLogImage

PoleSpan

belongsTo Node

belongsTo Pole as fromPole

belongsTo Pole as toPole

hasMany TeardownLog

TeardownLog

belongsTo Project

belongsTo Node

belongsTo PoleSpan

hasMany TeardownLogImage

TeardownLogImage

belongsTo TeardownLog

belongsTo Pole

TeardownSubmission

belongsTo Project

belongsTo Node

hasMany TeardownSubmissionItem

hasMany SubmissionRemark

hasMany WarehouseReceipt

TeardownSubmissionItem

belongsTo TeardownSubmission

belongsTo TeardownLog

SubmissionRemark

belongsTo TeardownSubmission

optionally belongsTo TeardownLog

optionally belongsTo Pole

WarehouseReceipt

belongsTo TeardownSubmission

belongsTo Project

belongsTo Node

Controllers you should build
ProjectController

Purpose:

manage projects

show project details

list project nodes

Methods:

index

create

store

show

edit

update

destroy

NodeController

Purpose:

manage nodes under a project

show node summary

show poles and spans

Methods:

index

create

store

show

edit

update

destroy

PoleController

Purpose:

manage poles under a node

show connected spans

show pole completion state

Methods:

index

create

store

show

edit

update

destroy

PoleSpanController

Purpose:

manage spans between poles

define engineering values

Methods:

index

create

store

show

edit

update

destroy

Important logic:

compute expected_cable in backend

validate no duplicate span in same node

TeardownLogController

Purpose:

receive actual field teardown submissions

Methods:

store

show

update if editing is allowed

Main logic:

validate selected span

validate image set

compute actual collected cable

create teardown log

create teardown images

mark span completed

recalculate pole statuses

recalculate node actuals and progress

This should use a DB transaction.

TeardownSubmissionController

Purpose:

generate daily report cards from teardown logs

optionally allow manual submissions

Methods:

index

show

storeFromDailyLogs

storeManual

update

Important rule:

default source is reported

manual must be clearly flagged with entry_mode = manual

SubmissionReviewController

Purpose:

manage PM and TelcoVantage workflow

Methods:

submitToPm

pmApprove

pmReturnForRework

submitToTelcovantage

tvApprove

tvReturnForRework

addRemark

WarehouseReceiptController

Purpose:

create grouped warehouse receipt from approved submissions

show warehouse totals and proof

Methods:

index

show

storeFromSubmission

markDelivered

updateStatus

Services you should create

Keep controllers thin. Put heavy logic into services.

TeardownLogService

Handles:

cable calculations

teardown log creation

image creation

span completion

StatusRecalculationService

Handles:

pole status recalculation

node actual cable recalculation

node progress recalculation

SubmissionGeneratorService

Handles:

getting daily teardown logs

computing totals

creating teardown_submissions

attaching teardown_submission_items

SubmissionReviewService

Handles:

PM approve / rework

TelcoVantage approve / rework

remark creation

revision increment

WarehouseReceiptService

Handles:

creating warehouse receipts from approved submissions

grouping pole sources

setting delivery state

Views you should build
Project pages

project list

project create form

project detail page

Project detail page should show:

project info

node list

overall progress

Node pages

node list under project

node create form

node detail page

Node detail page should show:

expected cable

actual cable

progress

poles

spans

node status

Pole pages

pole list under node

pole detail page

Pole detail page should show:

pole code

connected spans

current status

whether fully completed

Pole span pages

span list under node

span create form

span detail page

Span detail should show:

from pole

to pole

length

runs

expected cable

expected collectables

status

related teardown logs

Lineman dashboard

This is one of the most important pages.

Should show:

today’s completed spans

fully torn down poles for the day

total collected cable for the day

total node

total amplifier

total extender

total tsc

button to generate or submit daily report

Submission pages

submission list

submission detail page

optional manual submission create page

Submission detail should show:

report header

linked teardown logs

totals

status

remarks trail

PM action buttons

TelcoVantage action buttons

Review pages

Separate role-based review screens for:

Team PM

TelcoVantage

Each should show:

report summary

log list

image evidence

remarks thread

approve button

rework button

Warehouse pages

warehouse receipt list

warehouse receipt detail page

Warehouse detail should show:

warehouse receipt id

node id

delivery date

teardown date

pole source list

collected totals

delivery proof

warehouse location

status

System functionality
1. Infrastructure setup

Admin creates:

project

node

poles

pole spans

At this stage, the system defines expected cable and expected collectible items.

2. Teardown logging

Lineman selects a span and submits:

before photos

after photos

pole tags

actual cable collected

unrecovered cable if any

collected node/amplifier/extender/tsc

System automatically:

saves the teardown log

saves images

marks span completed

recalculates poles

recalculates node totals and progress

3. Daily report generation

The system groups daily teardown logs into a submission.

Normally this should come from logs:

same date

same team

same node

same project

Totals are auto-generated from logs.

4. PM review

PM reviews the submission.

PM can:

approve

return for rework

add remarks

optionally edit allowed fields

5. TelcoVantage review

TelcoVantage reviews PM-approved submissions.

TelcoVantage can:

approve

return for rework

add remarks

6. Warehouse handoff

Once a submission is approved, warehouse receipt can be created.

Warehouse sees:

source node

source poles

collected totals

delivery proof

location

status

Website flow step by step
Step 1

Admin creates a project.

Step 2

Admin creates nodes under the project.

Step 3

Admin creates poles under each node.

Step 4

Admin creates pole spans between poles and defines engineering values:

length

runs

expected cable

expected collectibles

Step 5

Lineman opens the system and selects a pole.

The system shows connected spans:

from pole

to pole

status

Step 6

Lineman selects a span and submits teardown.

System stores:

raw teardown log

image evidence

Then updates:

span status

pole status

node totals

Step 7

At the end of the day, the system builds a submission from the day’s teardown logs.

Step 8

PM reviews the submission.
If correct:

approve

If incorrect:

return for rework

add remarks

Step 9

TelcoVantage reviews the PM-approved submission.
If correct:

approve

If incorrect:

return for rework

add remarks

Step 10

Warehouse receipt is created from approved submission.
Warehouse can then manage delivery or received status.

Important business rules
Span rule

expected_cable = length_meters × runs

Teardown rule

Actual cable should come from field input:

if all recovered, actual = expected

if not all recovered, actual = expected - unrecovered

Pole rule

A pole becomes completed only when all its connected spans are completed.

Submission rule

A submission should normally be generated from teardown logs.

Manual submission rule

Manual add is allowed, but must always be marked:

entry_mode = manual

manual_reason

manually_added_by

Warehouse rule

Warehouse receipts should normally be generated from approved submissions, not random manual encoding.

API notes for mobile

The mobile app should mainly work with:

poles

spans

teardown logs

daily report generation

Suggested endpoints
Get connected spans of a pole

GET /api/mobile/poles/{pole}/spans

Returns:

connected spans

from pole

to pole

span status

expected cable

Get span detail

GET /api/mobile/spans/{span}

Returns:

from pole

to pole

expected cable

expected collectibles

current status

Submit teardown log

POST /api/mobile/spans/{span}/teardown

Payload should include:

team

did_collect_all_cable

unrecovered_cable if any

collected components

image uploads

Get daily summary

GET /api/mobile/daily-summary?date=YYYY-MM-DD&team=TEAM

Returns:

completed spans

fully completed poles

total collected cable

total node

total amplifier

total extender

total tsc

Generate daily submission

POST /api/mobile/submissions/generate

Payload:

project_id

node_id

team

report_date

System should auto-build the submission from logs.

Suggested Form Requests

Create request classes for validation:

StoreProjectRequest

StoreNodeRequest

StorePoleRequest

StorePoleSpanRequest

StoreTeardownLogRequest

StoreSubmissionRequest

ReviewSubmissionRequest

StoreWarehouseReceiptRequest

Recommended implementation order
Phase 1

Build infrastructure CRUD:

Project

Node

Pole

PoleSpan

Phase 2

Build field teardown flow:

TeardownLogController

image upload

span completion

pole recalculation

node recalculation

Phase 3

Build lineman dashboard and daily summary:

daily completed spans

daily completed poles

daily totals

submission generation

Phase 4

Build review workflow:

PM review

TelcoVantage review

remarks trail

Phase 5

Build warehouse workflow:

warehouse receipts

delivery proof

receiving status

Final architecture summary
Project
-> Node
-> Pole
-> PoleSpan
-> TeardownLog
-> TeardownLogImage

TeardownLog
-> TeardownSubmission
-> SubmissionRemark
-> WarehouseReceipt

This is the full logical structure of the system.

Notes for the next developer

Do not move cable logic to poles. Keep it on spans.

Do not trust expected_cable from frontend.

Keep teardown_logs as the source of truth for field activity.

Use submissions as workflow/reporting layer.

Use entry_mode to distinguish reported vs manual records.

Keep remarks history for audit.

Generate warehouse receipts from approved submissions whenever possible.



location path map for backend team: 


Paano mo i-compute ang box

Kapag gumagawa ka ng submission from linked teardown logs:

Step 1

Kunin mo lahat ng linked logs na may valid GPS.

Step 2

Compute mo:

$minLat = min(all latitudes);
$maxLat = max(all latitudes);
$minLng = min(all longitudes);
$maxLng = max(all longitudes);
Step 3

Compute center:

$centerLat = ($minLat + $maxLat) / 2;
$centerLng = ($minLng + $maxLng) / 2;
Step 4

Save mo sa teardown_submissions.

Example logic

Kung may logs ka na ganito:

14.123100, 121.456100
14.123500, 121.456700
14.122900, 121.456300
14.123300, 121.456900

Then:

minLat = 14.122900

maxLat = 14.123500

minLng = 121.456100

maxLng = 121.456900

Iyan ang box mo.

Center:

centerLat = 14.123200

centerLng = 121.456500

Paano siya i-render sa dashboard

Sa frontend map page:

1. Draw markers

Loop mo lahat ng linked teardown logs.

Each log:

lat

lng

popup info

Example popup:

node id

pole span

team

captured time

accuracy

offline/online

2. Draw rectangle

Use:

southwest corner = minLat, minLng

northeast corner = maxLat, maxLng

So may isang box na nakapalibot sa lahat ng markers.

3. Optional center pin

Pwede ka ring maglagay ng center marker for the whole submission.

Best UI for backend team

Sa submission detail page, magandang layout:

Top section

submission id

report date

team

node id

status

total cable

total amplifier

total extender

total node

total tsc

Map section

markers per teardown log

one scope box

optional center pin

Logs section

linked teardown logs

photo evidence

remarks

approval actions

Important note

Ang box mo ay scope lang, hindi exact cable line path.

So ang tamang interpretation ay:

“Ito ang approximate area ng mga teardown submissions sa report na ito.”

Hindi:

“Ito ang exact line ng cable na binaklas.”

For audit, enough na enough na ito.

Best practical rule
If only one teardown log

Walang sense ang malaking box.
Pwede mong:

marker lang ipakita

or very small box around the point

If many logs

Show:

all markers

one rectangle scope

Recommended controller/service logic

Kapag gumagawa ka ng TeardownSubmission:

gather linked teardown logs

filter logs with non-null coordinates

compute min/max lat/lng

compute center

count GPS logs

detect if any offline_mode = true

save to submission

Final answer

Yes — markers per teardown log plus one scope box for the whole report is the best design for your backend audit map.

That gives you:

actual points

approximate working area

easy validation kung saan sila nagtrabaho

Kapag gusto mo, next ibibigay ko sa’yo ang exact Laravel service logic for GPS summary generation


<!-- wew -->

Best PM report map design

Sa iisang map, puwede mong ipakita ang 3 layers:

1. Scope box

Ito ang whole area coverage ng report for that day.

Galing ito sa:

gps_min_latitude

gps_max_latitude

gps_min_longitude

gps_max_longitude

Meaning:

“dito lang sa area na ito umiikot ang submission/report na ito”

2. Span lines

Ito ang actual spans na binaklas.

Best source nito:

from_pole_id

to_pole_id

tapos kukunin mo ang official pole coordinates from poles

So ang dotted line ay:

pole A → pole B

Hindi siya dapat galing sa actual picture GPS lang.

3. GPS markers

Ito ang actual position ng lineman noong nag-picture / nag-submit

Source nito:

teardown_logs.captured_latitude

teardown_logs.captured_longitude

So ang marker means:

“dito banda siya tumayo noong nag-capture”

Important distinction

Ito ang pinaka-important:

Span line

Official infrastructure line ito.

Dapat manggaling sa:

poles.map_latitude

poles.map_longitude

for both from_pole_id and to_pole_id

GPS marker

Actual audit point ito.

Dapat manggaling sa:

teardown_logs GPS

So sa PM map:

line = ano ang binaklas

marker = saan siya nag-picture

box = overall scope ng report

Yan ang pinaka-malinis na design.

So yes, puwede siyang magmukhang ganyan

Exactly ganito ang concept:

may scope box

may dotted span lines

may markers per teardown log/photo capture

At sobrang useful nito sa PM reports kasi makikita nila agad:

nasa tamang area ba yung report

tama ba ang span na dineclare

malapit ba ang captured GPS sa actual pole/span

may suspicious ba na sobrang layo ang marker

Best map legend for PM

Pwede mong gawin:

Blue dotted line = completed span

Yellow/Orange dotted line = pending / incomplete span

Red dotted line = returned for rework / issue

Pin marker = captured GPS of lineman

Transparent rectangle = daily report scope area

Optional:

Green center pin = submission/report center

Paano siya gagana sa data mo
Needed data
For box

Sa teardown_submissions:

gps_min_latitude

gps_max_latitude

gps_min_longitude

gps_max_longitude

gps_center_latitude

gps_center_longitude

For span lines

Sa poles:

map_latitude

map_longitude

Sa pole_spans:

from_pole_id

to_pole_id

For markers

Sa teardown_logs:

captured_latitude

captured_longitude

gps_accuracy_meters

captured_at_device

offline_mode