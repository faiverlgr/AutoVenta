<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcli')->required()->unsigned();
            $table->integer('idred')->required()->unsigned();
            $table->integer('idzon')->required()->unsigned();
            $table->integer('idloc')->required()->unsigned();
            $table->string('nomneg', 45)->required();
            $table->string('direccion', 45)->required();
            $table->integer('idciudad')->required();
            $table->string('telefono', 15)->nullable();
            $table->string('email', 25)->nullable();
            $table->integer('tipneg')->default(1);
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
        Schema::table('negocios', function (Blueprint $table) {
            $table->index('idcli');
            $table->index(['idred', 'idzon', 'idloc', 'idcli']);
            $table->foreign('idcli')->references('id')->on('clientes');
            $table->foreign('idred')->references('id')->on('redes');
            $table->foreign('idzon')->references('id')->on('zonas');
            $table->foreign('idloc')->references('id')->on('localidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negocios');
    }
}
