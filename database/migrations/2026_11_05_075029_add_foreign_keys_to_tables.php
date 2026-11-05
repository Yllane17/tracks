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
            $table->foreign('idFiliere')
                ->references('idFiliere')->on('filieres')
                ->nullOnDelete();
        });

        Schema::table('module_ues', function (Blueprint $table) {
            $table->foreign('idFiliere')
                ->references('idFiliere')->on('filieres')
                ->nullOnDelete();
        });

        Schema::table('filiere_niveau', function (Blueprint $table) {
            $table->foreign('idFiliere')
                ->references('idFiliere')->on('filieres')
                ->cascadeOnDelete();
            $table->foreign('idNiveau')
                ->references('id_niveau')->on('niveaux')
                ->cascadeOnDelete();
        });

        Schema::table('user_role', function (Blueprint $table) {
            $table->foreign('id_user')
                ->references('id_user')->on('users')
                ->cascadeOnDelete();
            $table->foreign('id_role')
                ->references('idRole')->on('roles')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('user_role', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_role']);
        });

        Schema::table('filiere_niveau', function (Blueprint $table) {
            $table->dropForeign(['idFiliere']);
            $table->dropForeign(['idNiveau']);
        });

        Schema::table('module_ues', function (Blueprint $table) {
            $table->dropForeign(['idFiliere']);
        });

        Schema::table('departement', function (Blueprint $table) {
            $table->dropForeign(['idFiliere']);
        });
    }
};
