<?php

namespace App\Http\Controllers\Vehicles;

use App\Vehicle_property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Vehicles\VehicleController;

class VehiclePropertyController extends Controller
{
    // adds middleware auth so users who arent logged in cant access these methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload_img(Request $request, $id)
    {
        VehicleController::upload_images($request, $id);

        // return back to show_properties
        return redirect()->route('show_properties', $id);
    }

    public function upload_doc(Request $request, $id)
    {
        VehicleController::upload_documents($request, $id);

        // return back to show_properties
        return redirect()->route('show_properties', $id);
    }

    public function upload_exam(Request $request, $id)
    {
        // delete files before entering new data
        $file = Vehicle_file::where('vehicle_id', $id)->where('category', $request->get('exam_category'));
        if ($file->count() !== 0) {
            foreach ($file->get() as $item){
                File::delete($item->url);
                $item->delete();
            }
            
        }

        VehicleController::upload_examination($request, $id);

        // return back to show_properties
        return redirect()->route('show_properties', $id);
    }

    // add property to vehicle
    public function add_prop($id, Request $request)
    {
        // loop through properties
        if ($request->has('prop') && $request->has('val')) {
            foreach ($request->get('prop') as $key => $value) {

                // store property
                $property = new Vehicle_property([
                    'key' => $request->get('prop')[$key], 
                    'value' => $request->get('val')[$key], 
                    'vehicle_id' => $id,
                    'type' => 'aded'
                ]);
                $property->save();
            }
        }

        // redirect back to properties
        return redirect()->route('show_properties', $id);
    }
}
