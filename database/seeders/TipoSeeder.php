<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=[
         
            'Doble Troque',
            
    
            ];
            foreach ($names as $name) {
                Tipo::create([
                    'name' => $name
                ]);
            }
    }
}
