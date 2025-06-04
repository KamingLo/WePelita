<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Actions\Fortify\LoginResponse;


class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
    
        // Jika pakai view login sendiri
        Fortify::loginView(function () {
            \Log::info('Login role:', ['role' => session('role')]);
            return view('login');
        });

        RateLimiter::for('login', function (Request $request) {
        $email = (string) $request->email;

        return Limit::perMinute(5)->by($email.$request->ip());
        });

        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);


        // Custom logic login
        Fortify::authenticateUsing(function (Request $request) {
            
            $user = Profile::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                if ($user->guru) {
                    session(['role' => 'guru']);
                } elseif ($user->murid) {
                    session(['role' => 'murid']);
                } elseif ($user->admin) {
                    session(['role' => 'admin']);
                } elseif ($user->orangTua) {
                    session(['role' => 'orang_tua']);
                }

                return $user;
            }

            return null;
        });
    }
}
