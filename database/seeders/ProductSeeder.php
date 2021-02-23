<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = Product::create([
            'name' => 'Relay Baton',
            'srp' => 980,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 1,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Hand Grip Yonex',
            'srp' => 69,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 20,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Towel Grip Yonex',
            'srp' => 79,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 28,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Chess Set',
            'srp' => 780,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 4,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'B/B Ball Dreamtem',
            'srp' => 350,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 4,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'B/B Ball Mascot Evolution',
            'srp' => 880,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 5,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'B/B Ball Mikasa BR1200',
            'srp' => 1280,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'B/B Ball Powermax',
            'srp' => 295,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 7,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'B/B Ball Mikasa BR1500',
            'srp' => 1500,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'V/B Ball Mikasa V320W',
            'srp' => 3380,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 1,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'V/B Ball Ordinary',
            'srp' => 260,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 9,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'V/B Ball Mascot Evolution',
            'srp' => 280,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 5,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'V/B Ball Mikasa Speedball',
            'srp' => 880,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 4,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'V/B Net Ordinary',
            'srp' => 295,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'B/B Net Mascot',
            'srp' => 295,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 1,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Badminton Net GTO',
            'srp' => 980,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Badminton Net Yonex',
            'srp' => 980,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Volleyball Scorebook',
            'srp' => 65,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 7,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Chess Mat Mascot',
            'srp' => 750,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Sepak Takraw Ball Gajamas 211',
            'srp' => 890,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 3,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Sepak Takraw Ball Gajamas 511',
            'srp' => 930,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 3,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Sepak Takraw Ball MT201J',
            'srp' => 695,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 3,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Sepak Takraw Ball MT201',
            'srp' => 695,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 3,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Sepak Takraw Ball MT-909',
            'srp' => 1075,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Sepak Takraw Ball MT101',
            'srp' => 695,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 3,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Sepak Takraw Ball Gajamas 311',
            'srp' => 890,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 1,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Sepak Takraw Ball Avant Grande',
            'srp' => 760,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Shoes Class B',
            'srp' => 980,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 2,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Shoes Nike Kids',
            'srp' => 560,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 4,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Shoes Vans',
            'srp' => 580,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 5,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
        $p = Product::create([
            'name' => 'Saund Suit',
            'srp' => 650,
            'unit_id' => 1,
        ]);
        $s = $p->stock()->create([
            'quantity' => 7,
            'restocked_at' => Carbon::now(),
        ]);
        $p->restocks()->create([
            'quantity' => $s->quantity,
        ]);
    }
}