<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idper')->required();
            $table->integer('idprov')->required();
            $table->string('numdoc', 15)->required();
            $table->date('fecha')->required();
            $table->date('fechav')->nullable();
            $table->decimal('tcosto', 11, 2)->nullable();
            $table->decimal('tmargen', 11, 2)->nullable();
            $table->decimal('tventa', 11, 2)->nullable();
            $table->decimal('tiva', 11, 2)->nullable();
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
        Schema::dropIfExists('ingresen');
    }
}
