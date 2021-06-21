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
        // create 50 fake splitflaps
        factory(App\Splitflap::class, 50)->create();
        factory(App\BoardData::class, 20)->create();
    }
}
