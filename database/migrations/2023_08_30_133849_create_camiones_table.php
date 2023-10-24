<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('camiones', function (Blueprint $table) {
      $table->id();
      $table->string('matricula');
      $table->string('marca');
      $table->string('modelo');
      $table->unsignedBigInteger('id_color')->nullable();
      $table->foreign('id_color')
        ->references('id')
        ->on('colores')
        ->onDelete('cascade');
      $table->string('profile_photo_path', 2048)->nullable();
      $table->unsignedBigInteger('id_estado')->nullable();
      $table->foreign('id_estado')
        ->references('id')
        ->on('estados')
        ->onDelete('cascade');
      $table->unsignedBigInteger('id_tipo')->nullable();
      $table->foreign('id_tipo')
        ->references('id')
        ->on('tipo_camiones')
        ->onDelete('cascade');
      $table->unsignedBigInteger('id_conductor')->nullable();
      $table->foreign('id_conductor')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');


      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('camiones');
  }
};
