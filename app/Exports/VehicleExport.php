<?php

namespace App\Exports;

use App\Vehicle;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class VehicleExport implements ShouldAutoSize, FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('excel_exports.vehicles', [
            'vehicles' => Vehicle::with('vehicle_comment.User')->get()
        ]);
    }
}
