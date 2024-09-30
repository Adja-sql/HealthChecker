<?php

namespace App\Http\Controllers;

use App\Models\Symptome;
use App\Models\Consultation;
use App\Models\Maladie;
use App\Models\Experience;
use Illuminate\Http\Request;

class SymptomeController extends Controller
{
    public function index()
    {
        $symptomes = Symptome::all();
        return view('symptomes.index', compact('symptomes'));
    }

    public function create()
    {
        $consultations = Consultation::all();
        $maladies = Maladie::all();
        $experiences = Experience::all();
        return view('symptomes.create', compact('consultations', 'maladies', 'experiences'));
    }

    public function store(Request $request)
    {
        Symptome::create($request->all());
        return redirect()->route('symptomes.index')->with('success', 'Symptôme ajouté avec succès');
    }

    public function edit(Symptome $symptome)
    {
        $consultations = Consultation::all();
        $maladies = Maladie::all();
        $experiences = Experience::all();
        return view('symptomes.edit', compact('symptome', 'consultations', 'maladies', 'experiences'));
    }

    public function update(Request $request, Symptome $symptome)
    {
        $symptome->update($request->all());
        return redirect()->route('symptomes.index')->with('success', 'Symptôme modifié avec succès');
    }

    public function show(Symptome $symptome)
    {
        return view('symptomes.show', compact('symptome'));
    }

    public function destroy(Symptome $symptome)
    {
        $symptome->delete();
        return redirect()->route('symptomes.index')->with('success', 'Symptôme supprimé avec succès');
    }
}
