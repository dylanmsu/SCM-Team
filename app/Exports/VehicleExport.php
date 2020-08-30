<?php

namespace App\Exports;

use App\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehicleExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vehicle::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Categorie',
            'Naam',
            'Status',
            'Spoor',
            'Bijwerkt op',
            'Gemaakt op'
        ];
    }
}
