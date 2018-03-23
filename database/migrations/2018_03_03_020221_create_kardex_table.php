<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex', function (Blueprint $table) {
            $table->integer('idbodega')->required();
            $table->integer('idperiodo')->required();
            $table->integer('idarticulo')->required();
            $table->decimal('inicial', 11, 2)->nullable();
            $table->decimal('entradas', 11, 2)->nullable();
            $table->decimal('salidas', 11, 2)->nullable();
            $table->decimal('conteo1', 11, 2)->nullable();
            $table->decimal('conteo2', 11, 2)->nullable();
            $table->decimal('conteo3', 11, 2)->nullable();
            $table->decimal('vcosto', 11, 2)->required();
            $table->index('idarticulo');
            $table->foreign('idarticulo')->references('id')->on('articulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kardex');
    }
}
