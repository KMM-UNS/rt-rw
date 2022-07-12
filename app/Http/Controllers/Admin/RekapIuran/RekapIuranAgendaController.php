<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranAgenda;
use App\Models\IuranAgenda;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapIuranAgendaController extends Controller
{
    public function index()
    {
        $jenis_iuran = IuranAgenda::pluck('nama', 'id');
        // $nama_bulans = Bulan::pluck('nama', 'id');
        // $tahun = Tahun::pluck('nama', 'id');

        // return view('pages.admin.rekap-kas.rekapiuranagenda.index', ['jenis_iuran' => $jenis_iuran, 'nama_bulans' => $nama_bulans, 'tahun' => $tahun]);
        return view('pages.admin.rekap-kas.rekapiuranagenda.index', ['jenis_iuran' => $jenis_iuran]);
    }

    // public function coba(ActionDataTable $dataTable)
    // {
    //     return $dataTable->render('pages.admin.kas-rt.kasiuranwajib.detail');
    // }


    // public function store(Request $request)
    // {
    //     $jenis_iuran = $request->jenis_iuran_id;
    //     $tglawal = $request->tglawal;
    //     $tglakhir = $request->tglakhir;
    //     $total = KasIuranAgenda::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
    //     $cetakrekapagenda = KasIuranAgenda::with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'warga_agenda')->where('jenis_iuran_id', $jenis_iuran)->whereBetween('tanggal', [$tglawal, $tglakhir])->get();

    //     return view('pages.admin.rekap-kas.rekapiuranagenda.detaill', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total]);
    // }

    // public function store(Request $request)
    // {
    //     $jenis_iuran = $request->jenis_iuran_id;
    //     $tglawal = $request->tglawal;
    //     $tglakhir = $request->tglakhir;
    //     // $total = KasIuranAgenda::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
    //     $total = KasIuranAgenda::whereDate('tanggal', '>=', $tglawal)->whereDate('tanggal', '<=', $tglakhir)->orderBy('tanggal', 'desc')->where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
    //     $cetakrekapagenda = KasIuranAgenda::whereDate('tanggal', '>=', '$tglawal')->whereDate('tanggal', '<=', $tglakhir)->where('jenis_iuran_id', $jenis_iuran)->orderBy('tanggal', 'desc')->with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'warga_agenda')->get();
    //     // $totall = 0 + $total;
    //     return view('pages.admin.rekap-kas.rekapiuranagenda.detaill', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total]);
    // }

    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;

        $total = KasIuranAgenda::whereDate('created_at', '>=', $tglawal)->whereDate('created_at', '<=', $tglakhir)->orderBy('created_at', 'desc')->where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
        $cetakrekapagenda = KasIuranAgenda::whereDate('created_at', '>=', $tglawal)->whereDate('created_at', '<=', $tglakhir)->orderBy('created_at', 'desc')->where('jenis_iuran_id', $jenis_iuran)->with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'warga_agenda')->get();
        return view('pages.admin.rekap-kas.rekapiuranagenda.detaill', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total]);
    }

    public function cetak_pdf(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;

        $total = KasIuranAgenda::whereDate('created_at', '>=', $tglawal)->whereDate('created_at', '<=', $tglakhir)->orderBy('created_at', 'desc')->where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
        $cetakrekapagenda = KasIuranAgenda::whereDate('created_at', '>=', $tglawal)->whereDate('created_at', '<=', $tglakhir)->orderBy('created_at', 'desc')->where('jenis_iuran_id', $jenis_iuran)->with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'warga_agenda')->get();

        $pdf = PDF::loadView('pages.admin.rekap-kas.rekapiuranagenda.cetak', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total]);
        return $pdf->download('laporan-rekapagenda.pdf');
    }


    // $jenis_iuran = $request->jenis_iuran_id;
    // $tglawal = $request->tglawal;
    // $tglakhir = $request->tglakhir;

    // $total = KasIuranAgenda::sum('total_biaya');
    // $cetakrekapagenda = KasIuranAgenda::with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'warga_agenda')->where('jenis_iuran_id', $jenis_iuran)->whereBetween('tanggal', [$tglawal, $tglakhir])->get();
    // $pdf = PDF::loadView('pages.admin.rekap-kas.rekapiuranagenda.cetak', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total]);
    // return $pdf->download('laporan-rekapagenda.pdf');


    // $total = KasIuranAgenda::whereDate('created_at', '>=', $tglawal)->whereDate('created_at', '<=', $tglakhir)->orderBy('created_at', 'desc')->where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
    // $cetakrekapagenda = KasIuranAgenda::whereDate('created_at', '>=', $tglawal)->whereDate('created_at', '<=', $tglakhir)->orderBy('created_at', 'desc')->where('jenis_iuran_id', $jenis_iuran)->with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'warga_agenda')->get();
    // // $totall = 0 + $total;
    // $pdf = PDF::loadView('pages.admin.rekap-kas.rekapiuranagenda.cetak', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total]);
    // return $pdf->download('laporan-rekapagenda.pdf');

    // $agenda = KasIuranWajib::all();
    // $total = KasIuranAgenda::sum('total_biaya');
    // $cetakrekapagenda = KasIuranAgenda::with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'warga_agenda')->get();
    // $pdf = PDF::loadView('pages.admin.rekap-kas.rekapiuranagenda.cetak', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total], compact('cetakrekapagenda'));
    // return $pdf->download('laporan-pengeluaran.pdf');

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
