<?php
namespace Database\Factories;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */

class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   
    public function definition(): array
    {
        
        return [
            'departement_id' => Departement::inRandomOrder()->value('id'),
            'token' => $this->faker->numberBetween(100, 1000),
        ];
    }
}


