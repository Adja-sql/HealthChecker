<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->boolean('is_online')->default(false); // Champ pour suivi de l'état en ligne
        });
    }

    public function down()
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->dropColumn('is_online');
        });
    }
};
