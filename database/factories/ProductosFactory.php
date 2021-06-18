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
        $precio = $this->faker->numberBetween(1000,10000);
        return [
            'codigo' => $this->faker->unique()->numerify('ABC###'),
            'nombreProducto' => $this->faker->words(2,true),
            'descripcionProducto' => $this->faker->words(20,true),
            'stock' => $this->faker->numberBetween(100,300),
            'precioNeto' => $precio,
            'precioIva' => $precio * 0.19,
            'precioVenta' => $precio * 1.19,
            'categorias_id' => Categorias::inRandomOrder()->first()->id,
            'tipo_estado_id' => 1
        ];
    }
}
