<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id('id_prog');
            $table->date('date');
            $table->string('libelle_prog');
            $table->enum('statut', ["valider", "facturer", "en_cours"])->default('en_cours');
            $table->foreignId('id_Edt')->constrained('edts', 'id_Edt')->cascadeOnDelete();
            $table->foreignId('idSalle')->constrained('salles', 'idSalle')->cascadeOnDelete();
            $table->foreignId('idTranche')->constrained('tranche_horaires', 'idTranche')->cascadeOnDelete();
            $table->foreignId('idEc')->constrained('matiere_ecs', 'idEc')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
