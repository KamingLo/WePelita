<?php

// app/Http/Middleware/RoleMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        $sessionRole = session('role');
        $userId = Auth::id();

        // Split the roles string into an array and trim whitespace
        $requiredRoles = array_map('trim', explode(',', $roles));

        Log::info('RoleMiddleware check', [
            'session_role' => $sessionRole,
            'required_roles' => $requiredRoles, // Log the array
            'user_id' => $userId,
            'path' => $request->path(),
            'is_ajax' => $request->ajax() || $request->expectsJson()
        ]);

        if (!Auth::check()) {
            Log::warning('User not authenticated in RoleMiddleware', [
                'path' => $request->path(),
                'session_role' => $sessionRole
            ]);
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect('login');
        }

        // Check if session_role matches any of the required roles
        if (!in_array($sessionRole, $requiredRoles)) {
            Log::warning('RoleMiddleware role mismatch', [
                'session_role' => $sessionRole,
                'required_roles' => $requiredRoles,
                'user_id' => $userId
            ]);
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized role'], 403);
            }
            return redirect('login');
        }

        return $next($request);
    }
}