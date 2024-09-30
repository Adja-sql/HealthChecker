<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('id');
            $table->string('prenom', 50);
            $table->string('nom', 50);
            $table->string('email', 50)->unique();
            $table->string('numero', 15)->unique();
            $table->string('motDePasse', 100)->unique();
            $table->date('dateDeNaissance');
            $table->timestamps();
        });

        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->string('password')->after('email');
            $table->rememberToken()->after('password');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
