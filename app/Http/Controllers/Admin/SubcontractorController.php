<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcontractor;
use App\Models\Team;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SubcontractorController extends Controller
{
    public function index()
    {
        $subcons = Subcontractor::withCount('members')->orderBy('name')->get();
        return view('dashboards.admin.subcon.index', compact('subcons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255', 'unique:subcons,name'],
            'description' => ['nullable', 'string'],
            'contact'     => ['nullable', 'string', 'max:100'],
            'email'       => ['nullable', 'email', 'max:255'],
            'address'     => ['nullable', 'string'],
            'warehouse'   => ['nullable', 'string', 'max:255'],
            'logo'        => ['nullable', 'image', 'max:2048'],
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('subcon-logos', 'public');
        }

        $subcon = Subcontractor::create([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'contact'     => $validated['contact'] ?? null,
            'email'       => $validated['email'] ?? null,
            'address'     => $validated['address'] ?? null,
            'warehouse'   => $validated['warehouse'] ?? null,
            'logo_path'   => $logoPath,
        ]);

        // Auto-create primary warehouse for this subcontractor
        Warehouse::create([
            'subcontractor_id' => $subcon->id,
            'name'             => $validated['name'] . ' Warehouse',
            'location'         => $validated['address'] ?? null,
            'is_primary'       => true,
            'status'           => 'active',
        ]);

        return response()->json(['success' => true, 'subcon' => $subcon->append('logo_url')]);
    }

    public function update(Request $request, Subcontractor $subcon)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255', "unique:subcons,name,{$subcon->id}"],
            'description' => ['nullable', 'string'],
            'contact'     => ['nullable', 'string', 'max:100'],
            'email'       => ['nullable', 'email', 'max:255'],
            'address'     => ['nullable', 'string'],
            'warehouse'   => ['nullable', 'string', 'max:255'],
            'logo'        => ['nullable', 'image', 'max:2048'],
        ]);

        $logoPath = $subcon->logo_path;
        if ($request->hasFile('logo')) {
            if ($logoPath) Storage::disk('public')->delete($logoPath);
            $logoPath = $request->file('logo')->store('subcon-logos', 'public');
        }

        $subcon->update([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'contact'     => $validated['contact'] ?? null,
            'email'       => $validated['email'] ?? null,
            'address'     => $validated['address'] ?? null,
            'warehouse'   => $validated['warehouse'] ?? null,
            'logo_path'   => $logoPath,
        ]);

        return response()->json(['success' => true, 'subcon' => $subcon->fresh()->append('logo_url')]);
    }

    public function show(Subcontractor $subcon)
    {
        $members = $subcon->members()->orderBy('subcon_role')->orderBy('name')->get();
        $teams   = $subcon->teams()->with('members')->orderBy('team_name')->get();
        return view('dashboards.admin.subcon.show', compact('subcon', 'members', 'teams'));
    }

    // ── Subcon Teams ────────────────────────────────────────────────────────

    public function storeTeam(Request $request, Subcontractor $subcon)
    {
        $request->validate([
            'team_name' => ['required', 'string', 'max:255'],
        ]);

        $team = Team::create([
            'team_name' => $request->team_name,
            'subcon_id' => $subcon->id,
            'status'    => 'active',
        ]);

        return response()->json(['success' => true, 'team' => $team->load('members')]);
    }

    public function destroyTeam(Team $team)
    {
        $team->members()->update(['team_id' => null]);
        $team->delete();
        return response()->json(['success' => true]);
    }

    public function assignTeamMember(Request $request, Team $team)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        User::where('id', $request->user_id)->update(['team_id' => $team->id]);

        $user = User::find($request->user_id);
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function removeTeamMember(Team $_team, User $user)
    {
        $user->update(['team_id' => null]);
        return response()->json(['success' => true]);
    }

    public function destroy(Subcontractor $subcon)
    {
        if ($subcon->logo_path) Storage::disk('public')->delete($subcon->logo_path);

        $permanentlyDeleteAt = now()->addDays(90);
        $subcon->members()->each(function ($member) use ($permanentlyDeleteAt) {
            $member->permanently_delete_at = $permanentlyDeleteAt;
            $member->save();
            $member->delete(); // sets deleted_at
        });

        $subcon->delete();
        return response()->json(['success' => true]);
    }

    // ── Subcon Members ───────────────────────────────────────────────────────

    public function storeMember(Request $request, Subcontractor $subcon)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'subcon_role'=> ['required', Rule::in([User::SUBCON_PM, User::SUBCON_LINEMAN])],
            'password'   => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'role'             => User::ROLE_SUBCON,
            'subcon_role'      => $request->subcon_role,
            'subcontractor_id' => $subcon->id,
            'password'         => Hash::make($request->password),
        ]);

        return back()->with('success', 'Subcon member added.');
    }

    public function updateMember(Request $request, User $user)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'subcon_role' => ['required', Rule::in([User::SUBCON_PM, User::SUBCON_LINEMAN])],
            'contact_number' => ['nullable', 'string', 'max:50'],
        ]);

        $user->update([
            'name'           => $request->name,
            'email'          => $request->email,
            'subcon_role'    => $request->subcon_role,
            'contact_number' => $request->contact_number ?? null,
        ]);

        return response()->json(['success' => true, 'user' => $user->fresh()]);
    }

    public function toggleMemberActive(User $user)
    {
        $user->update(['is_active' => ! $user->is_active]);

        // Revoke all tokens so inactive user is immediately kicked out
        if (! $user->is_active) {
            $user->tokens()->delete();
        }

        return response()->json([
            'success'   => true,
            'is_active' => $user->is_active,
        ]);
    }

    public function destroyMember(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }
}
