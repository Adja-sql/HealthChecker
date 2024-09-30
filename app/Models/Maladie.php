<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maladie extends Model
{
    use HasFactory;

    protected $fillable = [ //je peux modifier ces champs
        'nom',
        'description',
    ];

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class, 'idDiagnostic');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'idExperience');
    }

    public function maladie()
    {
        return $this->belongsTo(Maladie::class, 'idMaladie');
    }
}
