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
        Schema::create('ue', function (Blueprint $table) {
            $table->string("code_ue", 10)->primary();
            $table->string("libelle_ue", 120);
            $table->unsignedInteger("nbre_credit");
            $table->enum("type_ue", ["fondamentale", "optionnelle", "transversale"])->default("fondamentale");
            $table->string("code_filiere", 20);
            $table->foreign('code_filiere')->references('code_filiere')->on('filiere')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ue');
    }
};
