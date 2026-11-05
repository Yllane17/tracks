<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
           $table->foreignId('id_user')->constrained('users', 'id_user')->cascadeOnDelete();
            $table->foreignId('idClasse')->constrained('classes', 'idClasse')->cascadeOnDelete();
            $table->foreignId('id_anne')->constrained('annee_academiques', 'id_anne')->cascadeOnDelete();
            $table->enum('date_inscription', ["encours", "inactif"])->default("encours");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
