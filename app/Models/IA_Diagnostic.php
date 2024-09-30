<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IA_Diagnostic extends Model
{
    use HasFactory;

    protected $table = 'i_a__diagnostics';

    protected $fillable = ['idConsultation', 'diagnosticIA', 'dateIADiagnostic'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'idConsultation', 'id');
    }
}