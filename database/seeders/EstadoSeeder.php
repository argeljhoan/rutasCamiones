<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=[
         
            'Funcionando',
            'Mantenimiento',
            'sin servicio',
            
            ];
            foreach ($names as $name) {
                Estado::create([
                    'name' => $name
                ]);
            }
    }
}
