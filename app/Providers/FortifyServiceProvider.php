<?php

namespace App\Providers;

use App\Models\Utilisateur; // Assure-toi d'importer la classe Utilisateur
use Illuminate\Support\Facades\Hash; // Assure-toi d'importer Hash aussi
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Rate limiter pour le login
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        // Limitation pour 2FA
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Logique pour authentification
        Fortify::authenticateUsing(function (Request $request) {
            $user = Utilisateur::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        // Redirection après login selon le rôle
        app('events')->listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            $user = $event->user;

            if ($user->role === 'A') {
                session()->put('url.intended', '/admin-dashboard');
            } else {
                session()->put('url.intended', '/dashboard');
            }
        });
    }
}
