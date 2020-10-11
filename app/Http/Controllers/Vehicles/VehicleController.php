<?php

namespace App\Http\Controllers\Vehicles;

use Auth;
use File;
use App\Vehicle;
use App\Vehicle_file;
use App\Vehicle_comment;
use Illuminate\Http\Request;
use App\Exports\VehicleExport;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class VehicleController extends Controller
{
    // adds middleware auth so users who arent logged in cant access these methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    // export to excel
    public function export() 
    {
        return Excel::download(new VehicleExport, 'Rollend_matrieel.xlsx');
    }

    // edit vehicle
    public function edit($id, Request $request)
    {
        $vehicle = Vehicle::find($id);

        $vehicle->type = $request->get('type');
        $vehicle->category = $request->get('category');
        $vehicle->name = $request->get('name');
        $vehicle->state = $request->get('state');

        $vehicle->save();

        // return to view with hash on url to open a certain accordion list
        $viewelement = '#collapse-'.$request->get('type').'-'.$request->get('category');
        return redirect(route('vehicles').$viewelement)->with(['scrollto' => $viewelement]);
    }

    // delete vehicle
    public function delete($id) 
    {
        // delete files accociated with the vehicle
        $files = Vehicle::where('id', $id)->with('vehicle_file')->get()[0]->vehicle_file;
        foreach ($files as $key => $file) {
            File::delete(public_path('storage/vehicle_img/').$file->url);
        }

        // delete the vehicle entry in database
        Vehicle::where('id', $id)->delete();

        // return to the vehicles page
        return redirect()->route('vehicles');
    }

    // add comment to vehicle
    public function add_comment($id, Request $request) 
    {
        // store the comment
        $comments = new Vehicle_comment([
            'remarks' => $request->get('remarks'),
            'vehicle_id' => $id,
            'creator' => Auth::user()->id
        ]);
        $comments->save();

        // update state of the vehicle
        Vehicle::where('id', $id)->update(['state' => $request->get('state')]);
        
        // redirect to vehicles
        $viewelement = '#collapse-'.$request->get('type').'-'.$request->get('category');
        return redirect(route('vehicles').$viewelement.$request->get('vehicle'));
    }

    /*----------------------------- private methods ------------------------------- */

    public static function upload_images($request, $id) 
    {
        // store the images
        if ($request->hasfile('image')) {

            // loop through the images
            foreach ($request->file('image') as $key => $file) {

                // store image in storage
                $name = $id . '_vehicle_'. time() . $key . '.' . $file->getClientOriginalExtension();
                $file->storeAs('vehicle_img', $name);

                // store image name in database
                $file = new Vehicle_file([
                    'url' => 'storage/vehicle_img/'.$name,
                    'vehicle_id' => $id,
                    'name' => $name,
                    'type' => 'img'
                ]);
                $file->save();
            }
        }
    }

    public static function upload_examination($request, $id) 
    {
        // store the documents
        if ($request->hasfile('exam')) {

            // store docs in storage
            $file = $request->file('exam');
            $name = $id . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->storeAs('vehicle_docs', $name);
            $category = $request->get('exam_category');

            // store doc name in database
            $file = new Vehicle_file([
                'url' => 'storage/vehicle_docs/'.$name,
                'vehicle_id' => $id,
                'name' => $name,
                'category' => $category,
                'test_date' => $request->get('test_date'),
                'type' => 'exam'
            ]);
            $file->save();
        }
    }

    public static function upload_documents($request, $id) 
    {
        // store the documents
        if ($request->hasfile('docs')) {

            // loop through the documents
            foreach ($request->file('docs') as $key => $file) {

                // store docs in storage
                $name = $id . $key . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->storeAs('vehicle_docs', $name);
                $category = $request->get('file_category');

                // store doc name in database
                $file = new Vehicle_file([
                    'url' => 'storage/vehicle_docs/'.$name,
                    'vehicle_id' => $id,
                    'name' => $name,
                    'category' => $category,
                    'type' => 'doc'
                ]);
                $file->save();
            }
        }
    }
}
