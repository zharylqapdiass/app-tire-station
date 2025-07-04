<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TireServicesSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TireServicesSeeder::class,
        ]);
    }
}
