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
        Schema::create('edt', function (Blueprint $table) {
            $table->id('id_edt');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('statut', ["actif", "en attente"])->default("en attente");
            $table->string('code_classe');
            $table->foreign('code_classe')->references('code_classe')->on('classe')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edt');
    }
};
