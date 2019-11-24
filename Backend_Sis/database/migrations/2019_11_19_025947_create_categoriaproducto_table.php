<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaproductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoriaproducto', function (Blueprint $table) {
            $table->bigInteger('id_categoria');
            $table->bigInteger('id_producto');
        });
        //DB::unprepared('ALTER TABLE `categoriaproducto` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id_categoria` ,  `id_producto` )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoriaproducto');
    }
}
