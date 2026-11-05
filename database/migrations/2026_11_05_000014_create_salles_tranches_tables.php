<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salles', function (Blueprint $table) {
            $table->id('idSalle');
            $table->string('libelle_salle');
            $table->integer('nbre_place');
            $table->string('batiment');
            $table->timestamps();
        });

        Schema::create('tranche_horaires', function (Blueprint $table) {
            $table->id('idTranche');
            $table->time('debut');
            $table->time('fin');
            $table->string('libelle_tranche');
            $table->time('duree');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tranche_horaires');
        Schema::dropIfExists('salles');
    }
};
