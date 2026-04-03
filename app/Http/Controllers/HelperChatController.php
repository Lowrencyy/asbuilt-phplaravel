<?php

namespace App\Http\Controllers;

use App\Models\LinemanLocation;
use App\Models\Node;
use App\Models\Pole;
use App\Models\Project;
use App\Models\TeardownLog;
use App\Models\TeardownSubmission;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HelperChatController extends Controller
{
    private const OLLAMA_URL   = 'http://127.0.0.1:11434/api/generate';
    private const OLLAMA_MODEL = 'phi3:latest';

    // ── All known status values across all tables ────────────────────────────
    private const STATUS_KEYWORDS = [
        // nodes / projects
        'ongoing', 'on going', 'on-going',
        'completed', 'complete',
        'pending',
        'on hold', 'on-hold', 'onhold',
        'active', 'inactive',
        // poles
        'done',
        // teardown submissions
        'submitted', 'draft', 'approved', 'rejected',
        // warehouse / items
        'pending_delivery', 'onfield', 'on field',
        // lineman
        'online', 'offline', 'last seen',
    ];

    public function chat(Request $request): JsonResponse
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $userMessage  = trim($request->input('message'));
        $dbContext    = $this->fetchRelevantData($userMessage);
        $systemPrompt = $this->buildSystemPrompt($dbContext);

        try {
            $response = Http::timeout(90)->post(self::OLLAMA_URL, [
                'model'  => self::OLLAMA_MODEL,
                'prompt' => $systemPrompt . "\n\nUser: " . $userMessage . "\nAssistant:",
                'stream' => false,
            ]);

            if (! $response->successful()) {
                return response()->json(['reply' => 'Ollama is not reachable. Make sure it is running (`ollama serve`).']);
            }

            return response()->json(['reply' => trim($response->json('response') ?? 'No response from model.')]);
        } catch (\Exception $e) {
            Log::error('HelperChat Ollama error: ' . $e->getMessage());
            return response()->json(['reply' => 'Could not connect to Ollama: ' . $e->getMessage()]);
        }
    }

    // ════════════════════════════════════════════════════════════════════════
    //  Intent detection + DB context builder
    // ════════════════════════════════════════════════════════════════════════

    private function fetchRelevantData(string $message): string
    {
        $msg = strtolower($message);

        // ── Entity flags ────────────────────────────────────────────────────
        $wantsPoles      = $this->mentions($msg, ['pole', 'poles']);
        $wantsNodes      = $this->mentions($msg, ['node', 'nodes']);
        $wantsProjects   = $this->mentions($msg, ['project', 'projects']);
        $wantsLinemen    = $this->mentions($msg, ['lineman', 'linemen', 'liner', 'field crew', 'crew', 'worker', 'workers']);
        $wantsTeardown   = $this->mentions($msg, ['teardown', 'tear down', 'submission', 'report', 'daily report']);
        $wantsUsers      = $this->mentions($msg, ['user', 'users', 'account', 'accounts', 'employee', 'staff']);
        $wantsStatus     = $this->mentions($msg, array_merge(['status', 'progress', 'update'], self::STATUS_KEYWORDS));
        $wantsCount      = $this->mentions($msg, ['how many', 'count', 'total', 'number of', 'ilan', 'lahat']);
        $wantsAll        = $this->mentions($msg, ['all', 'overview', 'summary', 'lahat', 'list']);

        $context = '';

        // ── 1. Specific pole lookup: "pole 101", "pole-BGC-001" ─────────────
        preg_match_all('/\bpole[s]?[\s\-#]*([A-Z0-9\-]+)\b/i', $message, $poleMatches);
        $specificPoleCodes = array_unique(array_filter(
            $poleMatches[1] ?? [],
            fn($v) => ! in_array(strtolower($v), ['status', 'count', 'code', 'name', 'id', 'list', 'all', 's'])
        ));

        if (! empty($specificPoleCodes)) {
            $poles = Pole::with('node')->whereIn('pole_code', $specificPoleCodes)->get();
            $context .= "=== Pole Records ===\n";
            if ($poles->isEmpty()) {
                $context .= 'No poles found with code(s): ' . implode(', ', $specificPoleCodes) . "\n";
            } else {
                foreach ($poles as $p) {
                    $context .= sprintf(
                        "Pole Code: %s | Name: %s | Status: %s | Node: %s | Remarks: %s | Completed: %s\n",
                        $p->pole_code, $p->pole_name ?? 'N/A', $p->status,
                        $p->node?->node_id ?? 'N/A', $p->remarks ?? 'None',
                        $p->completed_at?->format('Y-m-d H:i') ?? 'Not yet'
                    );
                }
            }
            return $context; // specific lookup — no need for more context
        }

        // ── 2. Specific node lookup: "node BGC-225" ─────────────────────────
        preg_match_all('/\bnode[s]?[\s\-#]*([A-Z0-9][A-Z0-9\-]{1,})\b/i', $message, $nodeMatches);
        $specificNodeIds = array_unique(array_filter($nodeMatches[1] ?? [], fn($v) => strlen($v) > 1));

        if (! empty($specificNodeIds)) {
            $nodes = Node::with('subcontractor')->withCount('poles')->whereIn('node_id', $specificNodeIds)->get();
            $context .= "=== Node Records ===\n";
            if ($nodes->isEmpty()) {
                $context .= 'No nodes found with ID(s): ' . implode(', ', $specificNodeIds) . "\n";
            } else {
                foreach ($nodes as $n) {
                    $context .= sprintf(
                        "Node ID: %s | Name: %s | Status: %s | Province: %s | City: %s | Subcon: %s | Progress: %s%% | Poles: %d\n",
                        $n->node_id, $n->node_name ?? 'N/A', $n->status,
                        $n->province ?? 'N/A', $n->city ?? 'N/A',
                        $n->subcontractor?->name ?? 'N/A',
                        $n->progress_percentage ?? '0', $n->poles_count
                    );
                }
            }
            return $context;
        }

        // ── 3. Poles section ─────────────────────────────────────────────────
        if ($wantsPoles || (! $wantsNodes && ! $wantsProjects && ! $wantsLinemen && ! $wantsTeardown && ! $wantsUsers && $wantsCount)) {
            $total    = Pole::count();
            $byStatus = Pole::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

            $context .= "=== Poles Summary ===\n";
            $context .= "Total poles: {$total}\n";
            foreach ($byStatus as $status => $cnt) {
                $context .= "  - {$status}: {$cnt}\n";
            }

            if ($wantsAll || ($wantsStatus && ! $wantsCount)) {
                $poles = Pole::with('node')->get(['id', 'node_id', 'pole_code', 'pole_name', 'status', 'completed_at', 'remarks']);
                $context .= "Detail:\n";
                foreach ($poles as $p) {
                    $context .= sprintf("  Pole %s | Status: %s | Node: %s | Completed: %s\n",
                        $p->pole_code, $p->status, $p->node?->node_id ?? 'N/A',
                        $p->completed_at?->format('Y-m-d') ?? 'No');
                }
            }
        }

        // ── 4. Nodes section ─────────────────────────────────────────────────
        if ($wantsNodes || (! $wantsPoles && ! $wantsProjects && ! $wantsLinemen && ! $wantsTeardown && ! $wantsUsers && $wantsCount)) {
            $total    = Node::count();
            $byStatus = Node::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

            $context .= "=== Nodes Summary ===\n";
            $context .= "Total nodes: {$total}\n";
            foreach ($byStatus as $status => $cnt) {
                $context .= "  - {$status}: {$cnt}\n";
            }

            if ($wantsAll || $wantsStatus) {
                $nodes = Node::with('subcontractor')->withCount('poles')
                    ->get(['id', 'node_id', 'node_name', 'status', 'province', 'city', 'sites', 'progress_percentage', 'subcontractor_id']);
                $context .= "Detail:\n";
                foreach ($nodes as $n) {
                    $context .= sprintf("  Node: %s (%s) | Status: %s | Province: %s | Subcon: %s | Progress: %s%% | Poles: %d\n",
                        $n->node_id, $n->node_name ?? 'N/A', $n->status,
                        $n->province ?? 'N/A', $n->subcontractor?->name ?? 'N/A',
                        $n->progress_percentage ?? '0', $n->poles_count);
                }
            }
        }

        // ── 5. Projects section ───────────────────────────────────────────────
        if ($wantsProjects) {
            $total    = Project::count();
            $byStatus = Project::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

            $context .= "=== Projects Summary ===\n";
            $context .= "Total projects: {$total}\n";
            foreach ($byStatus as $status => $cnt) {
                $context .= "  - {$status}: {$cnt}\n";
            }

            if ($wantsAll || $wantsStatus) {
                $projects = Project::withCount('nodes')->get(['id', 'project_name', 'project_code', 'client', 'status']);
                $context .= "Detail:\n";
                foreach ($projects as $pr) {
                    $context .= sprintf("  Project: %s (%s) | Client: %s | Status: %s | Nodes: %d\n",
                        $pr->project_name, $pr->project_code ?? 'N/A',
                        $pr->client ?? 'N/A', $pr->status, $pr->nodes_count);
                }
            }
        }

        // ── 6. Linemen / field crew ───────────────────────────────────────────
        if ($wantsLinemen) {
            $linemanRole   = \App\Models\User::SUBCON_LINEMAN;
            $totalLinemen  = User::where('subcon_role', $linemanRole)->count();
            $activeToday   = LinemanLocation::whereDate('last_seen_at', today())->count();
            $recentLocations = LinemanLocation::with('user')
                ->orderByDesc('last_seen_at')
                ->limit(20)
                ->get();

            $context .= "=== Linemen / Field Crew ===\n";
            $context .= "Total linemen accounts: {$totalLinemen}\n";
            $context .= "Active in the field today (GPS tracked): {$activeToday}\n";

            if ($recentLocations->isNotEmpty()) {
                $context .= "Recent GPS activity:\n";
                foreach ($recentLocations as $loc) {
                    $context .= sprintf("  %s | Last seen: %s | Lat: %s, Lng: %s\n",
                        $loc->user?->name ?? 'Unknown',
                        $loc->last_seen_at?->format('Y-m-d H:i') ?? 'N/A',
                        $loc->latitude, $loc->longitude);
                }
            }
        }

        // ── 7. Teardown / daily reports ───────────────────────────────────────
        if ($wantsTeardown) {
            $total    = TeardownSubmission::count();
            $byStatus = TeardownSubmission::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

            $context .= "=== Teardown Submissions ===\n";
            $context .= "Total submissions: {$total}\n";
            foreach ($byStatus as $status => $cnt) {
                $context .= "  - {$status}: {$cnt}\n";
            }

            if ($wantsAll || $wantsStatus) {
                $subs = TeardownSubmission::with('node')
                    ->orderByDesc('report_date')
                    ->limit(30)
                    ->get(['id', 'node_id', 'report_date', 'team', 'status', 'total_cable', 'item_status']);
                $context .= "Recent submissions:\n";
                foreach ($subs as $s) {
                    $context .= sprintf("  Node: %s | Date: %s | Team: %s | Status: %s | Item: %s | Cable: %s m\n",
                        $s->node?->node_id ?? 'N/A', $s->report_date?->format('Y-m-d') ?? 'N/A',
                        $s->team ?? 'N/A', $s->status, $s->item_status ?? 'N/A', $s->total_cable ?? '0');
                }
            }
        }

        // ── 8. Users section ─────────────────────────────────────────────────
        if ($wantsUsers) {
            $byRole = User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role');
            $total  = User::count();

            $context .= "=== Users / Accounts ===\n";
            $context .= "Total users: {$total}\n";
            foreach ($byRole as $role => $cnt) {
                $context .= "  - {$role}: {$cnt}\n";
            }
        }

        // ── 9. Fallback — full system snapshot ───────────────────────────────
        if (empty(trim($context))) {
            $nodeCount    = Node::count();
            $poleCount    = Pole::count();
            $projectCount = Project::count();
            $linemanCount = User::where('subcon_role', \App\Models\User::SUBCON_LINEMAN)->count();
            $subCount     = TeardownSubmission::count();

            $nodesByStatus = Node::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
            $polesByStatus = Pole::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

            $context .= "=== System Overview ===\n";
            $context .= "Projects: {$projectCount}\n";
            $context .= "Nodes: {$nodeCount}\n";
            foreach ($nodesByStatus as $s => $c) {
                $context .= "  - {$s}: {$c}\n";
            }
            $context .= "Poles: {$poleCount}\n";
            foreach ($polesByStatus as $s => $c) {
                $context .= "  - {$s}: {$c}\n";
            }
            $context .= "Linemen: {$linemanCount}\n";
            $context .= "Teardown submissions: {$subCount}\n";
        }

        return $context;
    }

    // ════════════════════════════════════════════════════════════════════════
    //  Helpers
    // ════════════════════════════════════════════════════════════════════════

    private function mentions(string $haystack, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (str_contains($haystack, strtolower($needle))) {
                return true;
            }
        }
        return false;
    }

    private function buildSystemPrompt(string $dbContext): string
    {
        return <<<PROMPT
You are AsbuiltIQ, a smart assistant for Telcovantage — a telecom infrastructure company.
You help users query and understand data about poles, nodes, projects, linemen, teardown submissions, and warehouse items.

Rules:
- Answer ONLY based on the database data provided below. Do not make up numbers or records.
- Be concise and direct. Use bullet points or short sentences.
- If the data shows zero records, say so clearly.
- Known status values:
  Nodes/Projects: ongoing, completed, pending, on hold, active, inactive
  Poles: active, done, completed, pending
  Teardown submissions: draft, submitted, approved, rejected
  Warehouse items: pending_delivery, onfield

Database context:
{$dbContext}
PROMPT;
    }
}
