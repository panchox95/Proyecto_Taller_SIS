<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrodecomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrodecompras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_user');
            $table->integer('id_mercaderia');
            $table->string('nombre');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->integer('precio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrodecompras');
    }
}
