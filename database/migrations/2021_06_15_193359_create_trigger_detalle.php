<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `ingresar_venta` AFTER INSERT ON `detalle_ventas`
        FOR EACH ROW UPDATE productos SET productos.stock = (productos.stock - (NEW.cantidad)) WHERE NEW.productos_id = productos.id');

        DB::unprepared('CREATE TRIGGER `update_stock_detalle` BEFORE DELETE ON `detalle_ventas`
        FOR EACH ROW
        UPDATE productos SET productos.stock = (productos.stock + OLD.cantidad) WHERE productos.id = OLD.productos_id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('Drop trigger `ingresar_venta`');
        DB::unprepared('Drop trigger `update_stock_detalle`');
    }
}
