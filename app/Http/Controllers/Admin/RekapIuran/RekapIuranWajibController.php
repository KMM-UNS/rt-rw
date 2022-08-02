<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranWajib;
use App\Models\IuranWajib;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class RekapIuranWajibController extends Controller
{
    public function index()
    {
        $jenis_iuran = IuranWajib::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiuranwajib.index', ['jenis_iuran' => $jenis_iuran]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $start = Carbon::parse($request->tglawal);
        $end = Carbon::parse($request->tglakhir);
        $total = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran)
            ->whereDate('tanggal', '<=', $end)
            ->whereDate('tanggal', '>=', $start)
            ->get()->sum('total_biaya');
        $cetakrekapwajib = KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'warga_wajib')->where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '<=', $end)
            ->whereDate('tanggal', '>=', $start)->get();
        // $totall = 0 + $total;
        return view('pages.admin.rekap-kas.rekapiuranwajib.detail', ['cetakrekapwajib' => $cetakrekapwajib, 'total' => $total, 'jenis_iuran' => $jenis_iuran, 'tglawal' => $start, 'tglakhir' => $end]);
    }

    public function cetak_pdf($jenis_iuran, $start, $end)
    {
        $jenis_iuran_id = $jenis_iuran;
        $tglawal = $start;
        $tglakhir = $end;

        $total = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->get()
            ->sum('total_biaya');
        $data = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->get();
        $dataa = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->first();
        $pdf = PDF::loadview('pages.admin.rekap-kas.rekapiuranwajib.cetak_wajib', ['data' => $data, 'dataa' => $dataa, 'total' => $total, 'jenis_iuran_id' => $jenis_iuran_id, 'tglawal' => $tglawal, 'tglakhir' => $tglakhir]);
        return $pdf->download('laporan-rekapwajib.pdf');
    }



    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
