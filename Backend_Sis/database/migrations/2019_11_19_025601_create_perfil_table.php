<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil', function (Blueprint $table) {
            $table->bigIncrements('id_perfil');
            $table->bigInteger('id_user');
            $table->integer('telefono')->nullable(true);
            $table->string('direccion')->nullable(true);
            $table->string('foto')->nullable(true);
            $table->integer('tarjeta')->nullable(true);
            $table->integer('zipcode')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil');
    }
}
