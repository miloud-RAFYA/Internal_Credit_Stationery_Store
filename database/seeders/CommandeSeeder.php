<?php
namespace Database\Seeders;
use App\Models\Commande;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LigneCommande;
use App\Models\User;


class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
       Commande::factory(5)->create();
    }
}

