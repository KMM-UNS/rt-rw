<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranSukaRela;
use App\Models\IuranSukaRela;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class RekapIuranSukarelaController extends Controller
{

    public function index()
    {
        $jenis_iuran = IuranSukaRela::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiuransukarela.index', ['jenis_iuran' => $jenis_iuran]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $start = Carbon::parse($request->tglawal);
        $end = Carbon::parse($request->tglakhir);
        $total = KasIuranSukaRela::where('jenis_iuran_id', $jenis_iuran)
            ->whereDate('tanggal', '<=', $end)
            ->whereDate('tanggal', '>=', $start)
            ->get()->sum('total_biaya');
        $cetakrekapsukarela = KasIuranSukaRela::with('iuransukarela', 'jenisiuransukarela', 'petugastagihan', 'warga_sukarela')->where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '<=', $end)
            ->whereDate('tanggal', '>=', $start)->get();
        return view('pages.admin.rekap-kas.rekapiuransukarela.detail', ['cetakrekapsukarela' => $cetakrekapsukarela, 'total' => $total, 'jenis_iuran' => $jenis_iuran, 'tglawal' => $start, 'tglakhir' => $end]);
    }

    public function cetak_pdf($jenis_iuran, $start, $end)
    {
        $jenis_iuran_id = $jenis_iuran;
        $tglawal = $start;
        $tglakhir = $end;

        $total = KasIuranSukaRela::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->get()
            ->sum('total_biaya');
        $data = KasIuranSukaRela::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->get();
        $dataa = KasIuranSukaRela::where('jenis_iuran_id', $jenis_iuran_id)
            ->where('tanggal', '>=', $tglawal)
            ->where('tanggal', '<=', $tglakhir)->first();
        $pdf = PDF::loadview('pages.admin.rekap-kas.rekapiuransukarela.cetak_sukarela', ['data' => $data, 'dataa' => $dataa, 'total' => $total, 'jenis_iuran_id' => $jenis_iuran_id, 'tglawal' => $tglawal, 'tglakhir' => $tglakhir]);
        return $pdf->download('laporan-rekapsukarela.pdf');
    }


    // public function store(Request $request)
    // {
    //     $jenis_iuran = $request->jenis_iuran_id;
    //     $tglawal = $request->tglawal;
    //     $tglakhir = $request->tglakhir;
    //     // $total = KasIuranAgenda::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
    //     $total = KasIuranSukaRela::where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '>=', $tglawal)->whereDate('tanggal', '<=', $tglakhir)->orderBy('tanggal')->sum('total_biaya');
    //     $cetakrekapsukarela = KasIuranSukaRela::with('iuransukarela', 'jenisiuransukarela', 'petugastagihan', 'warga_sukarela')->where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '>=', '$tglawal')->whereDate('tanggal', '<=', $tglakhir)->orderBy('tanggal')->get();

    //     return view('pages.admin.rekap-kas.rekapiuransukarela.detail', ['cetakrekapsukarela' => $cetakrekapsukarela, 'total' => $total]);
    // }

    // public function cetak_pdf(Request $request)
    // {
    //     $jenis_iuran = $request->jenis_iuran_id;
    //     $tglawal = $request->tglawal;
    //     $tglakhir = $request->tglakhir;

    //     $total = KasIuranSukaRela::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
    //     $cetakrekapsukarela = KasIuranSukaRela::with('iuransukarela', 'jenisiuransukarela', 'petugastagihan', 'warga_sukarela')->where('jenis_iuran_id', $jenis_iuran)->whereBetween('tanggal', [$tglawal, $tglakhir])->get();
    //     $pdf = PDF::loadView('pages.admin.rekap-kas.rekapiuransukarela.cetak', ['cetakrekapsukarela' => $cetakrekapsukarela, 'total' => $total]);
    //     return $pdf->download('laporan-rekapsukarela.pdf');
    // }

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

    // public function laporankematian()
    // {
    //     $jenis_iuran = IuranSukaRela::pluck('nama', 'id');
    //     return view('pages.admin.rekap-kas.rekapiuransukarela.laporankematian', ['jenis_iuran' => $jenis_iuran]);
    // }
    // public function sortir(Request $request)
    // {

    //     $startDate = Str::before($request->tglawal, ' -');
    //     $endDate = Str::after($request->tglakhir, '- ');
    //     switch ($request->submit) {
    //         case 'table':

    //             $data = KasIuranSukaRela::all()
    //                 ->whereBetween('created_at', [$startDate, $endDate]);

    //             return view('pages.admin.rekap-kas.rekapiuransukarela.laporankematian', compact('data', 'startDate', 'endDate'));
    //             break;
    //     }
    // }
    // public function cetakLaporanKematian($start, $end)
    // {

    //     $startDate = $start;
    //     $endDate = $end;
    //     $data = KasIuranSukaRela::get()
    //         ->whereBetween('created_at', [$startDate, $endDate]);

    //     $pdf = PDF::loadview('pages.admin.rekap-kas.rekapiuransukarela.cetaklaporankematian', ['data' => $data]);
    //     return $pdf->download('Laporan Kematian Lansia.pdf');
    // }
}
