<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>fake()->name(),        
            'prix_tokens'=>fake()->randomFloat(2, 10, 1000),        
            'stock'=>fake()->numberBetween(0,1000),        
            'description'=>fake()->text(),  
            'image_produit'=>fake()->imageUrl(),  
            'est_premuim'=>fake()->boolean(),  
            ];
    }
}
