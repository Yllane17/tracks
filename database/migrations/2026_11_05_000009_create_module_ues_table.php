<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module_ues', function (Blueprint $table) {
            $table->id('idUe');
            $table->string('libelle_ue', 120);
            $table->integer('nbre_credit');
            $table->enum('type_ue', ["fondamentale", "optionnelle", "transversale"])->default("fondamentale");
            $table->foreignId('id_sem')->constrained('semestres', 'id_sem')->cascadeOnDelete();
            $table->unsignedBigInteger('idFiliere')->nullable();
            $table->string("id_nieau",10);
            $table->foreign("id_niveau")->references("id_niveau")->on("niveaux")->onDelete("cascade");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_ues');
    }
};
