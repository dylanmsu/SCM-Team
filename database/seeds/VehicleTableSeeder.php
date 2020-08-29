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
        factory(App\Vehicle::class, 20)->create()->each(function ($vehicle) {
            $vehicle->vehicle_comment()->saveMany(factory(App\Vehicle_comment::class, 5)->make());
        });
        
        //factory(App\Vehicle::class, 50)->create();
    }
}
