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
            $table->string('description_departement')->nullable()->after('nom_departement');
            $table->string('sigle_departement')->nullable()->after('description_departement');
            $table->string('logo_departement')->nullable()->after('sigle_departement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departement', function (Blueprint $table) {
            $table->dropColumn('description_departement');
            $table->dropColumn('sigle_departement');
            $table->dropColumn('logo_departement');
        });
    }
};
