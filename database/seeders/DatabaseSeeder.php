<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ProduitSeeder;
use Database\Seeders\RuleSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User',
            'email' => 'test2@example.com',
        ]);

        $this->call([
            ProduitSeeder::class,
            RuleSeeder::class,
        ]);
    }
}
