<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscription', function (Blueprint $table) {
            // PK auto-incrémentée (recommandé pour Eloquent)
            $table->id('id_inscription');

            $table->date('date_inscription')->useCurrent();
            $table->enum('statut_inscription', ['en cours', 'inactif'])->default('en cours');

            $table->unsignedBigInteger('id_user');
            $table->string('code_classe');
            $table->unsignedBigInteger('id_annee');

            $table->foreign('id_user')
                  ->references('id_user')->on('users')
                  ->onDelete('cascade');

            $table->foreign('code_classe')
                  ->references('code_classe')->on('classe')
                  ->onDelete('cascade');

            $table->foreign('id_annee')
                  ->references('id_annee')->on('annee_academique')
                  ->onDelete('cascade');

            // Unicité métier : un user ne s'inscrit qu'une fois
            // dans une classe pour une année donnée
            $table->unique(['id_user', 'code_classe', 'id_annee']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscription');
    }
};