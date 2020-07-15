<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\splitflap;
use Carbon\Carbon;

class SplitflapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getBoards']]);
    }

    public function getBoards() {
        $splitfflapsA = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+24 hours'))
            ->where('board','A')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        $splitfflapsB = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+24 hours'))
            ->where('board','B')
            ->orderBy('time', 'asc')
            ->take(1)->get();
        return [
            'A' => $splitfflapsA,
            'B' => $splitfflapsB
        ];
    }

    public function board_info(Request $request) {
        $splitfflaps = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+48 hours'))
            ->orderBy('time', 'asc')
            ->get();

        $splitfflapsA = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+24 hours'))
            ->where('board','A')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        $splitfflapsB = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse('+24 hours'))
            ->where('board','B')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        return view('reizigersinformatie/board-info',[
            'data' => $splitfflaps,
            'boardA' => $splitfflapsA,
            'boardB' => $splitfflapsB
        ]);
    }
    public function board_setup(){
        return view('reizigersinformatie/board-setup',['message' => 'hello world']);
    }
}
