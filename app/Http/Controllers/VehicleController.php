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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function export() 
    {
        return Excel::download(new VehicleExport, 'Rollend_matrieel.xlsx');
    }

    public function vehicles()
    {
        $normal_categories = Vehicle::select('category')->where('type', '=', 'normaal')->groupBy('category')->orderBy(\DB::raw('count(*)'), 'desc')->get();
        $normal_data = Vehicle::select('*')->where('type', '=', 'normaal')->with('vehicle_comment.User')->get();
        $small_categories = Vehicle::select('category')->where('type', '=', 'smal')->groupBy('category')->orderBy(\DB::raw('count(*)'), 'desc')->get();
        $small_data = Vehicle::select('*')->where('type', '=', 'smal')->with('vehicle_comment.User')->get();

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

    public function add_vehicle(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required'
        ]);

        $vehicle = new Vehicle([
            'category' => $request->get('category'),
            'name' => $request->get('name'),
            'state' => $request->get('state'),
            'comment' => $request->get('comment'),
            'type' => $request->get('type'),
        ]);
        $statusA = $vehicle->save();

        $id = DB::table('vehicles')->max('id');

        $comments = new Vehicle_comment([
            'remarks' => $request->get('comment'),
            'vehicle_id' => $id,
            'creator' => Auth::user()->id
        ]);
        $statusB = $comments->save();

        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $key => $file) {
                $name = $id . '_vehicle_'. time() . $key . '.' . $file->getClientOriginalExtension();
                $file->storeAs('vehicle_img', $name);

                $file = new Vehicle_file([
                    'url' => $name,
                    'vehicle_id' => $id,
                    'description' => 'hello',
                    'type' => 'hello'
                ]);
                $file->save();
            }
        }

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

        if ($statusA || $statusB) {
            return redirect()->route('vehicles');
        } else {
            return redirect()->route('add_vehicle')->with('error', "Something went wrong.");
        }
    }

    public function upload_img(Request $request, $id)
    {
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $key => $file) {
                $name = $id . '_vehicle_'. time() . $key . '.' . $file->getClientOriginalExtension();
                $file->storeAs('vehicle_img', $name);

                $file = new Vehicle_file([
                    'url' => $name,
                    'vehicle_id' => $id,
                    'type' => 'image'
                ]);
                $file->save();
            }
        }
        return redirect()->route('show_properties', $id);
    }

    public function show_edit($id)
    {
        return view('vehicles/add_vehicle', [
            'vehicle' => Vehicle::find($id),
            'action' => 'edit'
        ]);
    }

    public function edit($id, Request $request)
    {
        $vehicle = Vehicle::find($id);

        $vehicle->type = $request->get('type');
        $vehicle->category = $request->get('category');
        $vehicle->name = $request->get('name');
        $vehicle->state = $request->get('state');

        $vehicle->save();

        $viewelement = '#collapse-'.$request->get('type').'-'.$request->get('category');
        return redirect(route('vehicles').$viewelement)->with(['scrollto' => $viewelement]);
    }

    public function delete($id) 
    {
        $files = Vehicle::where('id', $id)->with('vehicle_file')->get()[0]->vehicle_file;
        foreach ($files as $key => $file) {
            File::delete(public_path('storage/vehicle_img/').$file->url);
        }


        Vehicle::where('id', $id)->delete();

        return redirect()->route('vehicles');
    }

    public function add_comment($id, Request $request) 
    {
        $comments = new Vehicle_comment([
            'remarks' => $request->get('remarks'),
            'vehicle_id' => $id,
            'creator' => Auth::user()->id
        ]);

        $comments->save();
        Vehicle::where('id', $id)->update(['state' => $request->get('state')]);

        return redirect()->route('vehicles');
    }

    public function show_properties($id)
    {
        return view('vehicles/vehicle_properties',[
            'data' => Vehicle::select('*')->where('id', '=', $id)->with('vehicle_file', 'Vehicle_property')->get()
        ]);
    }

    public function add_prop($id, Request $request)
    {
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
        return redirect()->route('show_properties', $id);
    }
}
