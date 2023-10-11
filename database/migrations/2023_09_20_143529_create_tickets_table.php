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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('radicado');
            $table->date('fecha');
            $table->time('hora');
            $table->string('procedencia');
            $table->string('destino');
            $table->string('despachador');
            $table->unsignedBigInteger('id_conductor')->nullable();
            $table->foreign('id_conductor')
            ->references('id')
            ->on('camiones');
            $table->string('pesoBruto');
            $table->string('pesoTara');
            $table->string('pesoNeto');
            $table->string('recibido');
            $table->string('fototicket', 2048)->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
