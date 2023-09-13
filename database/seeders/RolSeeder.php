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
        $role1 = Role::create(['name' => 'SuperAdmin' ]);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Conductor' ]);

       // Permission:: create(['name' => 'admin.home'])->syncRoles($role1,$role2);
    }
}