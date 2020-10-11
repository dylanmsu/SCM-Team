<?php

namespace App\Http\Controllers\Vehicles;

use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleViewsController extends Controller
{
    // adds middleware auth so users who arent logged in cant access these methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_vehicle_page()
    {
        return view('vehicles/add_vehicle');
    }

    // vehicles homepage
    public function vehicles()
    {
        // get all data from database so we can later display it in the view
        $normal_categories = Vehicle::select('category')->where('type', '=', 'normaal')->groupBy('category')->orderBy(\DB::raw('count(*)'), 'desc')->get();
        $normal_data = Vehicle::select('*')->where('type', '=', 'normaal')->with('vehicle_comment.User')->get();
        $small_categories = Vehicle::select('category')->where('type', '=', 'smal')->groupBy('category')->orderBy(\DB::raw('count(*)'), 'desc')->get();
        $small_data = Vehicle::select('*')->where('type', '=', 'smal')->with('vehicle_comment.User')->get();

        //send view to front end with the data
        return view('vehicles/vehicles', [
            'data' => [
                [
                    'type' => 'normaal',
                    'categories' => $normal_categories,
                    'data' => $normal_data
                ],
                [
                    'type' => 'smal',
                    'categories' => $small_categories,
                    'data' => $small_data
                ]
            ],
        ]);
    }

    // show properties view
    public function show_properties($id)
    {
        $vehicle_properties = Vehicle::select('*')->where('id', '=', $id)->orderBy('category')->with('vehicle_file', 'Vehicle_property')->get();
        
        $internal = "";
        $external = "";
        $water = "";

        foreach ($vehicle_properties[0]->vehicle_file->where('category', 'internal')->take(1) as $key => $value) {
            $internal = $this->return_bootstrap_status($value->test_date, 12);
        }
        foreach ($vehicle_properties[0]->vehicle_file->where('category', 'external')->take(1) as $key => $value) {
            $external = $this->return_bootstrap_status($value->test_date, 12);;
        }
        foreach ($vehicle_properties[0]->vehicle_file->where('category', 'water')->take(1) as $key => $value) {
            $water = $this->return_bootstrap_status($value->test_date, 3 * 12);
        }
        
        return view('vehicles/vehicle_properties',[
            'data' => $vehicle_properties,
            'external' => $external,
            'internal' => $internal,
            'water' => $water
        ]);
    }

    private function return_bootstrap_status($date, $interval_in_months)
    {
        if ($date !== null) {

            $expiry_date = Carbon::createFromFormat('Y-m-d', $date)->addMonths($interval_in_months);

            if (Carbon::now()->gt($expiry_date) && Carbon::now()->lt($expiry_date->addMonths(3))){
                return 'badge-warning';
            } else if (Carbon::now()->gt($expiry_date->addMonths(3))) {
                return 'badge-danger';
            } else{
                return 'badge-success';
            }
        } else {
            return 'badge-secondary';
        }
        
    }
}
