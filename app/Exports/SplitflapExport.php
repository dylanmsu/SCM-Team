<?php

namespace App\Exports;

use App\Splitflap;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class SplitflapExport implements ShouldAutoSize, FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('excel_exports.splitflaps', [
            'splitflaps' => Splitflap::whereRaw('time >= now()')->orderBy('time', 'asc')->with('User')->get()
        ]);
    }
}
