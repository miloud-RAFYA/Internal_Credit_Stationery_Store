<?php

namespace Database\Seeders;
use App\Models\Commande;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LigneCommande;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        $commandes = Commande::factory(5)->create();
        foreach ($commandes as $commande) {

            $nbLignes = rand(1, 4);

            LigneCommande::factory($nbLignes)->create([
                'commande_id' => $commande->id,
            ]);

            $lignes = LigneCommande::where('commande_id', $commande->id)->get();

            $montant = 0;

            foreach ($lignes as $ligne) {
                $montant += $ligne->prix_unitaire * $ligne->qte;
            }

            $commande->update([
                'montant_tokens' => $montant,
            ]);
        }
    }
}
