<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Support\Facades\DB;

class LigneCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commandes = Commande::all();

        foreach ($commandes as $commande) {
            LigneCommande::factory(rand(1, 3))->create([
                'commande_id' => $commande->id,
            ]);

            $montant = LigneCommande::where('commande_id', $commande->id)
                ->sum(DB::raw('qte*prix_unitaire'));

            $commande->update([
                'montant_tokens' => $montant,
            ]);
        }
    }
}
