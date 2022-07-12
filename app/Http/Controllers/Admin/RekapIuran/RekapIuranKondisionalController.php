<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranKondisional;
use App\Models\IuranKondisional;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        // $total = KasIuranAgenda::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
        $total = KasIuranKondisional::where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '>=', $tglawal)->whereDate('tanggal', '<=', $tglakhir)->orderBy('tanggal')->sum('total_biaya');
        $cetakrekapkondisional = KasIuranKondisional::with('iurankondisional', 'jenisiurankondisional', 'petugastagihan', 'warga_kondisional')->where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '>=', '$tglawal')->whereDate('tanggal', '<=', $tglakhir)->orderBy('tanggal')->get();
        // $totall = 0 + $total;
        return view('pages.admin.rekap-kas.rekapiurankondisional.detail', ['cetakrekapkondisional' => $cetakrekapkondisional, 'total' => $total]);
    }

    public function cetak_pdf(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;

        $total = KasIuranKondisional::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
        $cetakrekapkondisional = KasIuranKondisional::with('iurankondisional', 'jenisiurankondisional', 'petugastagihan', 'warga_kondisional')->where('jenis_iuran_id', $jenis_iuran)->whereBetween('tanggal', [$tglawal, $tglakhir])->get();
        $pdf = PDF::loadView('pages.admin.rekap-kas.rekapiurankondisional.cetak', ['cetakrekapkondisional' => $cetakrekapkondisional, 'total' => $total]);
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
