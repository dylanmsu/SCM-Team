<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vehicle;
use App\vehicle_comments;

class RollingStockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rolling()
    {
        $normal_categories = vehicle::select('category')->where('type', '=', 'normaal')->groupBy('category')->get();
        $normal_data = vehicle::select('*')->where('type', '=', 'normaal')->get();
        $small_categories = vehicle::select('category')->where('type', '=', 'smal')->groupBy('category')->get();
        $small_data = vehicle::select('*')->where('type', '=', 'smal')->get();



        return view('rolling_stock/rolling_stock', [
            'small_categories' => $small_categories, 
            'small_data' => $small_data, 
            'normal_categories' => $normal_categories, 
            'normal_data' => $normal_data
        ]);
    }

    public function update_state($id, $state) 
    {
        vehicle::where('id', $id)->update(['state'=>$state]);

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

        $stock = new vehicle([
            'category' => $request->get('category'),
            'name' => $request->get('name'),
            'state' => $request->get('state'),
            'comment' => $request->get('comment'),
            'type' => $request->get('type'),
        ]);

        $status = $stock->save();

        if ($status) {
            return redirect()->route('rolling')->with('success', "Successfully Submitted!");
        } else {
            return redirect()->route('add_stock')->with('error', "Something went wrong.");
        }
    }

    public function delete($id) 
    {
        vehicle::where('id', $id)->delete();
        return redirect()->route('rolling');
    }
}
