<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descripcion')->nullable();
            $table->string('chasis')->nullable();
            $table->string('motor')->nullable();
            $table->string('placa')->nullable();
            $table->year('anio')->unsigned();
            $table->integer('tipovehiculo_id')->unsigned();
            $table->integer('marca_id')->unsigned();
            $table->integer('modelo_id')->unsigned();
            $table->integer('combustible_id')->unsigned();
            $table->boolean('estado')->default(true);
            $table->string('slug');
            $table->timestamps();

            $table->foreign('tipovehiculo_id')->references('id')->on('tipovehiculos')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
            $table->foreign('combustible_id')->references('id')->on('combustibles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
