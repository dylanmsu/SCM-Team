<?php

namespace App\Http\Controllers;

use Auth;
use App\Vehicle;
use App\Vehicle_comment;
use App\User;
use App\Exports\VehicleExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RollingStockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function export() 
    {
        return Excel::download(new VehicleExport, 'Rollend_matrieel.xlsx');
    }

    public function rolling()
    {
        $normal_categories = Vehicle::select('category')->where('type', '=', 'normaal')->groupBy('category')->orderBy(\DB::raw('count(*)'), 'desc')->get();
        $normal_data = Vehicle::select('*')->where('type', '=', 'normaal')->with('vehicle_comment.User')->get();
        $small_categories = Vehicle::select('category')->where('type', '=', 'smal')->groupBy('category')->orderBy(\DB::raw('count(*)'), 'desc')->get();
        $small_data = Vehicle::select('*')->where('type', '=', 'smal')->with('vehicle_comment.User')->get();

        return view('rolling_stock/rolling_stock', [
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

    public function update_state($id, $state) 
    {
        Vehicle::where('id', $id)->update(['state'=>$state]);

        return redirect()->route('rolling');
    }

    public function add_stock_page() 
    {
        return view('rolling_stock/add_stock');
    }

    public function test() 
    {
        return view('rolling_stock/add_comment');
    }

    public function add_stock(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required'
        ]);

        $stock = new Vehicle([
            'category' => $request->get('category'),
            'name' => $request->get('name'),
            'state' => $request->get('state'),
            'comment' => $request->get('comment'),
            'type' => $request->get('type'),
        ]);

        $comments = new Vehicle_comment([
            'remarks' => $request->get('comment'),
            'vehicle_id' => DB::table('vehicles')->max('id')+1,
            'creator' => Auth::user()->id
        ]);

        $statusA = $stock->save();
        $statusB = $comments->save();


        if ($statusA || $statusB) {
            return redirect()->route('rolling')->with('success', "Successfully Submitted!");
        } else {
            return redirect()->route('add_stock')->with('error', "Something went wrong.");
        }
    }

    public function delete($id) 
    {
        Vehicle::where('id', $id)->delete();

        return redirect()->route('rolling');
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

        return redirect()->route('rolling');
    }
}
