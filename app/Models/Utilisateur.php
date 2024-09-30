<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Utilisateur extends Authenticatable implements AuthenticatableContract, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'numero',
        'password', 
        'dateDeNaissance',
        'role',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
        //$this->attributes['password'] = $value;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    /*public function experiences()
    {
        return $this->hasMany(Experience::class);
    }*/

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'idUtilisateur');
    }
    
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idUtilisateur');
    }

    public function experiencesAdministrees()
    {
        return $this->hasMany(Experience::class, 'idAdministrateur')->where('role', 'A');
    }
}
