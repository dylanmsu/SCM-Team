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
        factory(App\Splitflap::class, 500)->create();
    }
}
