<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id('id_eve');
            $table->string('libelle_eve');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();
        });

        Schema::create('app_notifications', function (Blueprint $table) {
            $table->id('id_notif');
            $table->text('description');
            $table->string('motif');
            $table->date('date');
            $table->time('heure');
            $table->foreignId('id_eve')->nullable()->constrained('evenements', 'id_eve')->nullOnDelete();
            $table->timestamps();
        });


        Schema::create('notification_user', function (Blueprint $table) {
           $table->foreignId('id_user')->constrained('users', 'id_user')->cascadeOnDelete();
            $table->foreignId('id_notif')->constrained('app_notifications', 'id_notif')->cascadeOnDelete();
            $table->unique(['id_user', 'id_notif']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_user');
        Schema::dropIfExists('app_notifications');
        Schema::dropIfExists('evenements');
    }
};
