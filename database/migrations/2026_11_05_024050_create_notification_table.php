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
        Schema::create('notification', function (Blueprint $table) {
            $table->id('id_notif');
            $table->text('description');
            $table->string('motif');
            $table->date('date')->useCurrent();
            $table->time('heure')->useCurrent();
            $table->unsignedBigInteger('id_eve');
            $table->foreign('id_eve')->references('id_eve')->on('evenement')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
