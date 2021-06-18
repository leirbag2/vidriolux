<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombreProducto');
            $table->text('descripcionProducto');
            $table->integer('stock');
            $table->integer('precioNeto');
            $table->integer('precioIva');
            $table->integer('precioVenta');
            $table->unsignedBigInteger('categorias_id')->nullable(true);
            $table->foreign('categorias_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('tipo_estado_id')->default(1);
            $table->foreign('tipo_estado_id')->references('id')->on('tipo_estado')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
