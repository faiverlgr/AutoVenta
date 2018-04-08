<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zonas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idred')->required()->unsigned();
            $table->string('codzon', 3)->required();
            $table->string('nomzon', 25)->required();
            $table->string('deszon', 190)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });

        Schema::table('zonas', function (Blueprint $table) {
            $table->index(['idred', 'codzon']);
            $table->foreign('idred')->references('id')->on('redes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zonas');
    }
}
