<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'SuperAdmin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Conductor']);

        
      
        Permission::create(['name' => 'Users.Gestion'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'Users.Registro'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'Users.store'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'Users.Editar'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'Users.Actualizar'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'Users.Destroy'])->syncRoles($role1, $role2);


        
        Permission::create(['name' =>'Vehiculos.Gestion'])->syncRoles($role1, $role2);
        Permission::create(['name' =>'Vehiculos.Registro'])->syncRoles($role1, $role2);
        Permission::create(['name' =>'Vehiculos.store'])->syncRoles($role1, $role2);
        Permission::create(['name' =>'Vehiculos.Actualizar'])->syncRoles($role1, $role2);
        Permission::create(['name' =>'Vehiculos.Asignar'])->syncRoles($role1, $role2);
        Permission::create(['name' =>'Vehiculos.Estado'])->syncRoles($role1, $role2);

        Permission::create(['name' =>'Tickets.Gestion'])->syncRoles($role1, $role2);
        Permission::create(['name' =>'Tickets.Registro'])->syncRoles($role1);
        Permission::create(['name' =>'Tickets.store'])->syncRoles($role1, $role2);

        Permission::create(['name' =>'Rutas.Mapa'])->syncRoles($role1, $role2, $role3);
        Permission::create(['name' =>'Rutas.Coordenadas'])->syncRoles($role1, $role2, $role3);
        Permission::create(['name' =>'Rutas.Camion'])->syncRoles($role1, $role2, $role3);
        Permission::create(['name' =>'Rutas.Gestion'])->syncRoles($role1, $role2);





    }
}