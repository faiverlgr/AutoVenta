<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('documento', 20);
            $table->string('nombre1', 55)->required();
            $table->string('nombre2', 55);
            $table->string('apellido1', 55)->required();
            $table->string('apellido2', 55);
            $table->string('email', 55);
            $table->string('telefono1', 20);
            $table->string('telefono2', 20);
            $table->string('barrio', 55);
            $table->string('ciudad', 55);
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('personas');
    }
}
