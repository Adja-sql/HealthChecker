<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Diagnostic;
use App\Models\Experience;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller 
{
    /*public function index()
    {
        $utilisateurs = Utilisateur::all();
        return view('utilisateurs.index', compact('utilisateurs'));
    }*/

    /*public function index()
    {
        // Récupérer tous les utilisateurs sauf les administrateurs si l'utilisateur connecté n'est pas l'admin principal
        if (Auth::user()->id == 1) {
            $utilisateurs = Utilisateur::all(); // Admin principal voit tous les utilisateurs
        } else {
            $utilisateurs = Utilisateur::where('role', '!=', 'A')->get(); // Autres admins ne voient pas les administrateurs
        }

        return view('utilisateurs.index', compact('utilisateurs'));
    }*/

    public function index()
{
    // Vérifie si l'utilisateur est connecté avant d'accéder à ses informations
    if (Auth::check()) {
        // Récupérer tous les utilisateurs sauf les administrateurs si l'utilisateur connecté n'est pas l'admin principal
        if (Auth::user()->id == 1) {
            $utilisateurs = Utilisateur::all(); // Admin principal voit tous les utilisateurs
        } else {
            $utilisateurs = Utilisateur::where('role', '!=', 'A')->get(); // Autres admins ne voient pas les administrateurs
        }
    } else {
        // Redirige vers la page de connexion ou une autre page
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
    }

    return view('utilisateurs.index', compact('utilisateurs'));
}


    /*public function create()
    {
        return view('utilisateurs.create');
    }*/

    public function create()
    {
        // Vérifier si l'utilisateur connecté a l'ID 1
        if (Auth::user()->id != 1) {
            abort(403, 'Accès interdit'); // Bloquer l'accès si ce n'est pas l'utilisateur avec l'ID 1
        }
        
        return view('utilisateurs.create');
    }

    /*public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prenom' => 'required|string|max:50',
            'nom' => 'required|string|max:50',
            'email' => 'required|email|unique:utilisateurs,email|max:50',
            'dateDeNaissance' => 'required|date',
            'numero' => 'required|string|unique:utilisateurs,numero|max:15',
            'motDePasse' => 'required|string|min:6',
        ]);

        $utilisateur = new Utilisateur();
        $utilisateur->prenom = $validatedData['prenom'];
        $utilisateur->nom = $validatedData['nom'];
        $utilisateur->email = $validatedData['email'];
        $utilisateur->dateDeNaissance = $validatedData['dateDeNaissance'];
        $utilisateur->numero = $validatedData['numero'];
        $utilisateur->password = $validatedData['motDePasse'];
        $utilisateur->save();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur ajouté avec succès!');
    }*/

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prenom' => 'required|string|max:50',
            'nom' => 'required|string|max:50',
            'email' => 'required|email|unique:utilisateurs,email|max:50',
            'dateDeNaissance' => 'required|date',
            'numero' => 'required|string|unique:utilisateurs,numero|max:15',
            'motDePasse' => 'required|string|min:6',
            'role' => 'required|in:U,A', // Vérifie que le rôle est bien 'U' ou 'A'
        ]);

        $utilisateur = new Utilisateur();
        $utilisateur->prenom = $validatedData['prenom'];
        $utilisateur->nom = $validatedData['nom'];
        $utilisateur->email = $validatedData['email'];
        $utilisateur->dateDeNaissance = $validatedData['dateDeNaissance'];
        $utilisateur->numero = $validatedData['numero'];
        $utilisateur->password = Hash::make($validatedData['motDePasse']); // Hasher le mot de passe
        $utilisateur->role = $validatedData['role']; // Enregistre le rôle sélectionné
        $utilisateur->save();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur ajouté avec succès!');
    }


    public function show($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.show', compact('utilisateur'));
    }

    public function edit(Utilisateur $utilisateur)
    {
        return view('utilisateurs.edit', compact('utilisateur'));
    }   

    public function destroy($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $utilisateurs = Utilisateur::where('prenom', 'like', "%$query%")
            ->orWhere('nom', 'like', "%$query%")
            ->get();

        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function update(Request $request, $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $validatedData = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $id,
            'password' => 'nullable|min:8|confirmed', // password confirmation rule
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = $request->password;
        } else {
            unset($validatedData['password']);
        }

        $utilisateur->update($validatedData);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    public function adminDashboard()
    {
        $usersCount = Utilisateur::where('role', 'U')->count();
        $adminsCount = Utilisateur::where('role', 'A')->count();
        $diagnosticsCount = Diagnostic::count(); // Si tu as un modèle Diagnostic
        $unreadNotificationsCount = Notification::where('is_read', false)->count();
    
        return view('admin_dashboard', compact('usersCount', 'adminsCount', 'diagnosticsCount', 'unreadNotificationsCount'));
    }

    public function graphs()
    {
        // Exemple pour obtenir les utilisateurs inscrits chaque jour
        $usersByDate = Utilisateur::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                                ->groupBy('date')
                                ->orderBy('date', 'asc')
                                ->get();

        // Pour les expériences partagées
        $experiencesByDate = Experience::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                                    ->groupBy('date')
                                    ->orderBy('date', 'asc')
                                    ->get();

        // Pour les diagnostics émis
        $diagnosticsByDate = Diagnostic::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                                    ->groupBy('date')
                                    ->orderBy('date', 'asc')
                                    ->get();

        // Extraire les dates et les nombres d'utilisateurs, d'expériences et de diagnostics
        $dates = $usersByDate->pluck('date')->toArray();  // Les dates
        $usersData = $usersByDate->pluck('count')->toArray();  // Nombres d'utilisateurs
        $experiencesData = $experiencesByDate->pluck('count')->toArray();  // Nombres d'expériences
        $diagnosticsData = $diagnosticsByDate->pluck('count')->toArray();  // Nombres de diagnostics

        // Passer les variables à la vue
        return view('admin.graphs', compact('dates', 'usersData', 'experiencesData', 'diagnosticsData'));
    }

    public function notifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();
        
        // Marquer les notifications comme lues
        Notification::where('is_read', false)->update(['is_read' => true]);
    
        return view('notifications', compact('notifications'));
    }
    
}

