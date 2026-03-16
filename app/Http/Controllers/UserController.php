<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcontractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcontractorController extends Controller
{
    public function index()
    {
        $subcons = Subcontractor::orderBy('name')->get();
        return view('dashboards.admin.subcon.addsubcon', compact('subcons'));
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

        return response()->json([
            'success' => true,
            'subcon'  => $subcon->append('logo_url'),
        ]);
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
            if ($logoPath) {
                Storage::disk('public')->delete($logoPath);
            }
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

        return response()->json([
            'success' => true,
            'subcon'  => $subcon->fresh()->append('logo_url'),
        ]);
    }

    public function destroy(Subcontractor $subcon)
    {
        if ($subcon->logo_path) {
            Storage::disk('public')->delete($subcon->logo_path);
        }
        $subcon->delete();

        return response()->json(['success' => true]);
    }
}
