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
        Schema::create('tranche', function (Blueprint $table) {
            $table->id("id_tranche");
            $table->time("heure_debut");
            $table->time("heure_fin");
            $table->string("libelle_tranche", 120);
            $table->unsignedBigInteger("duree_tranche")->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranche');
    }
};
