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
        Schema::create('classe', function (Blueprint $table) {
            $table->string('code_classe')->primary();
            $table->unsignedInteger('nb_etudiant')->default(25);
            $table->unsignedBigInteger('id_niveau');
            $table->foreign('id_niveau')->references('id_niveau')->on('niveau')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe');
    }
};
