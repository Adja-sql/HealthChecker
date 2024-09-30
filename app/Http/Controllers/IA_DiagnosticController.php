<?php

namespace App\Http\Controllers;

use App\Services\InfermedicaService;
use Illuminate\Http\Request;
use App\Models\IA_Diagnostic;
use App\Models\Consultation;
use Illuminate\Support\Facades\Log;

class IA_DiagnosticController extends Controller
{
    protected $infermedicaService;

    public function __construct(InfermedicaService $infermedicaService)
    {
        $this->infermedicaService = $infermedicaService;
    }

    public function index()
    {
        $diagnostics = IA_Diagnostic::all();
        return view('ia_diagnostics.index', compact('diagnostics'));
    }

    /*public function create()
    {
        $consultations = Consultation::all();
        return view('ia_diagnostics.create', compact('consultations'));
    }*/

    public function store(Request $request)
    {
        // Ajoute plusieurs symptômes pour le diagnostic
        $symptoms = [
            ['id' => 's_21', 'choice_id' => 'present'],  // Fièvre
            ['id' => 's_13', 'choice_id' => 'present']   // Maux de tête
        ];

        // Appel à l'API pour générer le diagnostic
        $response = $this->infermedicaService->getDiagnosis($symptoms, 30, 'male');

        if (!empty($response['question'])) {
            return view('ia_diagnostics.diagnostic', ['question' => $response['question']]);
        } elseif (!empty($response['conditions'])) {
            return view('ia_diagnostics.result', ['conditions' => $response['conditions']]);
        }

        return back()->withErrors('Le diagnostic IA n\'a pas pu être généré.');
    }

    public function getSymptoms()
    {
        $response = $this->infermedicaService->getSymptoms();
        dd($response);  // Vérifie les symptômes disponibles et leurs IDs
    }

    public function edit($id)
    {
        $diagnostic = IA_Diagnostic::find($id);
        $consultations = Consultation::all();
        return view('ia_diagnostics.edit', compact('diagnostic', 'consultations'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'diagnosticIA' => 'required|string',
            'dateIADiagnostic' => 'required|date',
        ]);

        // Trouver et mettre à jour le diagnostic
        $diagnostic = IA_Diagnostic::findOrFail($id);
        $diagnostic->update($validated);

        // Redirection avec un message de succès
        return redirect()->route('ia_diagnostics.index')->with('success', 'Diagnostic IA mis à jour avec succès');
    }

    /*public function show($id)
    {
        $diagnostic = IA_Diagnostic::find($id);
        return view('ia_diagnostics.show', compact('diagnostic'));
    }*/

    public function show($id)
    {
        $diagnostic = IA_Diagnostic::find($id);

        // Ajoute cette ligne pour afficher les données du diagnostic
        //dd($diagnostic);

        return view('ia_diagnostics.show', compact('diagnostic'));
    }

    public function destroy($id)
    {
        IA_Diagnostic::find($id)->delete();
        return redirect()->route('ia_diagnostics.index');
    }

    public function testAPI()
    {
        // Ajouter plusieurs symptômes pour tester
        $symptoms = [
            ['id' => 's_21', 'choice_id' => 'present'],  // Exemple de symptôme (Fièvre)
            ['id' => 's_13', 'choice_id' => 'present']   // Exemple de symptôme (Maux de tête)
        ];

        // Appel à l'API avec plus de symptômes
        $response = $this->infermedicaService->getDiagnosis($symptoms, 30, 'male');

        dd($response); // Afficher la réponse pour vérification

        // Test de l'appel à l'API
        $response = $this->infermedicaService->getDiagnosis([['id' => 's_21', 'choice_id' => 'present']], 30, 'male');
        
        dd($response); // Cela va arrêter l'exécution et afficher la réponse de l'API
    }

    /*public function create()
    {
        $response = $this->infermedicaService->getInitialQuestion();

        dd($response); // Cela te permettra de voir ce qui est renvoyé
    }*/

    public function create()
    {
        $consultations = Consultation::all(); // Récupère les consultations comme avant
        $response = $this->infermedicaService->getInitialQuestion(); // Appel API

        if (!empty($response['question'])) {
            return view('ia_diagnostics.create', [
                'consultations' => $consultations,
                'question' => $response['question']
            ]);
        }

        return back()->withErrors('Impossible de démarrer le diagnostic.');
    }

    public function process(Request $request)
    {
        $answer = $request->input('answer');

        // Appel à l'API pour obtenir la question suivante ou le diagnostic final
        $symptoms = [['id' => $answer, 'choice_id' => 'present']];
        $response = $this->infermedicaService->getDiagnosis($symptoms, 30, 'female');

        if (!empty($response['question'])) {
            return view('ia_diagnostics.create', ['question' => $response['question']]);
        } elseif (!empty($response['conditions'])) {
            // Enregistrer le diagnostic final dans la base de données
            IA_Diagnostic::create([
                'idConsultation' => 1, // Dynamiser l'ID selon la consultation réelle
                'diagnosticIA' => json_encode($response['conditions']),
            ]);

            return view('ia_diagnostics.result', ['conditions' => $response['conditions']]);
        }

        return back()->withErrors('Le diagnostic IA n\'a pas pu être déterminé.');
    }
}
