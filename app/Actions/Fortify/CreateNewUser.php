<?php

namespace App\Actions\Fortify;

use App\Models\Administrateur;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */

     public function create(array $input)
     {
         // Validation des données entrées
         Validator::make($input, [
             'prenom' => ['required', 'string', 'max:255'],
             'nom' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:utilisateurs'],
             'numero' => ['required', 'string', 'max:15'],
             'dateDeNaissance' => ['required', 'date'],
             'password' => $this->passwordRules(),
             'role' => ['required', 'string', 'in:U,A'], // Utilisateur ou Administrateur
         ])->validate();
     
         // Création de l'utilisateur
         $user = Utilisateur::create([
             'prenom' => $input['prenom'],
             'nom' => $input['nom'],
             'email' => $input['email'],
             'numero' => $input['numero'],
             'dateDeNaissance' => $input['dateDeNaissance'],
             'password' => $input['password'], // Mot de passe déjà haché
             'role' => $input['role'] ?? 'U', // Role par défaut: Utilisateur
         ]);
     
         // Envoi de l'e-mail de vérification
         $user->sendEmailVerificationNotification();
     
         // Retourne l'utilisateur créé
         return $user;
     }     
}
