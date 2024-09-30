<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable; // Remplacer Model par Authenticatable
use Illuminate\Notifications\Notifiable;

/*class Administrateur extends Model
{
    use HasFactory;*/

class Administrateur extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, Notifiable;

    protected $fillable = [ 
        'prenom',
        'nom',
        'email',
        'motDePasse',
        //'password',
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
}
