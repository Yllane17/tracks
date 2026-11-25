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
        Schema::create('ec', function (Blueprint $table) {
            $table->string('code_ec', 10)->primary();
            $table->string('libelle_ec', 120);
            $table->unsignedInteger('nbre_credit')->default(3);
            $table->unsignedBigInteger('nbre_heure')->default(45);
            $table->text('description_ec')->nullable();
            $table->unsignedBigInteger('heure_tp');
            $table->unsignedBigInteger('heure_td');
            $table->unsignedBigInteger('heure_tcm');
            $table->string('code_ue', 10);
            $table->foreign('code_ue')->references('code_ue')->on('ue')->onDelete('cascade');
            $table->string('code_filiere', 20);
            $table->foreign('code_filiere')->references('code_filiere')->on('filiere')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec');
    }
};
