<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerHistorial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `ingresar_stock` AFTER INSERT ON `historial`
        FOR EACH ROW UPDATE productos SET productos.stock = (productos.stock + (NEW.cantidad)) WHERE NEW.productos_id = productos.id');

        DB::unprepared('CREATE TRIGGER `delete_stock` BEFORE DELETE ON `historial`
        FOR EACH ROW UPDATE productos SET productos.stock = (productos.stock - (OLD.cantidad)) WHERE OLD.productos_id = productos.id');

        DB::unprepared('CREATE TRIGGER `update_stock` BEFORE UPDATE ON `historial`
        FOR EACH ROW IF(NEW.productos_id = OLD.productos_id) THEN UPDATE productos SET productos.stock = (productos.stock - (OLD.cantidad) + NEW.cantidad) WHERE productos.id = OLD.productos_id; 
        ELSE UPDATE productos SET productos.stock = (productos.stock - (OLD.cantidad)) WHERE productos.id = OLD.productos_id;
        UPDATE productos SET productos.stock = (productos.stock + (NEW.cantidad)) WHERE productos.id = NEW.productos_id; 
        END IF');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('Drop trigger `ingresar_stock`');
        DB::unprepared('Drop trigger `delete_stock`');
        DB::unprepared('Drop trigger `update_stock`');
    }
}
