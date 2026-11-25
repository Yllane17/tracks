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
        Schema::table('filiere', function (Blueprint $table) {
            $table->string('description_filiere')->nullable()->after('nom_filiere');
            $table->string('duree_filiere')->nullable()->after('description_filiere');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filiere', function (Blueprint $table) {
            $table->dropColumn('description_filiere');
            $table->dropColumn('duree_filiere');
        });
    }
};
