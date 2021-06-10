<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cashier::factory(15)->create();
    }
}
