<?php

namespace App\Exports;

use App\Renta;
use Maatwebsite\Excel\Concerns\FromCollection;

class RentaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Renta::all();
    }
}
