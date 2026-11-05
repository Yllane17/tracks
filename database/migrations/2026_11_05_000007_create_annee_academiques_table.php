<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('annee_academiques', function (Blueprint $table) {
            $table->id('id_anne');
            $table->string('libelle_annee');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->enum('statut_academique', ["actif","inactif"])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('annee_academiques');
    }
};
