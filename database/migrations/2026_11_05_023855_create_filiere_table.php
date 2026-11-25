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
        Schema::create('filiere', function (Blueprint $table) {
            $table->string('code_filiere', 20)->primary();
            $table->string('nom_filiere');
            $table->unsignedBigInteger('id_departement');
            $table->foreign('id_departement')->references('id_departement')->on('departement')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiere');
    }
};
