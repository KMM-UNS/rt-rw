<?php

namespace App\Exports;

use App\Models\KasIuranWajib;
use Maatwebsite\Excel\Concerns\FromCollection;

class RekapIuranWajibExportView implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KasIuranWajib::all();
    }
}
