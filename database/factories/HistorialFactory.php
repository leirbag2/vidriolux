<?php

namespace Database\Factories;

use App\Models\Productos;
use App\Models\User;
use App\Models\Historial;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistorialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Historial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeBetween('-6 month');
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'productos_id' => Productos::inRandomOrder()->first()->id,
            'cantidad' => rand(-20,50),
            'created_at' => $fecha,
            'updated_at' => $fecha
        ];
    }
}
