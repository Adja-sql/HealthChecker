<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /*public function toResponse($request)
    {
        $user = Auth::user();
        
        if ($user->role === 'A') { // Si l'utilisateur est un administrateur
            return redirect()->route('admin_dashboard'); // Redirige vers le dashboard admin
        } else {
            return redirect()->route('user_dashboard'); // Redirige vers le dashboard utilisateur
        }
    }*/

    public function toResponse($request)
    {
        $user = Auth::user();
        
        if ($user->role === 'A') { // Si administrateur
            return redirect()->route('admin_dashboard');
        } else {
            return redirect()->route('dashboard'); // Utilisateur normal
        }
    }
}
