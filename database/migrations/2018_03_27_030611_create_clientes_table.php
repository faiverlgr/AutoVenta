<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipdoc', 2)->required()->default('13');
            $table->string('nrodoc', 15)->required();
            $table->string('nombres', 25)->nullable();
            $table->string('apellidos', 25)->nullable();
            $table->string('razons', 30)->required();
            $table->string('direccion', 45)->required();
            $table->integer('idciudad')->required();
            $table->string('telefono1', 15)->required();
            $table->string('telefono2', 15)->required();
            $table->string('email', 25)->nullable();
            $table->tinyInteger('estado')->required()->default(1);
            $table->timestamps();
        });
        
        Schema::table('clientes', function (Blueprint $table) {
            $table->index('documento');
            $table->index('nombres');
            $table->index('razons');
            $table->index('idepto');
            $table->index('idciudad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
