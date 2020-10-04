<?php

namespace App\Http\Controllers;

use Auth;
use File;
use App\User;
use App\Vehicle;
use App\Vehicle_file;
use App\Vehicle_comment;
use App\Vehicle_property;
use App\Notifications\Hello;
use Illuminate\Http\Request;
use App\Exports\VehicleExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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

        // store the documents
        if ($request->hasfile('docs')) {

            // loop through the documents
            foreach ($request->file('docs') as $key => $file) {

                // store docs in storage
                $name = time() . $key . '.' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->storeAs('vehicle_docs', $name);

                // store doc name in database
                $file = new Vehicle_file([
                    'url' => 'storage/vehicle_docs/'.$name,
                    'vehicle_id' => $id,
                    'name' => $name,
                    'type' => 'doc'
                ]);
                $file->save();
            }
        }

        // store the properties
        if ($request->has('prop') && $request->has('val')) {
            foreach ($request->get('prop') as $key => $value) {

                $property = new Vehicle_property([
                    'key' => $request->get('prop')[$key], 
                    'value' => $request->get('val')[$key], 
                    'vehicle_id' => $id
                ]);
                $property->save();
            }
        }

        // return back to the vehicle home page
        return redirect()->route('vehicles');
    }

    public function upload_img(Request $request, $id)
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

        // return back to show_properties
        return redirect()->route('show_properties', $id);
    }

    public function upload_doc(Request $request, $id)
    {
        // store the documents
        if ($request->hasfile('docs')) {

            // loop through the documents
            foreach ($request->file('docs') as $key => $file) {

                // store docs in storage
                $name = time() . $key . '.' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->storeAs('vehicle_docs', $name);

                // store doc name in database
                $file = new Vehicle_file([
                    'url' => 'storage/vehicle_docs/'.$name,
                    'vehicle_id' => $id,
                    'name' => $name,
                    'type' => 'doc'
                ]);
                $file->save();
            }
        }

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

        // notify the users that a comment is added
        $vehicle = Vehicle::select('*')->where('id', '=', $id)->with('vehicle_comment.User')->get();
        $users = User::where('id', '!=', auth()->id())->get();
        foreach($users as $user)
        {
            $user->notify(new CommentAdded($vehicle));
        }
        
        // redirect to vehicles
        return redirect()->route('vehicles');
    }

    // show properties view
    public function show_properties($id)
    {
        return view('vehicles/vehicle_properties',[
            'data' => Vehicle::select('*')->where('id', '=', $id)->with('vehicle_file', 'Vehicle_property')->get()
        ]);
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
                    'vehicle_id' => $id
                ]);
                $property->save();
            }
        }

        // redirect back to properties
        return redirect()->route('show_properties', $id);
    }

    public function add_vehicle_page()
    {
        return view('vehicles/add_vehicle');
    }
}
