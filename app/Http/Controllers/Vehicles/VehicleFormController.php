<?php

namespace App\Http\Controllers\Vehicles;

use Auth;
use File;
use App\User;
use App\Vehicle;
use Carbon\Carbon;
use App\Vehicle_file;
use App\Vehicle_comment;
use App\Vehicle_property;
use App\Notifications\Hello;
use Illuminate\Http\Request;
use App\Exports\VehicleExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class VehicleFormController extends Controller
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

        $this->upload_images($request, $id);
        $this->upload_documents($request, $id);
        $this->upload_examination($request, $id);

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

    public function upload_img(Request $request, $id)
    {
        $this->upload_images($request, $id);

        // return back to show_properties
        return redirect()->route('show_properties', $id);
    }

    public function upload_doc(Request $request, $id)
    {
        $this->upload_documents($request, $id);

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

        $this->upload_examination($request, $id);

        // return back to show_properties
        return redirect()->route('show_properties', $id);
    }

    // return vehicle edit page
    public function show_edit($id)
    {
        return view('vehicles/add_vehicle', [
            'vehicle' => Vehicle::find($id),
            'action' => 'edit'
        ]);
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

    /*----------------------------- private methods ------------------------------- */

    private function upload_images($request, $id) 
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

    private function upload_examination($request, $id) 
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

    private function upload_documents($request, $id) 
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
