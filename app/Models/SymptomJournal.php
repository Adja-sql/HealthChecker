<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymptomJournal extends Model
{
    use HasFactory;

    protected $table = 'symptom_journals';

    // Ajoute ici toutes les colonnes autorisées pour l'affectation de masse
    protected $fillable = [
        'idUtilisateur', 
        'symptoms', 
        'severity'
    ];

    // Relations (si nécessaire)
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idUtilisateur');
    }
}
