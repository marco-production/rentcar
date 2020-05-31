<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_renta');
            $table->date('fecha_devolucion');
            $table->integer('monto')->unsigned();
            $table->integer('dias')->unsigned();
            $table->integer('empleado_id')->unsigned();
            $table->integer('vehiculo_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->text('comentario')->nullable();
            $table->boolean('estado')->default(true);
            $table->string('slug');
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentas');
    }
}
