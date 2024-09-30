<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('idUtilisateur')->nullable();
            $table->timestamps();

            $table->foreign('idUtilisateur')->references('id')->on('utilisateurs')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
