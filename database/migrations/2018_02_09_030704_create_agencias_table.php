<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codage', 4)->required()->unique();
            $table->string('nitage', 15)->nullable();
            $table->string('nombre', 50)->required();
            $table->string('nomrepre', 50)->required();
            $table->string('docrepre', 15)->required();
            $table->string('direccion', 80)->required();
            $table->string('barrio', 80)->required();
            $table->string('telefono1', 15)->nullable();
            $table->string('telefono2', 15)->nullable();
            $table->string('email', 80)->nullable();
            $table->tinyInteger('estado')->default(1);
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
        Schema::dropIfExists('agencias');
    }
}
