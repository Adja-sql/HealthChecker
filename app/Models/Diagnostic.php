<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = [
        'idMaladie',
        'idConsultation',
        //'sourceDiagnostic',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'idConsultation');
    }

    public function maladie()
    {
        return $this->belongsTo(Maladie::class, 'idMaladie');
    }
}
