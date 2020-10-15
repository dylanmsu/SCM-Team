<?php

namespace App\Http\Controllers;

use Auth;
use App\splitflap;
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

        $this->interval = '+24 hours';
    }

    // export to excel
    public function export() 
    {
        return Excel::download(new SplitflapExport, 'Splitflaps.xlsx');
    }

    
    public function getBoards() {
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
            $splitfflapsA = [ 0 => [
                'first_text' => 'geen treinen',
                'second_text' => 'vandaag',
                'icon_index' => 0,
                'hours' => 0,
                'minutes' => 0,
                'align' => 'center'
            ]];
        }

        if ($splitfflapsB[0] == null && $splitfflapsA[0] !== null) {
            return [
                'A' => [
                    'first_text' => $splitfflapsA[0]->first_text,
                    'second_text' => $splitfflapsA[0]->second_text,
                    'icon_index' => $splitfflapsA[0]->icon_index,
                    'hours' => Carbon::createFromFormat('Y-m-d H:m:i', $splitfflapsA[0]->time ?? Carbon::now())->format('H'),
                    'minutes' => Carbon::createFromFormat('Y-m-d H:m:i', $splitfflapsA[0]->time ?? Carbon::now())->format('m'),
                    'date' => $splitfflapsA[0]->time,
                    'align' => $splitfflapsA[0]->align
                ],
                'B' => [
                    0 => 'null'
                ]
            ];
        }

        if ($splitfflapsA[0] == null && $splitfflapsB[0] !== null) {
            return [
                'A' => [
                    0 => 'null'
                ],
                'B' => [
                    'first_text' => $splitfflapsB[0]->first_text,
                    'second_text' => $splitfflapsB[0]->second_text,
                    'icon_index' => $splitfflapsB[0]->icon_index,
                    'hours' => Carbon::createFromFormat('Y-m-d H:m:i', $splitfflapsB[0]->time ?? Carbon::now())->format('H'),
                    'minutes' => Carbon::createFromFormat('Y-m-d H:m:i', $splitfflapsB[0]->time ?? Carbon::now())->format('m'),
                    'date' => $splitfflapsB[0]->time,
                    'align' => $splitfflapsB[0]->align
                ]
            ];
        }
        
        if ($splitfflapsA !== '[]' && $splitfflapsB !== '[]') {
            return [
                'A' => [
                    'first_text' => $splitfflapsA[0]->first_text,
                    'second_text' => $splitfflapsA[0]->second_text,
                    'icon_index' => $splitfflapsA[0]->icon_index,
                    'hours' => Carbon::createFromFormat('Y-m-d H:m:i', $splitfflapsA[0]->time ?? Carbon::now())->format('H'),
                    'minutes' => Carbon::createFromFormat('Y-m-d H:m:i', $splitfflapsA[0]->time ?? Carbon::now())->format('m'),
                    'date' => $splitfflapsA[0]->time,
                    'align' => $splitfflapsA[0]->align
                ],
                'B' => [
                    'first_text' => $splitfflapsB[0]->first_text,
                    'second_text' => $splitfflapsB[0]->second_text,
                    'icon_index' => $splitfflapsB[0]->icon_index,
                    'hours' => Carbon::createFromFormat('Y-m-d H:m:i', $splitfflapsB[0]->time ?? Carbon::now())->format('H'),
                    'minutes' => Carbon::createFromFormat('Y-m-d H:m:i', $splitfflapsB[0]->time ?? Carbon::now())->format('m'),
                    'date' => $splitfflapsB[0]->time,
                    'align' => $splitfflapsB[0]->align
                ]
            ];
        }
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
            return redirect()->route('ris')->with('success', "Successfully Submitted!");
        } else {
            return redirect()->route('ris')->with('error', "Something went wrong.");
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

    public function delete($id) 
    {
        splitflap::where('id', $id)->delete();

        return redirect()->route('ris');
    }

}
