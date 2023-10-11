<?php

namespace Database\Seeders;

use App\Models\Mapa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoordenadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Mapa::create([
            'latitud' =>'7.8939100' ,
            'longitud' => '-72.5078200',
            
                
        ]);

    }
}
