<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaservicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoriaservicio', function (Blueprint $table) {
            $table->bigInteger('id_categoria');
            $table->bigInteger('id_servicio');
        });
       // DB::unprepared('ALTER TABLE `categoriaservicio` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id_categoria` ,  `id_servicio` )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoriaservicio');
    }
}
