<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;

class AdministrateurController extends Controller
{
    public function index()
    {
        $administrateurs = Administrateur::all();
        return view('administrateurs.index', compact('administrateurs'));
    }

    public function create()
    {
        return view('administrateurs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prenom' => 'required|string|max:50',
            'nom' => 'required|string|max:50',
            'email' => 'required|email|unique:administrateurs,email|max:50',
            'motDePasse' => 'required|string|min:6',
        ]);

        $administrateur = new Administrateur();
        $administrateur->prenom = $validatedData['prenom'];
        $administrateur->nom = $validatedData['nom'];
        $administrateur->email = $validatedData['email'];
        $administrateur->password = $validatedData['motDePasse']; // Utilisation de bcrypt pour hacher le mot de passe
        $administrateur->save();

        return redirect()->route('administrateurs.index')->with('success', 'Administrateur ajouté avec succès!');
    }

    /*public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prenom' => 'required|string|max:50',
            'nom' => 'required|string|max:50',
            'email' => 'required|email|unique:administrateurs,email|max:50',
            'motDePasse' => 'required|string|min:6',
        ]);

        $administrateur = new Administrateur();
        $administrateur->prenom = $validatedData['prenom'];
        $administrateur->nom = $validatedData['nom'];
        $administrateur->email = $validatedData['email'];
        $administrateur->password = $validatedData['motDePasse']; // Hashage du mot de passe
        $administrateur->save();

        return redirect()->route('administrateurs.index')->with('success', 'Administrateur ajouté avec succès!');
    }*/

    public function show($id)
    {
        $administrateur = Administrateur::findOrFail($id);
        return view('administrateurs.show', compact('administrateur'));
    }

    public function edit($id)
    {
        $administrateur = Administrateur::findOrFail($id);
        return view('administrateurs.edit', compact('administrateur'));
    }

    public function update(Request $request, $id)
    {
        $administrateur = Administrateur::findOrFail($id);

        $validatedData = $request->validate([
            'prenom' => 'required|string|max:50',
            'nom' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'password' => 'nullable|string|min:6', 
        ]);

        $administrateur->prenom = $validatedData['prenom'];
        $administrateur->nom = $validatedData['nom'];
        $administrateur->email = $validatedData['email'];

        if ($request->filled('password')) {
            $administrateur->password = $validatedData['password'];
        }

        $administrateur->save();

        return redirect()->route('administrateurs.index')->with('success', 'Administrateur mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $administrateur = Administrateur::findOrFail($id);
        $administrateur->delete();

        return redirect()->route('administrateurs.index')->with('success', 'Administrateur supprimé avec succès!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $administrateurs = Administrateur::where('prenom', 'like', "%$query%")
            ->orWhere('nom', 'like', "%$query%")
            ->get();

        return view('administrateurs.index', compact('administrateurs'));
    }

    //auth()->guard('admin')->attempt($credentials);
}
