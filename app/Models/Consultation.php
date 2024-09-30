<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    //protected $table = 'consultations'

    protected $fillable = ['dateConsultation', 'idUtilisateur', 'symptomes'];

    public function iaDiagnostics()
    {
        return $this->hasMany(IA_Diagnostic::class, 'idConsultation', 'id');
    }
    
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idUtilisateur'); // 'idUtilisateur' doit être la clé étrangère
    }
}