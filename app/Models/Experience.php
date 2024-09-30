<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experiences';

    /*protected $fillable = [
        'idUtilisateur',
        'idMaladie',
        'description',
        //'dateDePartage',
        'estValidee',
        'idAdministrateur',
    ];*/

    protected $fillable = [
        'idUtilisateur',
        'idMaladie',
        'description',
        'estValidee',
        'idAdministrateur',
    ];    

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idUtilisateur');
    }

    /*public function maladie()
    {
        return $this->belongsTo(Maladie::class);
    }*/

    public function maladie()
    {
        return $this->belongsTo(Maladie::class, 'idMaladie'); // Assurez-vous que 'idMaladie' est la clé étrangère correcte
    }

    public function administrateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idAdministrateur')->where('role', 'A');
    }
}
