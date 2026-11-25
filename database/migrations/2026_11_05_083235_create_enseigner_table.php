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
        // Classe d'association "enseigne" : users 1..* <-> 0..* matiere_ec
        Schema::create('enseigner', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->string('code_ec', 10);
            $table->enum('type_cours', ['CM', 'TD', 'TP']);
            $table->unsignedInteger('vol_attribue');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('code_ec')->references('code_ec')->on('ec')->onDelete('cascade');
            $table->primary(['id_user', 'code_ec', 'type_cours']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseigner');
    }
};
