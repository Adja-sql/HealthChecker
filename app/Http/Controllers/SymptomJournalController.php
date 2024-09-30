<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SymptomJournal;
use Illuminate\Support\Facades\Auth;

class SymptomJournalController extends Controller
{
    public function index()
    {
        $symptomsData = SymptomJournal::where('idUtilisateur', Auth::id())
                        ->orderBy('created_at', 'asc') // Trier par date
                        ->get();

        return view('symptom_tracking.index', compact('symptomsData'));
    }
}