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
        Schema::create('seance', function (Blueprint $table) {
            $table->id('id_seance');
            $table->date('date');
            $table->string('libelle_seance', 120);
            $table->enum('statut', ["en cours", "validé", "facturé"])->default("en cours");
            $table->unsignedBigInteger('id_edt');
            $table->unsignedBigInteger('id_tranche');
            $table->unsignedBigInteger('id_salle');
            $table->unsignedBigInteger('id_user');
            $table->string('code_ec', 10);
            $table->foreign('id_edt')->references('id_edt')->on('edt')->onDelete('cascade');
            $table->foreign('id_tranche')->references('id_tranche')->on('tranche')->onDelete('cascade');
            $table->foreign('id_salle')->references('id_salle')->on('salle')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('code_ec')->references('code_ec')->on('ec')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seance');
    }
};
