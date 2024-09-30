<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Utilisateur;
use App\Models\Maladie;
use App\Models\Notification;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::all();
        return view('experiences.index', compact('experiences'));
    }

    /*public function create()
    {
        $utilisateurs = Utilisateur::all();
        $maladies = Maladie::all();
        return view('experiences.create', compact('utilisateurs', 'maladies'));
    }*/

    public function create()
    {
        // Récupérer uniquement les utilisateurs ayant le rôle 'U'
        $utilisateurs = Utilisateur::where('role', 'U')->get();
        $maladies = Maladie::all();
        return view('experiences.create', compact('utilisateurs', 'maladies'));
    }

    //public function store(Request $request)
    //{
        // Validation des données
        //$validatedData = $request->validate([
            //'idUtilisateur' => 'required|integer',
            //'idMaladie' => 'required|integer',
            //'description' => 'required|string',
            //'idAdministrateur' => 'nullable|integer',
            //'estValidee' => 'required|boolean',
        //]);

        // Création de l'expérience
        //Experience::create($validatedData);

        //return redirect()->route('experiences.index')->with('success', 'Expérience ajoutée avec succès');
    //}

    /*public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'idUtilisateur' => 'required|integer',
            'idMaladie' => 'required|integer',
            'description' => 'required|string',
            'idAdministrateur' => 'nullable|integer',
            'estValidee' => 'nullable|boolean',
        ]);

        $validatedData['estValidee'] = $validatedData['estValidee'] ?? false;

        // Création de l'expérience
        Experience::create($validatedData);

        return redirect()->route('experiences.index')->with('success', 'Expérience ajoutée avec succès');
    }*/

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'idUtilisateur' => 'required|integer',
            'idMaladie' => 'required|integer',
            'description' => 'required|string',
            'idAdministrateur' => 'nullable|integer',
            'estValidee' => 'nullable|boolean',
        ]);

        // Par défaut, estValidee sera false si non défini
        $validatedData['estValidee'] = $validatedData['estValidee'] ?? false;

        // Création de l'expérience
        Experience::create($validatedData);

        // Créer une notification
        Notification::create([
            'message' => 'Une nouvelle expérience a été partagée.',
        ]);

        // Redirection directe vers /dashboard avec le message flash
        return redirect()->route('dashboard')->with('success', 'Votre expérience a été partagée avec succès !');
    }

    /*public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        $utilisateurs = Utilisateur::all();
        $maladies = Maladie::all();
        return view('experiences.edit', compact('experience', 'utilisateurs', 'maladies'));
    }*/

    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        //$utilisateurs = Utilisateur::all(); // Récupère tous les utilisateurs
        $utilisateurs = Utilisateur::where('role', 'U')->get();
        $maladies = Maladie::all(); // Récupère toutes les maladies
        return view('experiences.edit', compact('experience', 'utilisateurs', 'maladies'));
    }

    /*public function update(Request $request, $id)
    {
        $experience = Experience::find($id);
        $experience->idUtilisateur = $request->input('idUtilisateur');
        $experience->idMaladie = $request->input('idMaladie');
        $experience->description = $request->input('description');
        //$experience->date = $request->input('date');
        $experience->save();

        return redirect()->route('experiences.index')->with('success', 'Expérience modifiée avec succès');
    }*/

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'idUtilisateur' => 'required|integer',
            'idMaladie' => 'required|integer',
            'description' => 'required|string',
            'estValidee' => 'required|boolean', // Validation pour estValidee
        ]);

        // Récupérer l'expérience
        $experience = Experience::findOrFail($id);

        // Mettre à jour les champs
        $experience->idUtilisateur = $validatedData['idUtilisateur'];
        $experience->idMaladie = $validatedData['idMaladie'];
        $experience->description = $validatedData['description'];
        $experience->estValidee = $validatedData['estValidee'];

        // Sauvegarder les modifications
        $experience->save();

        return redirect()->route('experiences.index')->with('success', 'Expérience modifiée avec succès');
    }

    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('experiences.index')->with('success', 'Expérience supprimée avec succès!');
    }

    public function show($id)
    {
        $experience = Experience::findOrFail($id);

        return view('experiences.show', compact('experience'));
    }

    /*public function store(Request $request)
    {
        // Valider et enregistrer l'expérience
        $validatedData = $request->validate([
            'idUtilisateur' => 'required|integer',
            'idMaladie' => 'required|integer',
            'description' => 'required|string',
        ]);

        Experience::create($validatedData);

        // Créer une notification
        Notification::create([
            'message' => 'Une nouvelle expérience a été partagée.',
        ]);

        return redirect()->route('experiences.index')->with('success', 'Expérience partagée avec succès!');
    }*/
}
