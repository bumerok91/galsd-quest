<?php

use App\Http\Models\OrderDetails;
use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderDetails::class, 50)->create();
    }
}
