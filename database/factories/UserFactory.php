<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = User::class;

    
    public function definition()
    {
        $user = new User([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'identificacion' => $this->faker->unique()->numerify('##########'), // Genera un número de 10 dígitos
            'telefono' => $this->faker->numerify('##########'), // Genera un número de 10 dígitos
            'id_acceso' => 1,
            'id_asignacion' => 2,
        ]);

        $user->assignRole('Conductor');

        return $user->getAttributes();
    }
}
