<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('edts', function (Blueprint $table) {
            $table->id('id_Edt');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('statut_edt',["actif", "en_attente"])->default('en_attente');
            $table->foreignId('idClasse')->constrained('classes', 'idClasse')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edts');
    }
};
