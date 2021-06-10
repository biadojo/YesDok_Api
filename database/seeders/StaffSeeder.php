<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Staff::factory(15)->create();
    }
}
