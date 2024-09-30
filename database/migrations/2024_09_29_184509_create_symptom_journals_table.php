<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('symptom_journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUtilisateur')->constrained('utilisateurs')->onDelete('cascade');
            $table->text('symptoms'); // stocke les symptômes entrés
            $table->integer('severity')->default(1); // Gravité des symptômes
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symptom_journals');
    }
};
