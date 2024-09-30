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
        Schema::create('symptomes', function (Blueprint $table) {
            $table->id('id'); 
            $table->unsignedBigInteger('idConsultation')->nullable(); 
            $table->unsignedBigInteger('idMaladie')->nullable(); 
            $table->unsignedBigInteger('idExperience')->nullable(); 
            $table->string('nom', 150);
            $table->text('description');
            $table->timestamps();
           
            $table->foreign('idConsultation')->references('id')->on('consultations')->onDelete('set null');
            $table->foreign('idMaladie')->references('id')->on('maladies')->onDelete('set null');
            $table->foreign('idExperience')->references('id')->on('experiences')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symptomes');
    }
};
