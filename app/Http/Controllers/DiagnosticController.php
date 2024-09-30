<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnostic;
use App\Models\Maladie;
use App\Models\Consultation;
use App\Services\InfermedicaService;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use App\Models\SymptomJournal;

class DiagnosticController extends Controller
{
    protected $infermedicaService;

    public function __construct(InfermedicaService $infermedicaService)
    {
        $this->infermedicaService = $infermedicaService;
    }

    /*public function index()
    {
        $diagnostics = Diagnostic::all();
        return view('diagnostics.index', compact('diagnostics'));
    }*/

    public function index(Request $request)
    {
        // Récupérer l'utilisateur dont on veut afficher les diagnostics
        $userId = $request->get('user_id');
        
        // Si un utilisateur est spécifié, filtrer les diagnostics par cet utilisateur
        if ($userId) {
            $diagnostics = Diagnostic::where('idUtilisateur', $userId)->get();
        } else {
            $diagnostics = Diagnostic::all();
        }

        return view('diagnostics.index', compact('diagnostics'));
    }

    public function create()
    {
        $maladies = Maladie::all();
        $consultations = Consultation::all(); 
        return view('diagnostics.create', compact('maladies', 'consultations'));
    }

    public function store(Request $request)
    {
        // Valider les données envoyées
        $validatedData = $request->validate([
            'idMaladie' => 'required|exists:maladies,id',
        ]);

        // Créer une nouvelle consultation liée à l'utilisateur connecté
        $consultation = new Consultation();
        $consultation->idUtilisateur = Auth::id();  // Associer la consultation à l'utilisateur connecté
        $consultation->created_at = now();  // Enregistrer la date de la consultation
        $consultation->save();

        // Créer le diagnostic et le lier à la consultation créée
        $diagnostic = new Diagnostic();
        $diagnostic->idMaladie = $validatedData['idMaladie'];
        $diagnostic->idConsultation = $consultation->id;  // Lier le diagnostic à la consultation
        $diagnostic->save();

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic ajouté avec succès!');
    }

    public function show($id)
    {
        $diagnostic = Diagnostic::findOrFail($id);
        return view('diagnostics.show', compact('diagnostic'));
    }

    public function edit($id)
    {
        $diagnostic = Diagnostic::findOrFail($id);
        $maladies = Maladie::all();
        $consultations = Consultation::all();
        return view('diagnostics.edit', compact('diagnostic', 'maladies', 'consultations'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'idMaladie' => 'required|integer|exists:maladies,id',
            'idConsultation' => 'required|integer|exists:consultations,id',
        ]);

        $diagnostic = Diagnostic::findOrFail($id);
        $diagnostic->idMaladie = $validatedData['idMaladie'];
        $diagnostic->idConsultation = $validatedData['idConsultation'];
        $diagnostic->save();

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic mis à jour avec succès');
    }

    public function destroy($id)
    {
        $diagnostic = Diagnostic::findOrFail($id);
        $diagnostic->delete();

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic supprimé avec succès!');
    }


    public function debut()
    {
        return view('experience_diagnostic.debut');
    }

    public function result()
    {
        return view('experience_diagnostic.result');
    }

    // Fonction pour calculer la correspondance
    public function calculateSimilarity($userSymptoms, $experienceSymptoms)
    {
        $matchingSymptoms = array_intersect($userSymptoms, $experienceSymptoms);
        $totalSymptoms = count($experienceSymptoms);

        return (count($matchingSymptoms) / $totalSymptoms) * 100;
    }

    public function process(Request $request)
    {
        // Récupérer les symptômes fournis par l'utilisateur
        $userSymptoms = array_map('trim', explode(',', $request->input('symptoms'))); // Diviser les symptômes par virgules et supprimer les espaces

        /*SymptomJournal::create([
            'idUtilisateur' => Auth::id(),
            'symptoms' => implode(', ', $userSymptoms), // Concaténer les symptômes pour stockage
            'severity' => 1, // Initialement, on pourrait commencer avec une gravité de 1 (à ajuster plus tard)
        ]);*/

        foreach ($userSymptoms as $symptom) {
            SymptomJournal::create([
                'idUtilisateur' => Auth::id(),
                'symptoms' => $symptom, // Enregistrer chaque symptôme individuellement
                'severity' => 1, // Tu peux ajuster la gravité selon les besoins
            ]);
        }

        // Chercher les expériences validées dans la base de données, avec la relation vers la maladie
        $experiences = Experience::with('maladie')->where('estValidee', true)->get();
        
        $results = [];

        // Comparer chaque expérience avec les symptômes de l'utilisateur
        foreach ($experiences as $experience) {
            $experienceSymptoms = array_map('trim', explode(',', $experience->description)); // Symptômes dans la description de l'expérience avec suppression des espaces
            $similarity = $this->calculateSimilarity($userSymptoms, $experienceSymptoms);

            // Si le pourcentage de correspondance est suffisant, on ajoute l'expérience dans les résultats
            if ($similarity > 50) { // Seuil de 50% de correspondance
                // Vérifier si la relation vers la maladie existe
                $maladie = $experience->maladie ? $experience->maladie->nom : 'Maladie inconnue';

                // Créer une consultation avec la date du diagnostic (stockée dans created_at)
                $consultation = new Consultation();
                $consultation->idUtilisateur = $consultation->idUtilisateur; // Associer à l'utilisateur connecté, si applicable
                $consultation->created_at = now(); // Enregistrer la date du diagnostic
                $consultation->save();

                // Enregistrer le diagnostic dans la table diagnostics en associant la consultation
                $diagnostic = new Diagnostic();
                $diagnostic->idMaladie = $experience->maladie->id ?? null; // ID de la maladie (s'il y en a une)
                $diagnostic->idConsultation = $consultation->id; // Lier le diagnostic à la consultation
                $diagnostic->save();

                // Ajouter les résultats pour l'affichage
                $results[] = [
                    'experience' => $experience,
                    'maladie' => $maladie, // Utiliser la maladie si elle existe, sinon afficher "Maladie inconnue"
                    'similarity' => $similarity,
                    'dateConsultation' => $consultation->created_at->format('d/m/Y H:i') // Ajouter la date pour affichage
                ];
            }
        }

        return view('experience_diagnostic.result', compact('results'));
    }
}