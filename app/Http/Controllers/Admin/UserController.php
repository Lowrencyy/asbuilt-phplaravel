<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcontractor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('subcontractor')
            ->where('role', '!=', User::ROLE_SUBCON)
            ->latest();

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%")
                   ->orWhere('role', 'like', "%{$q}%");
            });
        }

        $users  = $query->paginate(15)->withQueryString();
        $subcons = Subcontractor::orderBy('name')->get();
        return view('dashboards.admin.users.index', compact('users', 'subcons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'role'     => ['required', Rule::in([
                User::ROLE_ADMIN,
                User::ROLE_EXECUTIVES,
                User::ROLE_HR,
                User::ROLE_ACCOUNTING,
                User::ROLE_PROJECT_MANAGER,
                User::ROLE_NORMAL_EMPLOYEE,
            ])],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'role'     => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role'  => ['required', Rule::in([
                User::ROLE_ADMIN,
                User::ROLE_EXECUTIVES,
                User::ROLE_HR,
                User::ROLE_ACCOUNTING,
                User::ROLE_PROJECT_MANAGER,
                User::ROLE_NORMAL_EMPLOYEE,
            ])],
        ]);

        $user->update($validated);

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password reset successfully.');
    }
}
