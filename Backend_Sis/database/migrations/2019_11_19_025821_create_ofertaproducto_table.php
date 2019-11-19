<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertaproductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertaproducto', function (Blueprint $table) {
            $table->bigIncrements('id_oferta');
            $table->bigInteger('id_producto');
            $table->string('descripcion');
            $table->double('descuento');
            $table->string('estado');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertaproducto');
    }
}
