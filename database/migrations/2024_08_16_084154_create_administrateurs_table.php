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
        Schema::create('administrateurs', function (Blueprint $table) {
            $table->id('id');
            $table->string('prenom', 50);
            $table->string('nom', 50);
            $table->string('email', 50)->unique();
            $table->string('password', 100)->unique();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrateurs');
    }
};
