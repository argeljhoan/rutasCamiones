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
        Schema::create('mapa', function (Blueprint $table) {
            $table->id();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('estadoLaboral')->nullable();
            $table->string('estadoSituacion')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedBigInteger('id_camion')->nullable();
            $table->foreign('id_camion')
                ->references('id')
                ->on('camiones');
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
        Schema::dropIfExists('mapa');
    }
};
