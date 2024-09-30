<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($lang)
    {
        // On sauvegarde la langue choisie dans la session
        Session::put('lang', $lang);

        // On redirige l'utilisateur à la page précédente
        return redirect()->back();
    }
}
