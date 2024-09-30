<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Utilisateur;
use App\Models\Symptome;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::all();
        return view('consultations.index', compact('consultations'));
    }

    /*public function create()
    {
        $utilisateurs = Utilisateur::all();
        return view('consultations.create', compact('utilisateurs'));
    }*/

    public function create()
    {
        // Récupérer uniquement les utilisateurs ayant le rôle 'U'
        $utilisateurs = Utilisateur::where('role', 'U')->get();
        return view('consultations.create', compact('utilisateurs'));
    }

    public function show($id)
    {
        $consultation = Consultation::findOrFail($id);
        return view('consultations.show', compact('consultation'));
    }

    /*public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dateConsultation' => 'required|date',
            'idUtilisateur' => 'required|integer|exists:utilisateurs,id',
        ]);

        Consultation::create($validatedData);

        return redirect()->route('consultations.index')->with('success', 'Consultation ajoutée avec succès!');
    }*/

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'created_at' => 'required|date',
            'idUtilisateur' => 'required|integer|exists:utilisateurs,id',
        ]);

        Consultation::create([
            'created_at' => $validatedData['created_at'],
            'idUtilisateur' => $validatedData['idUtilisateur'],
        ]);

        return redirect()->route('consultations.index')->with('success', 'Consultation ajoutée avec succès!');
    }

    public function edit($id)
    {
        $consultation = Consultation::findOrFail($id);
        //$utilisateurs = Utilisateur::all();
        $utilisateurs = Utilisateur::where('role', 'U')->get();
        return view('consultations.edit', compact('consultation', 'utilisateurs'));
    }

    /*public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'dateConsultation' => 'required|date',
            'idUtilisateur' => 'required|integer|exists:utilisateurs,id',
        ]);

        $consultation = Consultation::findOrFail($id);
        $consultation->update($validatedData);

        return redirect()->route('consultations.index')->with('success', 'Consultation mise à jour avec succès!');
    }*/

    /*public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'created_at' => 'required|date',
            'idUtilisateur' => 'required|integer|exists:utilisateurs,id',
        ]);

        $consultation = Consultation::findOrFail($id);
        $consultation->update([
            'created_at' => $validatedData['created_at'],
            'idUtilisateur' => $validatedData['idUtilisateur'],
        ]);

        return redirect()->route('consultations.index')->with('success', 'Consultation mise à jour avec succès!');
    }*/

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'created_at' => 'required|date',
            'idUtilisateur' => 'required|integer|exists:utilisateurs,id',
        ]);

        $consultation = Consultation::findOrFail($id);

        // Désactiver temporairement la gestion des timestamps
        $consultation->timestamps = false;
        
        // Mettre à jour la date de consultation et l'utilisateur
        $consultation->update([
            'created_at' => $validatedData['created_at'],
            'idUtilisateur' => $validatedData['idUtilisateur'],
        ]);

        // Réactiver les timestamps
        $consultation->timestamps = true;

        return redirect()->route('consultations.index')->with('success', 'Consultation mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();

        return redirect()->route('consultations.index')->with('success', 'Consultation supprimée avec succès!');
    }
}