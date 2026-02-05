<?php

namespace Database\Seeders;

use App\Models\departement;
use App\Models\Manager;;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\DepartementSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        $this->call(RoleSeeder::class);
        User::factory(50)->create();
        $this->call(DepartementSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(EmployeSeeder::class);
        $this->call(ProduitSeeder::class);
        $this->call(CommandeSeeder::class);
    }
}
