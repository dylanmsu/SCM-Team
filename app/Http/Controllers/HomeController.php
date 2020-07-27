<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\splitflap;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $splitflaps = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+24 hours'))
            ->orderBy('time', 'asc')
            ->get();

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

        return view('home', [
            'data' => $splitflaps,
            'boardA' => $splitflapsA,
            'boardB' => $splitflapsB
        ]);
    }

    public function reizigersinformatie()
    {
        return view('reizigersinformatie');
    }

}
