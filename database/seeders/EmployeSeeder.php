<?php

namespace Database\Seeders;

use App\Models\Employe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $users = User::where('role_id', 2)->get();
        foreach ($users as $user) {
            Employe::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
