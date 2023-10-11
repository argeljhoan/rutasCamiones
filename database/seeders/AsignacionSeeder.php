<?php

namespace Database\Seeders;

use App\Models\Asignacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=[
         
            'Si',
            'No',
    
            ];
            foreach ($names as $name) {
                Asignacion::create([
                    'name' => $name
                ]);
            }
    }
}
