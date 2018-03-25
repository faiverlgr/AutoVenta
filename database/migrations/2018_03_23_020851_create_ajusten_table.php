<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAjustenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajusten', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('idper')->unsigned();
            $table->tinyInteger('idtipo')->required();
            $table->Integer('idconcepto')->unsigned();
            $table->date('fecha')->required();
            $table->decimal('tcosto',11,2)->required();
            $table->decimal('tneto',11,2)->required();
            $table->decimal('tventa',11,2)->required();
            $table->decimal('tiva',11,2)->required();
            $table->tinyInteger('estado')->required();
            $table->timestamps();
        });
        
        //Schema::disableForeignKeyConstraints();
        Schema::table('ajusten', function (Blueprint $table) {
            $table->index('idper');
            $table->index('idtipo');
            $table->index('idconcepto');
            $table->index(['tipo', 'idconcepto']);
            $table->foreign('idconcepto')->references('id')->on('concepto_ajustes');            
            $table->foreign('idper')->references('id')->on('periodos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ajusten');
    }
}
