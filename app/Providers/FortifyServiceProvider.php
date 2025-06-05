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
        Fortify::loginView(function () {
            \Log::info('Login role:', ['role' => session('role')]);
            return view('login');
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(5)->by($email . $request->ip());
        });

        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = Profile::where('email', $request->email)->with(['guru', 'murid', 'admin', 'orangTua'])->first();

            if ($user && Hash::check($request->password, $user->password)) {
                if ($user->guru) {
                    session(['role' => 'guru']);
                    \Log::info('Authenticated user role: guru', ['email' => $user->email]);
                } elseif ($user->murid) {
                    session(['role' => 'murid']);
                    \Log::info('Authenticated user role: murid', ['email' => $user->email]);
                } elseif ($user->admin) {
                    session(['role' => 'admin']);
                    \Log::info('Authenticated user role: admin', ['email' => $user->email]);
                } elseif ($user->orangTua) {
                    session(['role' => 'orangtua']);
                    \Log::info('Authenticated user role: orangtua', ['email' => $user->email]);
                } else {
                    \Log::warning('Authenticated user with no role', ['email' => $user->email]);
                    return null; // Prevent login for users without roles
                }

                // Ensure session is saved
                session()->save();
                return $user;
            }

            \Log::info('Authentication failed', ['email' => $request->email]);
            return null;
        });
    }
}