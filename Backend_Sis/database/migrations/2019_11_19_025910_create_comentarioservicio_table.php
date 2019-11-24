<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentarioservicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarioservicio', function (Blueprint $table) {
            $table->bigIncrements('id_comentario');
            $table->bigInteger('id_servicio');
            $table->bigInteger('id_user');
            $table->string('comentario');
            $table->integer('calificacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarioservicio');
    }
}
