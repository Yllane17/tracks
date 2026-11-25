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
        Schema::create('semestre', function (Blueprint $table) {
            $table->id('id_sem');
            $table->unsignedInteger('nbre_sem');
            $table->unsignedBigInteger('id_annee');
            $table->foreign('id_annee')->references('id_annee')->on('annee_academique')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semestre');
    }
};
