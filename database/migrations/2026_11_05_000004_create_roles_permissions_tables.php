<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('idRole');
            $table->string('libelle')->unique();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id('idPermission');
            $table->string('libelle_permission')->unique();
            $table->timestamps();
        });

       
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idRole')->constrained('roles', 'idRole')->cascadeOnDelete();
            $table->foreignId('idPermission')->constrained('permissions', 'idPermission')->cascadeOnDelete();
            $table->unique(['idRole', 'idPermission']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
