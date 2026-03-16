<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get()->map(fn ($p) => $this->transform($p));
        return view('dashboards.admin.projects.addprojects', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'code'   => ['required', 'string', 'max:100', 'unique:projects,project_code'],
            'client' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['ONGOING', 'ON HOLD', 'COMPLETED'])],
            'logo'   => ['nullable', 'image', 'max:12048'],
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('project-logos', 'public');
        }

        $project = Project::create([
            'project_name' => $validated['name'],
            'project_code' => strtoupper($validated['code']),
            'client'       => $validated['client'] ?? null,
            'status'       => $validated['status'],
            'project_logo' => $logoPath,
        ]);

        return response()->json(['success' => true, 'project' => $this->transform($project)]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'code'   => ['required', 'string', 'max:100', Rule::unique('projects', 'project_code')->ignore($project->id)],
            'client' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['ONGOING', 'ON HOLD', 'COMPLETED'])],
            'logo'   => ['nullable', 'image', 'max:12000'],
        ]);

        $logoPath = $project->project_logo;
        if ($request->hasFile('logo')) {
            if ($logoPath) Storage::disk('public')->delete($logoPath);
            $logoPath = $request->file('logo')->store('project-logos', 'public');
        }

        $project->update([
            'project_name' => $validated['name'],
            'project_code' => strtoupper($validated['code']),
            'client'       => $validated['client'] ?? null,
            'status'       => $validated['status'],
            'project_logo' => $logoPath,
        ]);

        return response()->json(['success' => true, 'project' => $this->transform($project->fresh())]);
    }

    public function destroy(Project $project)
    {
        if ($project->project_logo) {
            Storage::disk('public')->delete($project->project_logo);
        }
        $project->delete();
        return response()->json(['success' => true]);
    }

    private function transform(Project $p): array
    {
        return [
            'id'           => $p->id,
            'name'         => $p->project_name,
            'code'         => $p->project_code,
            'client'       => $p->client,
            'status'       => $p->status,
            'logo_url'     => $p->project_logo ? asset('storage/' . $p->project_logo) : null,
            'updated_human'=> $p->updated_at->diffForHumans(),
        ];
    }
}
