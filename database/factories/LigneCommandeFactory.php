<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LigneCommande>
 */
class LigneCommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $produit = Produit::inRandomOrder()->first();
        $quantite = fake()->numberBetween(1, 5);

        return [
            'produit_id' => $produit->id,
            'qte' => $quantite,
            'prix_unitaire' => $produit->prix_tokens,
            
        ];
    }
}
