<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministrateurController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('administrateurs', AdministrateurController::class);
Route::post('/administrateurs', [AdministrateurController::class, 'store'])->name('administrateurs.store'); //Conservation des données
Route::post('administrateurs', [AdministrateurController::class, 'store'])->name('administrateurs.store');
Route::put('administrateurs/{id}', [AdministrateurController::class, 'update'])->name('administrateurs.update'); // edit
Route::get('/administrateurs/search', [AdministrateurController::class, 'search'])->name('administrateurs.search');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/profile', function () {
    return 'Bienvenue dans votre profil !';
})->middleware('auth');

Route::get('admin/login', [AdministrateurController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdministrateurController::class, 'login']);
Route::post('admin/logout', [AdministrateurController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'admin'], function () {
    // Routes accessibles uniquement aux administrateurs authentifiés
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard'); // Assure-toi de créer cette vue
    });
    // Ajoute ici d'autres routes d'administration
});

Route::post('admin/login', [AdministrateurController::class, 'login'])->name('admin.login');

Route::get('/admin/login', [AdministrateurController::class, 'showLoginForm'])->name('admin.login');

Route::post('/admin/login', [AdministrateurController::class, 'login'])->name('admin.login.submit');