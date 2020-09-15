<?php

use Illuminate\Database\Seeder;

class SplitflapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 200 fake splitflaps
        factory(App\Splitflap::class, 200)->create();
    }
}
