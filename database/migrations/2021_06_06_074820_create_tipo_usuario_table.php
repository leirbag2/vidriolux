<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTipoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('descripcionTipo');
        });

        DB::table('tipo_usuario')->insert(
            array(
                ['descripcionTipo' => 'Administrador'],
                ['descripcionTipo' => 'Bodeguero'],
                ['descripcionTipo' => 'Vendedor']
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
        Schema::dropIfExists('tipo_usuario');
    }
}
