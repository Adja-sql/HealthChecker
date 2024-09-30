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
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('idMaladie')->nullable();
            $table->unsignedBigInteger('idConsultation')->nullable();
            $table->enum('experience', ['experience', 'ia']);
            $table->timestamps();

            $table->foreign('idMaladie')->references('id')->on('maladies')->onDelete('set null');
            //$table->foreign('idConsultation')->references('id')->on('consultations')->onDelete('set null');
            $table->foreign('idConsultation')->references('id')->on('consultations')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
