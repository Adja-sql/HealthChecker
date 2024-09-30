<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\IA_DiagnosticController;
use App\Http\Controllers\FournirController;
use App\Http\Controllers\MaladieController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\SymptomeController;
use App\Services\InfermedicaService;
use App\Http\Controllers\SymptomJournalController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('utilisateurs', UtilisateurController::class);
Route::post('utilisateurs', [UtilisateurController::class, 'store'])->name('utilisateurs.store');
Route::put('utilisateurs/{id}', [UtilisateurController::class, 'update'])->name('utilisateurs.update'); // edit
Route::get('/utilisateurs/search', [UtilisateurController::class, 'search'])->name('utilisateurs.search');
Route::get('/utilisateurs/index', [UtilisateurController::class, 'index'])->name('utilisateur.index');

Route::resource('administrateurs', AdministrateurController::class);
Route::post('/administrateurs', [AdministrateurController::class, 'store'])->name('administrateurs.store'); //Conservation des données
Route::put('administrateurs/{id}', [AdministrateurController::class, 'update'])->name('administrateurs.update'); // edit
Route::get('/administrateurs/search', [AdministrateurController::class, 'search'])->name('administrateurs.search');

Route::resource('consultations', ConsultationController::class);
Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store'); //Conservation des données
Route::put('consultations/{id}', [ConsultationController::class, 'update'])->name('consultations.update'); // edit
Route::get('/consultations/search', [ConsultationController::class, 'search'])->name('consultations.search');

Route::resource('diagnostics', DiagnosticController::class);
Route::post('/diagnostics', [DiagnosticController::class, 'store'])->name('diagnostics.store'); //Conservation des données
Route::put('diagnostics/{id}', [DiagnosticController::class, 'update'])->name('diagnostics.update'); // edit
/*Route::get('/search', [DiagnosticController::class, 'searchPage'])->name('search.page');
Route::post('/search/process', [DiagnosticController::class, 'processSearch'])->name('search.process');*/

Route::resource('experiences', ExperienceController::class);
Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store'); //Conservation des données
Route::put('experiences/{id}', [ExperienceController::class, 'update'])->name('experiences.update'); // edit
Route::get('/experiences/search', [ExperienceController::class, 'search'])->name('experiences.search');

Route::resource('symptomes', SymptomeController::class);
Route::post('/symptomes', [SymptomeController::class, 'store'])->name('symptomes.store'); //Conservation des données
Route::put('symptomes/{id}', [SymptomeController::class, 'update'])->name('symptomes.update'); // edit
Route::get('/symptomes/search', [SymptomeController::class, 'search'])->name('symptomes.search');

Route::resource('ia_diagnostics', IA_DiagnosticController::class);
Route::post('/ia_diagnostics', [IA_DiagnosticController::class, 'store'])->name('ia_diagnostics.store'); //Conservation des données
Route::put('ia_diagnostics/{id}', [IA_DiagnosticController::class, 'update'])->name('ia_diagnostics.update'); // edit
Route::get('/ia_diagnostics/search', [IA_DiagnosticController::class, 'search'])->name('ia_diagnostics.search');

Route::resource('maladies', MaladieController::class);
Route::post('/maladies', [MaladieController::class, 'store'])->name('maladies.store'); //Conservation des données
Route::put('maladies/{id}', [MaladieController::class, 'update'])->name('maladies.update'); // edit
Route::get('/maladies/search', [MaladieController::class, 'search'])->name('maladies.search');

Route::get('/profile', function () {
    return 'Bienvenue dans votre profil !';
})->middleware('auth');

Route::get('/test-api', function (InfermedicaService $infermedicaService) {
    $response = $infermedicaService->getConditions();
    //dd($response); // Cela va afficher la réponse dans ton navigateur
});

Route::get('/test-api', [IA_DiagnosticController::class, 'testAPI']);

Route::get('/experience-diagnostic/debut', [DiagnosticController::class, 'debut'])->name('experience.diagnostic.debut');
Route::post('/experience-diagnostic/process', [DiagnosticController::class, 'process'])->name('experience.diagnostic.process');
Route::get('/experience-diagnostic/result', [DiagnosticController::class, 'result'])->name('experience.diagnostic.result');

Route::get('/ia_diagnostics/create', [IA_DiagnosticController::class, 'create'])->name('ia_diagnostics.create');
Route::post('/ia_diagnostics/process', [IA_DiagnosticController::class, 'process'])->name('ia_diagnostics.process');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::get('/dashboard', function () {
            // Rediriger les utilisateurs
            return view('dashboard');
        })->name('dashboard');
        
        Route::get('/admin/dashboard', function () {
            // Tableau de bord administrateur
            return view('admin_dashboard');
        })->name('admin_dashboard');
    });

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);*/


// Notifications Admin
Route::get('/admin/notifications', [UtilisateurController::class, 'notifications'])->name('admin.notifications');

// Graphiques Admin
Route::get('/admin/graphs', [UtilisateurController::class, 'graphs'])->name('admin.graphs');

Route::get('/privacy-policy', function () {
    return view('privacy.policy');
})->name('privacy.policy');

Route::get('/admin/dashboard', [UtilisateurController::class, 'adminDashboard'])->name('admin_dashboard');

////////////////////////////////////////////////////////

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/symptom-tracking', [SymptomJournalController::class, 'index'])->name('symptom.tracking');

//Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

Route::match(['get', 'post'], 'lang/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

Route::get('lang/{lang}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');
