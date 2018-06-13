<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pediden', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idperiodo')->requerid();
            $table->integer('idagencia')->requerid();
            $table->integer('idbodega')->requerid();
            $table->integer('idred')->requerid();
            $table->integer('idzona')->requerid();
            $table->integer('idloca')->requerid();
            $table->integer('idcliente')->requerid();
            $table->date('fechaped')->requerid();
            $table->decimal('tventa', 11, 2)->nullable();
            $table->decimal('tiva', 11, 2)->nullable();
            $table->tinyInteger('pedfac')->default(0);
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
        Schema::dropIfExists('pediden');
    }
}
