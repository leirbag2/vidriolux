<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTipoEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_estado', function (Blueprint $table) {
            $table->id();
            $table->string('descripcionEstado');
        });

        DB::table('tipo_estado')->insert(
            array(
                ['descripcionEstado' => 'Habilitado'],
                ['descripcionEstado' => 'Deshabilitado']
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
        Schema::dropIfExists('tipo_estado');
    }
}
