<?php

use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 20 fake users vehicles with each 5 comments
        factory(App\Vehicle::class, 50)->create()->each(function ($vehicle) {
            $vehicle->vehicle_comment()->saveMany(factory(App\Vehicle_comment::class, rand(0, 5))->make());
            $vehicle->vehicle_property()->saveMany(factory(App\Vehicle_property::class, 10)->make());
        });
    }
}
