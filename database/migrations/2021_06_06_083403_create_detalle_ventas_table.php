<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->unsignedBigInteger('ventas_id');
            $table->foreign('ventas_id')->references('id')->on('ventas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('productos_id');
            $table->foreign('productos_id')->references('id')->on('productos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('precioCompra')->nullable();
            $table->integer('precioVenta')->nullable();
            $table->integer('cantidad');
            $table->integer('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
}
