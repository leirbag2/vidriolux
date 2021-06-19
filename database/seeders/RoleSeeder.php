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

        Permission::create(['name' => 'usuarios.index', 'description' => 'Ver usuarios'])->assignRole($admin);
        Permission::create(['name' => 'usuarios.create', 'description' => 'Crear usuarios'])->assignRole($admin);
        Permission::create(['name' => 'usuarios.edit', 'description' => 'Modificar usuarios'])->assignRole($admin);

        Permission::create(['name' => 'productos.index', 'description' => 'Ver productos'])->syncRoles([$admin,$bodeguero,$vendedor]);
        Permission::create(['name' => 'productos.create', 'description' => 'Crear productos'])->assignRole($admin);
        Permission::create(['name' => 'productos.edit', 'description' => 'Modificar productos'])->assignRole($admin);

        Permission::create(['name' => 'categorias.index', 'description' => 'Ver categorias'])->syncRoles([$admin,$bodeguero,$vendedor]);
        Permission::create(['name' => 'categorias.create', 'description' => 'Crear categorias'])->assignRole($admin);
        Permission::create(['name' => 'categorias.edit', 'description' => 'Modificar categorias'])->assignRole($admin);
        Permission::create(['name' => 'categorias.destroy', 'description' => 'Eliminar categorias'])->assignRole($admin);

        Permission::create(['name' => 'ventas.index', 'description' => 'Ver ventas'])->syncRoles([$admin,$vendedor]);
        Permission::create(['name' => 'ventas.create', 'description' => 'Crear ventas'])->syncRoles([$admin,$vendedor]);
        Permission::create(['name' => 'ventas.edit', 'description' => 'Modificar ventas'])->assignRole($admin);
        Permission::create(['name' => 'ventas.destroy', 'description' => 'Eliminar ventas'])->assignRole($admin);

        Permission::create(['name' => 'historial.index', 'description' => 'Ver historial de actualización de stock'])->syncRoles([$admin,$bodeguero]);
        Permission::create(['name' => 'historial.create', 'description' => 'Ingresar/Retirar productos de bodega'])->syncRoles([$admin,$bodeguero]);
        Permission::create(['name' => 'historial.edit', 'description' => 'Modificar historial'])->assignRole($admin);
        Permission::create(['name' => 'historial.destroy', 'description' => 'Eliminar historial'])->assignRole($admin);
        Permission::create(['name' => 'reportes.index', 'description' => 'Ver reportes'])->assignRole($admin);

    }
}
