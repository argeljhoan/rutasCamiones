<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

          $colores=[
         
            ['name' => 'Blanco', 'codigo' => '#FFFFFF'],
            ['name' => 'Negro', 'codigo' => '#000000'],
            ['name' => 'Rojo', 'codigo' => '#FF0000'],
            ['name' => 'Azul', 'codigo' => '#0000FF'],
            ['name' => 'Verde', 'codigo' => '#008000'],
            ['name' => 'Amarillo', 'codigo' => '#FFFF00'],
            ['name' => 'Gris', 'codigo' => '#808080'],
            ['name' => 'Naranja', 'codigo' => '#FFA500'],
            ['name' => 'Plateado', 'codigo' => '#616A6B'],
            ['name' => 'Dorado', 'codigo' => '#FFD700'],
            ['name' => 'Marrón', 'codigo' => '#8B4513'],
            ['name' => 'Rosado', 'codigo' => '#FF69B4'],
            ['name' => 'Morado', 'codigo' => '#800080'],
            ['name' => 'Turquesa', 'codigo' => '#40E0D0'],
    
            ];

          
            foreach ($colores as $color) {
                Color::create([
                    'name' => $color['name'],
                    'codigo' => $color['codigo'],
                ]);
            }


    }
}
