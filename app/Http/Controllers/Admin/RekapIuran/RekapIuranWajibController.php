<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranWajib;
use App\Models\IuranWajib;
use App\Models\Tahun;
use App\Models\Bulan;
use App\Exports\RekapIuranWajibView;
// use Maatwebsite\Excel\Facades\Excel;
use App\Models\IuranBulanan;
use App\Datatables\Admin\RekapIuran\RekapIuranWajibDataTable;
use App\Datatables\Admin\RekapIuran\ActionDataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
// use Excel;
use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Excel;

class RekapIuranWajibController extends Controller
{
    public function index()
    {
        $jenis_iuran = IuranWajib::pluck('nama', 'id');

        return view('pages.admin.rekap-kas.rekapiuranwajib.index', ['jenis_iuran' => $jenis_iuran]);
    }



    public function create(ActionDataTable $dataTable)
    {
        // return $dataTable->render('pages.admin.rekap-kas.rekapiuranwajib.detail');
    }


    // public function store(Request $request)
    // {
    //     $jenis_iuran = $request->jenis_iuran_id;
    //     $tglawal = $request->tglawal;
    //     $tglakhir = $request->tglakhir;

    //     $total = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');

    //     $cetakrekapwajib = KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'warga_wajib')->where('jenis_iuran_id', $jenis_iuran)->whereBetween('tanggal', [$tglawal, $tglakhir])->get();
    //     return view('pages.admin.rekap-kas.rekapiuranwajib.detail', ['cetakrekapwajib' => $cetakrekapwajib, 'total' => $total]);
    // }

    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        // $total = KasIuranAgenda::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
        $total = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '>=', $tglawal)->whereDate('tanggal', '<=', $tglakhir)->orderBy('tanggal')->sum('total_biaya');
        $cetakrekapwajib = KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'warga_wajib')->where('jenis_iuran_id', $jenis_iuran)->whereDate('tanggal', '>=', '$tglawal')->whereDate('tanggal', '<=', $tglakhir)->orderBy('tanggal')->get();
        // $totall = 0 + $total;
        return view('pages.admin.rekap-kas.rekapiuranwajib.detail', ['cetakrekapwajib' => $cetakrekapwajib, 'total' => $total, 'jenis_iuran' => $jenis_iuran, 'tglawal' => $tglawal, 'tglakhir' => $tglakhir]);
    }



    public function cetak_pdf(Request $request)
    {
        // dd($request->all());
        $jenis_iuran = $request->jenis_iuran_id;
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;

        $total = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
        $cetakrekapwajib = KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'warga_wajib')->where('jenis_iuran_id', $jenis_iuran)->whereBetween('tanggal', [$tglawal, $tglakhir])->get();
        $pdf = PDF::loadview('pages.admin.rekap-kas.rekapiuranwajib.cetak_wajib', ['cetakrekapwajib' => $cetakrekapwajib, 'total' => $total]);
        return $pdf->download('laporan-rekapwajib.pdf');
    }

    // public function rekapiuranwajibexport()
    // {
    //     return Excel::download(new RekapIuranWajibView(), 'rekapiuranwajib.xlsx');
    // }

    // public function export_rekapwajib(Request $request)
    // {
    //     $title = 'Laporan Rekap Iuran Wajib';
    //     $jenis_iuran = $request->jenis_iuran_id;
    //     $bulan = $request->bulan;
    //     $tahun = $request->tahun;

    //     $total = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get()->sum('total_biaya');

    //     $rekap = KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();

    //     Excel::create($title, function ($excel) use ($rekap, $total) {
    //         $excel->sheet('Sheetname', function ($sheet) use ($rekap, $total) {

    //             $sheet->view('pages.admin.rekap-kas.rekapiuranwajib.laporan_rekap_excel')->with('rekap', $rekap)->with('total', $total);
    //         });
    //     })->export('xls');
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
}
