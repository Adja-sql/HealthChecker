<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptome extends Model
{
    use HasFactory;

    protected $fillable = [
        'idConsultation',
        'idMaladie',
        'idExperience',
        'nom',
        'description',
    ];

    public function maladie()
    {
        return $this->belongsTo(Maladie::class, 'idMaladie');
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'idConsultation');
    }

    /*public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'idConsultation');
    }*/
}
