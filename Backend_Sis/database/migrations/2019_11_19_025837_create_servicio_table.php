<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->bigIncrements('id_servicio');
            $table->string('nombre');
            $table->string('marca')->nullable(true);
            $table->integer('cantidad')->nullable(true);
            $table->integer('precio');
            $table->string('descripcion');
            $table->string('estado');
            $table->string('tipo');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio');
    }
}
