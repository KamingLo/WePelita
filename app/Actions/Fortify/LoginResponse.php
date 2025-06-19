<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $role = Session::get('role');
        Log::info('LoginResponse role:', ['role' => $role, 'user_id' => auth()->id()]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Authenticated', 'role' => $role]);
        }

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'guru':
                return redirect()->route('guru.dashboard');
            case 'murid':
                return redirect()->route('murid.dashboard');
            case 'orangtua':
                return redirect()->route('orangtua.dashboard');
            default:
                Log::warning('Fallback redirect triggered', ['role' => $role]);
                return redirect('/');
        }
    }
}