<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMercaderiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mercaderias', function (Blueprint $table) {
            $table->increments('id_mercaderia');
            $table->timestamps();
            $table->string('nombre');
            $table->integer('stock');
            $table->string('descripcion');
            $table->integer('precio');
            $table->string('estado');
            $table->string('imagepath');
            $table->integer('descuento');
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
        Schema::dropIfExists('mercaderias');
    }
}
