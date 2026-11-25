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
        // Association "recoit" : notification 1..* <-> 0..* users
        Schema::create('notification_user', function (Blueprint $table) {
            $table->unsignedBigInteger('id_notif');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_notif')->references('id_notif')->on('notification')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->primary(['id_notif', 'id_user']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_user');
    }
};
