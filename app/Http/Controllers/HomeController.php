<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\splitflap;
use Carbon\Carbon;

class HomeController extends Controller
{
    // adds middleware auth so users who arent logged in cant access these methods
    public function __construct()
    {
        $this->middleware('auth' , ['except' => ['home','trainmap']]);
    }

    public function trainmap()
    {
        return view('trainmap');
    }

    // fetches data from database and returns to view
    public function home()
    {
        // get data from database
        $splitflaps = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+24 hours'))
            ->orderBy('time', 'asc')
            ->take(7)->get();

        $splitflapsA = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+24 hours'))
            ->where('board','A')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        $splitflapsB = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+24 hours'))
            ->where('board','B')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        // go to the home view with the data
        return view('home', [
            'data' => $splitflaps,
            'boardA' => $splitflapsA,
            'boardB' => $splitflapsB,
        ]);
    }

}
