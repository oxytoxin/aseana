<?php

namespace Database\Seeders;

use Database\Seeders\PreSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PreSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
