<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_estado')->insert(
            array(
                ['descripcionEstado' => 'Habilitado'],
                ['descripcionEstado' => 'Deshabilitado']
            )
        );

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategoriaSeeder::class,
            ProductosSeeder::class,
            EstadoFacturaSeeder::class,
            VentaSeeder::class,
            HistorialSeeder::class
        ]);
    }
}
