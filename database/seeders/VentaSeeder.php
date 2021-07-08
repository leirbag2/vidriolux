<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ventas;
use App\Models\Productos;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ventas::factory(75)->create();
        $ventas = Ventas::all();
        foreach ($ventas as $venta) {
            $cantidadP = rand(1, 5);
            $total = 0;
            $totalCompra = 0;
            for ($i = 0; $i < $cantidadP; $i++) {
                $producto = Productos::inRandomOrder()->first();
                $cantidad = rand(1, 10);
                $total +=  $producto->precioIva * $cantidad;
                $totalCompra += $producto->precioCompra * $cantidad;
                $venta->productos()
                    ->attach(
                        $producto->id,
                        [
                            'cantidad' => $cantidad,
                            'subtotal' => $cantidad * $producto->precioIva,
                            'precioCompra' => $producto->precioCompra,
                            'precioVenta' => $producto->precioIva
                        ]
                    );
            }
            $venta->precioCompra = $totalCompra;
            $venta->totalIva = $total;
            $venta->totalNeto = $total / 1.19;
            $venta->iva = ($total / 1.19) * 0.19;
            $venta->save();
        }
    }
}
