<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manager;
use App\Models\User;


class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role_id', 3)->get();
        foreach ($users as $user) {
            Manager::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
