<?php

namespace Database\Factories;

use App\Models\Productos;
use App\Models\Categorias;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Productos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $precio = $this->faker->numberBetween(100,5000);
        return [
            'codigo' => $this->faker->unique()->bothify('???#####'),
            'nombreProducto' => $this->faker->words(2,true),
            'descripcionProducto' => $this->faker->sentences(1,true),
            'stock' => $this->faker->numberBetween(200,400),
            'precioNeto' => $precio,
            'precioIva' => $precio * 0.19,
            'precioVenta' => (($precio * 1.19) * 5),
            'categorias_id' => Categorias::inRandomOrder()->first()->id,
            'tipo_estado_id' => 1
        ];
    }
}
