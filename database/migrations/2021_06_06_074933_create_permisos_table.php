<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcionPermiso');
        });

        DB::table('permisos')->insert(
            array(
                ['descripcionPermiso' => 'Ver usuarios'],
                ['descripcionPermiso' => 'Ver productos'],
                ['descripcionPermiso' => 'Ver ventas'],
                ['descripcionPermiso' => 'Ver reportes'],
                ['descripcionPermiso' => 'Ver productos'],
                ['descripcionPermiso' => 'Ver historial de movimientos',],
                ['descripcionPermiso' => 'Administrar usuarios',],
                ['descripcionPermiso' => 'Administrar productos',],
                ['descripcionPermiso' => 'Administrar categorias',],
                ['descripcionPermiso' => 'Ver productos',],
                ['descripcionPermiso' => 'Modificar stock de bodega',],
                ['descripcionPermiso' => 'Realizar venta',]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
