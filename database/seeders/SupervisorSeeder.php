<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Supervisor::factory(15)->create();
    }
}
