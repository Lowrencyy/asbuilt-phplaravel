<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::latest()->paginate(15);
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_name'      => 'required|string|max:255',
            'team_email'     => 'nullable|email|max:255',
            'contact_number' => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'logo'           => 'nullable|image|max:2048',
            'status'         => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('teams/logos', 'public');
        }

        Team::create($validated);

        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'team_name'      => 'required|string|max:255',
            'team_email'     => 'nullable|email|max:255',
            'contact_number' => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'logo'           => 'nullable|image|max:2048',
            'status'         => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('teams/logos', 'public');
        }

        $team->update($validated);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted.');
    }
}
