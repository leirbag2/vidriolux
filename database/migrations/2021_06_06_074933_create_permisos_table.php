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
                ['descripcionPermiso' => 'Agregar usuarios'],
                ['descripcionPermiso' => 'Modificar usuarios'],
                ['descripcionPermiso' => 'Ver productos'],
                ['descripcionPermiso' => 'Agregar productos'],
                ['descripcionPermiso' => 'Modificar productos'],
                ['descripcionPermiso' => 'Ver categorias'],
                ['descripcionPermiso' => 'Agregar categorias'],
                ['descripcionPermiso' => 'Modificar categorias'],
                ['descripcionPermiso' => 'Eliminar categorias'],
                ['descripcionPermiso' => 'Ver ventas'],
                ['descripcionPermiso' => 'Ver reportes'],
                ['descripcionPermiso' => 'Ver historial de movimientos'],
                ['descripcionPermiso' => 'Modificar stock de bodega'],
                ['descripcionPermiso' => 'Realizar venta']
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
