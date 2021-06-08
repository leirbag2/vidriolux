<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name'=>'Administrador']);
        $bodeguero = Role::create(['name'=>'Bodeguero']);
        $vendedor = Role::create(['name'=>'Vendedor']);

        Permission::create(['name' => 'usuarios.index'])->assignRole($admin);
        Permission::create(['name' => 'usuarios.create'])->assignRole($admin);
        Permission::create(['name' => 'usuarios.edit'])->assignRole($admin);
        Permission::create(['name' => 'usuarios.destroy'])->assignRole($admin);

        Permission::create(['name' => 'productos.index'])->syncRoles([$admin,$bodeguero,$vendedor]);
        Permission::create(['name' => 'productos.create'])->assignRole($admin);
        Permission::create(['name' => 'productos.edit'])->assignRole($admin);

        Permission::create(['name' => 'categorias.index'])->syncRoles([$admin,$bodeguero,$vendedor]);
        Permission::create(['name' => 'categorias.create'])->assignRole($admin);
        Permission::create(['name' => 'categorias.edit'])->assignRole($admin);
        Permission::create(['name' => 'categorias.destroy'])->assignRole($admin);

        Permission::create(['name' => 'ventas.index'])->syncRoles([$admin,$vendedor]);
        Permission::create(['name' => 'ventas.create'])->syncRoles([$admin,$vendedor]);
        Permission::create(['name' => 'ventas.edit'])->assignRole($admin);
        Permission::create(['name' => 'ventas.destroy'])->assignRole($admin);

        Permission::create(['name' => 'historial.index'])->syncRoles([$admin,$bodeguero]);
        Permission::create(['name' => 'historial.create'])->syncRoles([$admin,$bodeguero]);
        Permission::create(['name' => 'historial.edit'])->assignRole($admin);
        Permission::create(['name' => 'reportes.index'])->assignRole($admin);

    }
}
