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
        Schema::create('i_a__diagnostics', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('idConsultation')->nullable();
            $table->text('diagnosticIA');
            $table->timestamps();

            $table->foreign('idConsultation')->references('id')->on('consultations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_a__diagnostics');
    }
};
