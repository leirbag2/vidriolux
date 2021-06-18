<?php

namespace Database\Factories;

use App\Models\Ventas;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class VentasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ventas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numFactura' => $this->faker->unique()->numerify('ABC###'),
            'fechaVenta' => $this->faker->dateTimeBetween('-2 year'),
            'users_id' => User::inRandomOrder()->first()->id,
            'totalNeto' =>0,
            'iva' => 0,
            'totalIva' => 0,
            'precioCompra' => 0
        ];
    }
}
