<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('Drop trigger `ingresar_stock`');
    }
}
