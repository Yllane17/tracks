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
        // Association "propose" : filiere 1..* <-> 1..* niveau
        Schema::create('filiere_niveau', function (Blueprint $table) {
            $table->string('code_filiere', 20);
            $table->unsignedBigInteger('id_niveau');
            $table->foreign('code_filiere')->references('code_filiere')->on('filiere')->onDelete('cascade');
            $table->foreign('id_niveau')->references('id_niveau')->on('niveau')->onDelete('cascade');
            $table->primary(['code_filiere', 'id_niveau']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiere_niveau');
    }
};
