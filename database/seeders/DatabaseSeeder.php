<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DashboardButton;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('hydration'),
        ]);

        for ($i = 1; $i <= 9; $i++) {
            DashboardButton::create([
                'title' => null,
                'hyperlink' => null,
                'color' => null,
            ]);
        }
    }
}
