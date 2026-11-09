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
        Schema::table('departement', function (Blueprint $table) {
            $table->string('departement_description')->nullable()->after('nom_departement');
            $table->string('departement_sigle')->nullable()->after('departement_description');
            $table->string('departement_logo')->nullable()->after('departement_sigle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departement', function (Blueprint $table) {
            $table->string('departement_description');
            $table->string('departement_sigle');
            $table->string('departement_logo');
        });
    }
};
