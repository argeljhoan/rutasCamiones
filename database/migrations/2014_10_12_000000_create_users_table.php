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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->unsignedBigInteger('identificacion')->Unique()->nullable();
            $table->unsignedBigInteger('telefono')->nullable();
            $table->unsignedBigInteger('id_acceso')->nullable();
            $table->foreign('id_acceso')
          ->references('id')
          ->on('acceso')
          ->onDelete('cascade');
            $table->unsignedBigInteger('id_asignacion')->nullable();
            $table->foreign('id_asignacion')
          ->references('id')
          ->on('asignacion')
          ->onDelete('cascade');
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
