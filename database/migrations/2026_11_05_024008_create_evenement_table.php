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
        // Evenement = classe d'association rattachee a "propose" (filiere_niveau)
        Schema::create('evenement', function (Blueprint $table) {
            $table->id('id_eve');
            $table->string('libelle_eve');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('code_filiere', 20);
            $table->unsignedBigInteger('id_niveau');
            $table->foreign(['code_filiere', 'id_niveau'])
                  ->references(['code_filiere', 'id_niveau'])
                  ->on('filiere_niveau')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenement');
    }
};
