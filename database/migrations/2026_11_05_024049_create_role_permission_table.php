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
        // Association "accorde" : role 1..* <-> 1..* permission
        Schema::create('role_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_permission');
            $table->foreign('id_role')->references('id_role')->on('role')->onDelete('cascade');
            $table->foreign('id_permission')->references('id_permission')->on('permission')->onDelete('cascade');
            $table->primary(['id_role', 'id_permission']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
