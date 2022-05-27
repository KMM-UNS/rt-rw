<?php

namespace App\Exports;

use App\Models\KasIuranWajib;
use Maatwebsite\Excel\Concerns\FromCollection;

class RekapIuranWajibExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return KasIuranWajib::all();
        return KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();
    }
}
