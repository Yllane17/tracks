<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        Schema::create('matiere_ecs', function (Blueprint $table) {
            $table->id('idEc');
            $table->string('libelle');
            $table->integer('credit');
            $table->integer('vol_horaire');
            $table->text('description')->nullable();
            $table->string('td')->nullable();
            $table->string('tp')->nullable();
            $table->string('cm')->nullable();
            $table->foreignId('idUe')->constrained('module_ues', 'idUe')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matiere_ecs');
    }
};
