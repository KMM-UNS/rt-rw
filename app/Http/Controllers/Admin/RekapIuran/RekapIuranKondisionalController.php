<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranKondisional;
use App\Models\IuranKondisional;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class RekapIuranKondisionalController extends Controller
{
    public function index()
    {
        $jenis_iuran = IuranKondisional::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiurankondisional.index', ['jenis_iuran' => $jenis_iuran]);
    }

    public function create()
    {
        //
    }


    // public function store(Request $request)
    // {
    //     $jenis_iuran = $request->jenis_iuran_id;
    //     $tglawal = $request->tglawal;
    //     $tglakhir = $request->tglakhir;
    //     $total = KasIuranKondisional::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
    //     $cetakrekapkondisional = KasIuranKondisional::with('iurankondisional', 'jenisiurankondisional', 'petugastagihan', 'warga_kondisional')->where('jenis_iuran_id', $jenis_iuran)->whereBetween('tanggal', [$tglawal, $tglakhir])->get();
    //     return view('pages.admin.rekap-kas.rekapiurankondisional.detail',  ['cetakrekapkondisional' => $cetakrekapkondisional, 'total' => $total]);
    // }

    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $start = Carbon::parse($request->tglawal);
        $end = Carbon::parse($request->tglakhir);
        $total = KasIuranKondisional::where('jenis_iuran_id', $jenis_iuran)
            ->whereDate('tanggal', '<=', $end)
            ->whereDate('tanggal', '>=', $start)
            ->get()->sum('total_biaya');
        $cetakrekapkondisional = KasIuranKondisional::with('iurankondisional', 'jenisiurankondisional', 'petugastagihan', 'warga_kondisional')->where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '<=', $end)
            ->whereDate('tanggal', '>=', $start)->get();
        return view('pages.admin.rekap-kas.rekapiurankondisional.detail', ['cetakrekapkondisional' => $cetakrekapkondisional, 'total' => $total, 'jenis_iuran' => $jenis_iuran, 'tglawal' => $start, 'tglakhir' => $end]);
    }

    public function cetak_pdf($jenis_iuran, $start, $end)
    {
        $jenis_iuran_id = $jenis_iuran;
        $tglawal = $start;
        $tglakhir = $end;

        $total = KasIuranKondisional::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->get()
            ->sum('total_biaya');
        $data = KasIuranKondisional::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->get();
        $dataa = KasIuranKondisional::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->first();
        $pdf = PDF::loadview('pages.admin.rekap-kas.rekapiurankondisional.cetak_kondisional', ['data' => $data, 'dataa' => $dataa, 'total' => $total, 'jenis_iuran_id' => $jenis_iuran_id, 'tglawal' => $tglawal, 'tglakhir' => $tglakhir]);
        return $pdf->download('laporan-rekapkondisional.pdf');
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
