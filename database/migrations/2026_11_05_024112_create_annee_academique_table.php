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
        Schema::create('annee_academique', function (Blueprint $table) {
            $table->id('id_annee');
            $table->string('libelle_annee_academique', 120);
            $table->date('date_debut_annee_academique');
            $table->date('date_fin_annee_academique');
            $table->enum('statut', ["actif", "inactif"])->default("inactif");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annee_academique');
    }
};
