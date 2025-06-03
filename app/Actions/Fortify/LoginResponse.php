<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $role = Session::get('role');

        // Redirect berdasarkan role
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'guru':
                return redirect()->route('guru.dashboard');
            case 'murid':
                return redirect()->route('murid.dashboard');
            case 'orang_tua':
                return redirect()->route('orang_tua.dashboard');
            default:
                return redirect('/'); // fallback
        }
    }
}
