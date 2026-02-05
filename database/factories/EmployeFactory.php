<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Departement;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'user_id'=>User::inRandomOrder()->first(),
             'departement_id'=>Departement::inRandomOrder()->first(),
             'token'=>$this->faker->numberBetween(500,1000),
        ];
    }
}
