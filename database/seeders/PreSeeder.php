<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class PreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name' => 'piece',
            'plural' => 'pieces'
        ]);
        Unit::create([
            'name' => 'tube',
            'plural' => 'tubes'
        ]);
        Unit::create([
            'name' => 'pair',
            'plural' => 'pairs'
        ]);
        Unit::create([
            'name' => 'set',
            'plural' => 'sets'
        ]);
    }
}
