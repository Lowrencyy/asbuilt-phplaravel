<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcontractor;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class SubconController extends Controller
{
    public function teams(Subcontractor $subcon)
    {
        $teams = $subcon->teams()->with('members')->orderBy('team_name')->get()
            ->map(fn ($t) => [
                'id'        => $t->id,
                'name'      => $t->team_name,
                'subcon_id' => $t->subcon_id,
                'members'   => $t->members->map(fn ($u) => [
                    'id'   => $u->id,
                    'name' => $u->name,
                    'role' => $u->subcon_role,
                ]),
            ]);

        return response()->json(['data' => $teams]);
    }

    public function employees(Subcontractor $subcon)
    {
        $employees = $subcon->members()
            ->orderBy('name')
            ->get()
            ->map(fn ($u) => [
                'id'      => $u->id,
                'name'    => $u->name,
                'role'    => $u->subcon_role,
                'team_id' => $u->team_id,
            ]);

        return response()->json(['data' => $employees]);
    }

    public function storeTeam(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'subcon_id' => ['required', 'exists:subcons,id'],
        ]);

        $team = Team::create([
            'team_name' => $request->name,
            'subcon_id' => $request->subcon_id,
            'status'    => 'active',
        ]);

        return response()->json([
            'data' => [
                'id'        => $team->id,
                'name'      => $team->team_name,
                'subcon_id' => $team->subcon_id,
            ],
        ], 201);
    }

    public function assignEmployee(Request $request, Team $team)
    {
        $request->validate([
            'employee_id' => ['required', 'exists:users,id'],
        ]);

        User::where('id', $request->employee_id)->update(['team_id' => $team->id]);

        return response()->json(['success' => true]);
    }
}
