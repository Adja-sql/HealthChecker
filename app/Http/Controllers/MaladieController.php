<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maladie;

class MaladieController extends Controller
{
    public function index()
    {
        $maladies = Maladie::all();
        return view('maladies.index', compact('maladies'));
    }

    public function create()
    {
        return view('maladies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        Maladie::create($validatedData);

        return redirect()->route('maladies.index')->with('success', 'Maladie ajoutée avec succès!');
    }

    public function show($id)
    {
        $maladie = Maladie::findOrFail($id);
        return view('maladies.show', compact('maladie'));
    }

    public function edit($id)
    {
        $maladie = Maladie::findOrFail($id);
        return view('maladies.edit', compact('maladie'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        $maladie = Maladie::findOrFail($id);
        $maladie->update($validatedData);

        return redirect()->route('maladies.index')->with('success', 'Maladie mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $maladie = Maladie::findOrFail($id);
        $maladie->delete();

        return redirect()->route('maladies.index')->with('success', 'Maladie supprimée avec succès!');
    }
}
