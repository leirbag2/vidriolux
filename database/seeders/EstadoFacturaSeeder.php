<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_venta')->insert(
            array(
                ['estado' => 'Realizado'],
                ['estado' => 'Anulado']
            )
        );
    }
}
