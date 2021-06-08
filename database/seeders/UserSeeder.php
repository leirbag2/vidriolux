<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Gabriel Maturana',
            'email' => 'gabrielmaturana1999@hotmail.com',
            'password' => '$2y$10$XXN34dl3xfJJswhgEtoWDe3iL3FLeCGlVKPPTsrzY3Brztf34UKHu',
        ])->assignRole('Administrador');
        User::factory(49)->create();
    }
}
