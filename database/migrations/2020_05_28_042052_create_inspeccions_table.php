<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspeccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspeccions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ralladura')->default(false);
            $table->string('combustible');
            $table->string('goma_repuesto')->default(false);
            $table->string('gato')->default(false);
            $table->string('rotura_cristal')->default(false);
            $table->string('gomas')->nullable()->default(null);
            $table->date('fecha_inspeccion');
            $table->integer('renta_id')->unsigned();
            //$table->integer('cliente_id')->unsigned();
            $table->integer('empleado_id')->unsigned();
            $table->boolean('estado')->default(true);
            $table->string('slug');
            $table->timestamps();

            $table->foreign('renta_id')->references('id')->on('rentas')->onDelete('cascade');
            //$table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspeccions');
    }
}
