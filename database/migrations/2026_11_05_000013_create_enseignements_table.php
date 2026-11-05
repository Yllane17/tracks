<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('enseignements', function (Blueprint $table) {
            $table->id();
           $table->foreignId('id_user')->constrained('users', 'id_user')->cascadeOnDelete();
            $table->foreignId('idEc')->constrained('matiere_ecs', 'idEc')->cascadeOnDelete();
            $table->enum('type_cours', ['CM', 'TD', 'TP']);
            $table->integer('vol_attribue')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enseignements');
    }
};
