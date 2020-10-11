<?php

namespace App\Http\Controllers\Vehicles;

use Auth;
use App\Vehicle;
use App\Vehicle_file;
use App\Vehicle_comment;
use App\Vehicle_property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Vehicles\VehicleController;

class VehicleAddController extends Controller
{
    // adds middleware auth so users who arent logged in cant access these methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    // add vehicle to database
    public function add_vehicle(Request $request)
    {
        // store the vehicle
        $vehicle = new Vehicle([
            'category' => $request->get('category'),
            'name' => $request->get('name'),
            'state' => $request->get('state'),
            'comment' => $request->get('comment'),
            'type' => $request->get('type'),
        ]);
        $vehicle->save();

        //get id of the vehicle that has just been added
        $id = DB::table('vehicles')->max('id');

        // store the comment
        $comments = new Vehicle_comment([
            'remarks' => $request->get('comment'),
            'vehicle_id' => $id,
            'creator' => Auth::user()->id
        ]);
        $comments->save();

        VehicleController::upload_images($request, $id);
        VehicleController::upload_documents($request, $id);
        VehicleController::upload_examination($request, $id);

        // store the properties
        if ($request->has('prop') && $request->has('val')) {
            foreach ($request->get('prop') as $key => $value) {

                $property = new Vehicle_property([
                    'key' => $request->get('prop')[$key], 
                    'value' => $request->get('val')[$key], 
                    'vehicle_id' => $id,
                    'type' => 'normal'
                ]);
                $property->save();
            }
        }

        // store the wheel and shaft properties
        if ($request->has('prop2') && $request->has('val2')) {
            foreach ($request->get('prop2') as $key => $value) {

                $property = new Vehicle_property([
                    'key' => $request->get('prop2')[$key], 
                    'value' => $request->get('val2')[$key], 
                    'vehicle_id' => $id,
                    'type' => 'wheels'
                ]);
                $property->save();
            }
        }

        // store the examinations
        $examination_types = array('external', 'internal', 'water');
        foreach ($examination_types as $key => $type) {
            if ($request->hasfile($type)) {

                // store docs in storage
                $file = $request->file($type);
                $name = $id . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->storeAs('vehicle_docs', $name);

                // store doc name in database
                $file = new Vehicle_file([
                    'url' => 'storage/vehicle_docs/'.$name,
                    'vehicle_id' => $id,
                    'name' => $name,
                    'test_date' => $request->get('date-'.$type),
                    'category' => $type,
                    'type' => 'exam'
                ]);
                $file->save();
            }
        }

        // return back to the vehicle home page
        return redirect()->route('vehicles');
    }
}
