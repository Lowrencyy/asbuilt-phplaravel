<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        $user = Auth::user();

        // Block inactive accounts
        if (! $user->is_active) {
            Auth::logout();
            return response()->json(['message' => 'Your account has been deactivated. Please contact your supervisor.'], 403);
        }

        // Only these roles can log in via API
        $allowedRoles = ['lineman', 'admin', 'pm', 'subcon', 'project_manager', 'executives'];
        if (!in_array($user->role, $allowedRoles)) {
            Auth::logout();
            return response()->json(['message' => 'Access denied for this account.'], 403);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        $team = $user->team_id ? \App\Models\Team::find($user->team_id) : null;

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'role'       => $user->role,
                'subcon_role'=> $user->subcon_role,
                'team_id'    => $user->team_id,
                'team_name'  => $team?->team_name,
            ],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out.']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
