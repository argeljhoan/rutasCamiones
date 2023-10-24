<?php

namespace Database\Factories;
use App\Models\Camiones;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Camiones>
 */
class CamionesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $camion = Camiones::class;

    public function definition()
    {
        return [
            'profile_photo_path'=>null,
            'marca' => $this->faker->randomElement(['Toyota', 'Ford', 'Honda', 'Chevrolet', 'Volkswagen', 'Nissan']),
            'modelo' => $this->faker->year(),
            'id_color'=>$this->faker->numberBetween(1, 10),
            'matricula'=> $this->faker->unique()->numberBetween(10000, 99999),
            'id_estado'=>1,
            'id_tipo'=>1,
            'id_conductor'=> null,
        ];
    }
}
