<?php

use Illuminate\Database\Seeder;
use App\Sales;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Sales::class, 1000)->create();

    }
}
