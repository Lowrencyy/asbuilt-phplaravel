<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcontractor;
use App\Models\User;
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
        return view('dashboards.admin.subcon.show', compact('subcon', 'members'));
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

    public function destroyMember(User $user)
    {
        $user->delete();
        return back()->with('success', 'Member removed.');
    }
}
