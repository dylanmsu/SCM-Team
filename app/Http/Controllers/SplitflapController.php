<?php

namespace App\Http\Controllers;

use Auth;
use App\splitflap;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        // get splitflapdata within now and 48 hours
        $splitfflaps = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->orderBy('time', 'asc')->paginate(10);

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

        return view('reizigersInformatie/board-info',[
            'count' => splitflap::selectRaw('count(*) as count')->get(),
            'data' => $splitfflaps,
            'boardA' => $splitfflapsA,
            'boardB' => $splitfflapsB
        ]);
    }

    public function board_setup(){
        return view('reizigersInformatie/board-setup');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'board' => 'required',
            'time' => 'required',
            'align' => 'required',
            'icon_index' => 'required'
        ]);
        
        $splitflap = new splitflap([
            'board' => $request->get('board'),
            'align' => $request->get('align'),
            'first_text' => $request->get('first_text'),
            'second_text' => $request->get('second_text'),
            'icon_index' => $request->get('icon_index'),
            'time' => $request->get('time'),
            'creator' => Auth::user()->id
        ]);
        
        $status = $splitflap->save();

        if ($status) {
            return redirect()->route('board-setup')->with('success', "Successfully Submitted!");
        } else {
            return redirect()->route('board-setup')->with('error', "Something went wrong.");
        }
    }

    public function reizigersinformatie()
    {
        $splitfflaps = splitflap::
        select('*')
        ->whereRaw('time >= now()')
        ->orderBy('time', 'asc')->paginate(10)->onEachSide(1);;

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

        return view('reizigersInformatie/reizigersinformatie', [
            'count' => splitflap::selectRaw('count(*) as count')->get(),
            'data' => $splitfflaps,
            'boardA' => $splitfflapsA,
            'boardB' => $splitfflapsB
        ]);
    }

    public function preview(Request $request) {
        $prev = [
            'board' => $request->get('board'),
            'align' => $request->get('align'),
            'first_text' => $request->get('first_text'),
            'second_text' => $request->get('second_text'),
            'icon_index' => $request->get('icon_index'),
            'time' => $request->get('time')
        ];
        return view('reizigersInformatie/board-setup',[
            'preview' => json_encode($prev),
            'board' => $request->get('board'),
            'align' => $request->get('align'),
            'first_text' => $request->get('first_text'),
            'second_text' => $request->get('second_text'),
            'icon_index' => $request->get('icon_index'),
            'time' => $request->get('time')
         ]);
    }
}
