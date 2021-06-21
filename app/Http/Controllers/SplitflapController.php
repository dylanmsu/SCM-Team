<?php

namespace App\Http\Controllers;

use Auth;
use App\splitflap;
use App\boardData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\VehicleExport;
use App\Exports\SplitflapExport;
use Maatwebsite\Excel\Facades\Excel;

class SplitflapController extends Controller
{
    // display trains on the splitflap boards that are within now and 24h
    private $interval;
    
    // adds middleware auth so users who arent logged in cant access these methods
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getBoards']]);

        // the splitflaps will be shown 24h before the train leaves.
        $this->interval = '+24 hours';
    }

    // export to excel
    public function export() 
    {
        return Excel::download(new SplitflapExport, 'Splitflaps.xlsx');
    }

    
    public function getBoards(Request $request) {

        // get board data from database
        $boardData = new BoardData([
            'board' => $request->get('board'), 
            'temperature' => $request->get('temperature'),
            'humidity' => $request->get('humidity'),
            'lightLevel' => $request->get('lightLevel')
        ]);
        $boardData->save();

        // delete all sensor values older than 1 day
        BoardData::where('created_at', '<=', Carbon::now()->subDays(1)->toDateTimeString())->delete();

        // delete all trains older than now
        //splitflap::where('created_at', '<=', Carbon::now()->toDateTimeString())->delete();

        if ($request->get('lightLevel') <= 750) {
            $whiteLed = 128;
        } else {
            $whiteLed = 0;
        }

        $splitfflapsA = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse($this->interval))
            ->where('board','A')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        $splitfflapsB = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse($this->interval))
            ->where('board','B')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        if ($splitfflapsA == '[]') {
            $json[0] = array(
                'board' => "A",
                "align" => "center",
                "first_text" => " ",
                "second_text" => " ",
                "icon_index" => 10,
                "time" => "2020-10-15 00:00:00",
                "white_led" => 0
            );

            $splitfflapsA = json_decode(json_encode($json), false);
        }
        
        if ($splitfflapsB == '[]') {
            $json[0] = array(
                'board' => "B",
                "align" => "center",
                "first_text" => " ",
                "second_text" => " ",
                "icon_index" => 10,
                "time" => "2020-10-15 00:00:00",
                "white_led" => 0
            );

            $splitfflapsB = json_decode(json_encode($json), false);
        }
        
            
        return [
            'A' => [
                'first_text' => $splitfflapsA[0]->first_text,
                'second_text' => $splitfflapsA[0]->second_text,
                'icon_index' => $splitfflapsA[0]->icon_index,
                'hours' => Carbon::createFromFormat('Y-m-d H:i:s', $splitfflapsA[0]->time)->hour,
                'minutes' => Carbon::createFromFormat('Y-m-d H:i:s', $splitfflapsA[0]->time)->minute,
                'date' => $splitfflapsA[0]->time,
                'align' => $splitfflapsA[0]->align,
                'white_led' => $whiteLed,
                'rgb_strip' => ['color' => '#FF00FF', 'mode' => 1]

            ],
            'B' => [
                'first_text' => $splitfflapsB[0]->first_text,
                'second_text' => $splitfflapsB[0]->second_text,
                'icon_index' => $splitfflapsB[0]->icon_index,
                'hours' => Carbon::createFromFormat('Y-m-d H:i:s', $splitfflapsB[0]->time)->hour,
                'minutes' => Carbon::createFromFormat('Y-m-d H:i:s', $splitfflapsB[0]->time)->minute,
                'date' => $splitfflapsB[0]->time,
                'align' => $splitfflapsB[0]->align,
                'white_led' => $whiteLed,
                'rgb_strip' => ['color' => '#FF00FF', 'mode' => 1]
            ]
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
            ->where('time', '<', Carbon::parse($this->interval))
            ->where('board','A')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        $splitfflapsB = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse($this->interval))
            ->where('board','B')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        return view('splitflaps/board-info',[
            'count' => splitflap::selectRaw('count(*) as count')->get(),
            'data' => $splitfflaps,
            'boardA' => $splitfflapsA,
            'boardB' => $splitfflapsB
        ]);
    }

    public function board_setup(){
        return view('splitflaps/board-setup',[
            'action' => 'edit',
            'data' => '[]'
        ]);
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
            return redirect()->route('splitflaps')->with('success', "Successfully Submitted!");
        } else {
            return redirect()->route('splitflaps')->with('error', "Something went wrong.");
        }
    }

    public function update($id, Request $request) {

        $this->validate($request, [
            'board' => 'required',
            'time' => 'required',
            'align' => 'required',
            'icon_index' => 'required'
        ]);

        $splitfflap = splitflap::find($id);

        $splitfflap->board = $request->get('board');
        $splitfflap->align = $request->get('align');
        $splitfflap->first_text = $request->get('first_text');
        $splitfflap->second_text = $request->get('second_text');
        $splitfflap->icon_index = $request->get('icon_index');
        $splitfflap->time = $request->get('time');
        $splitfflap->creator = Auth::user()->id;

        $status = $splitfflap->save();

        if ($status) {
            return redirect()->route('splitflaps')->with('success', "Successfully Submitted!");
        } else {
            return redirect()->route('splitflaps')->with('error', "Something went wrong.");
        }
    }

    public function splitflaps($id = null)
    {
        $perPage = 10;

        $splitfflaps = splitflap::
        select('*')
        ->whereRaw('time >= now()')
        ->orderBy('time', 'asc')->paginate($perPage)->onEachSide(1);;

        $splitfflapsA = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse($this->interval))
            ->where('board','A')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        $splitfflapsB = splitflap::
            select('*')
            ->whereRaw('time >= now()')
            ->where('time', '<', Carbon::parse($this->interval))
            ->where('board','B')
            ->orderBy('time', 'asc')
            ->take(1)->get();

        $tempA = boardData::select('created_at as x','temperature as y')->where('board', 'A')->orderBy('created_at','DESC')->get();
        $humidA = boardData::select('created_at as x','humidity as y')->where('board', 'A')->orderBy('created_at','DESC')->get();
        $tempB = boardData::select('created_at as x','temperature as y')->where('board', 'B')->orderBy('created_at','DESC')->get();
        $humidB = boardData::select('created_at as x','humidity as y')->where('board', 'B')->orderBy('created_at','DESC')->get();

        return view('splitflaps/splitflaps', [
            'count' => splitflap::selectRaw('count(*) as count')->get(),
            'data' => $splitfflaps,
            'boardA' => $splitfflapsA,
            'boardB' => $splitfflapsB,
            'tempA' => $tempA,
            'humidA' => $humidA,
            'tempB' => $tempB,
            'humidB' => $humidB,
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
        return view('splitflaps/board-setup',[
            'preview' => json_encode($prev),
            'board' => $request->get('board'),
            'align' => $request->get('align'),
            'first_text' => $request->get('first_text'),
            'second_text' => $request->get('second_text'),
            'icon_index' => $request->get('icon_index'),
            'time' => $request->get('time')
         ]);
    }

    public function delete($id) 
    {
        splitflap::where('id', $id)->delete();

        return redirect()->route('splitflaps');
    }

    // return vehicle edit page
    public function show_edit($id)
    {
        return view('splitflaps/board-setup', [
            'data' => splitflap::find($id),
            'action' => 'edit'
        ]);
    }
}
