<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id('id_niveau');
            $table->string('libelle_niveau');
            $table->timestamps();
        });


        Schema::create('filiere_niveau', function (Blueprint $table) {
            $table->unsignedBigInteger('idFiliere');
            $table->unsignedBigInteger('idNiveau');
            $table->primary(['idFiliere', 'idNiveau']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filiere_niveau');
        Schema::dropIfExists('niveaux');
    }
};
