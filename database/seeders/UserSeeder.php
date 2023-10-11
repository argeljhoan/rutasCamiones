<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name' => 'Argel Rodriguez ',
            'email' => 'argeljhoan@gmail.com',
            'password' => bcrypt('argel123'),
            'identificacion' => 1093797862,
            'telefono' => 3218097734,
            'id_acceso' => 1,
            'id_asignacion' => 2
        ])->assignRole('SuperAdmin');

        User::create([
            'name' => 'Julian Sequeda ',
            'email' => 'julian@example.com',
            'password' => bcrypt('julian123'),
            'identificacion' => 1093797456,
            'telefono' => 3214092354,
            'id_acceso' => 1,
            'id_asignacion' => 2
        ])->assignRole('Admin');


        User::create([
            'name' => 'luis Lopez ',
            'email' => 'luislopez@example.com',
            'password' => bcrypt('luis123'),
            'identificacion' => 1094794556,
            'telefono' => 3268092354,
            'id_acceso' => 1,
            'id_asignacion' => 2
        ])->assignRole('Conductor');

    }
}
