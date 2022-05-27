<?php

namespace App\Exports;

use App\Models\KasIuranWajib;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapIuranWajibView implements FromView
{
    public function view(): View
    {
        return view('pages.admin.rekap-kas.rekapiuranwajib.table', [
            'rekap' => KasIuranWajib::all()
        ]);
    }
}
