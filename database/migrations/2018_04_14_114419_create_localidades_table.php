<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idred')->required()->unsigned();
            $table->integer('idzon')->required()->unsigned();
            $table->string('codloc', 3)->required();
            $table->string('nomloc', 35)->required();
            $table->string('desloc', 190)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });

        Schema::table('localidades', function (Blueprint $table) {
            $table->index(['idred', 'idzon', 'id']);
            $table->foreign('idred')->references('id')->on('redes');
            $table->foreign('idzon')->references('id')->on('zonas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localidades');
    }
}
