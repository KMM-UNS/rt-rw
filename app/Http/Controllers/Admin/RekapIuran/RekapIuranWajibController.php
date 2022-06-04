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
        $nama_bulans = Bulan::pluck('nama', 'id');
        $tahun = Tahun::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiuranwajib.index', ['jenis_iuran' => $jenis_iuran, 'nama_bulans' => $nama_bulans, 'tahun' => $tahun]);
    }



    public function create(ActionDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.rekap-kas.rekapiuranwajib.detail');
    }


    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $total = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get()->sum('total_biaya');

        $rekap = KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();
        return view('pages.admin.rekap-kas.rekapiuranwajib.detail', ['rekap' => $rekap, 'total' => $total]);
    }

    // public function rekapiuranwajibexport()
    // {
    //     return Excel::download(new RekapIuranWajibView(), 'rekapiuranwajib.xlsx');
    // }

    public function export_rekapwajib(Request $request)
    {
        $title = 'Laporan Rekap Iuran Wajib';
        $jenis_iuran = $request->jenis_iuran_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $total = KasIuranWajib::where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get()->sum('total_biaya');

        $rekap = KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();

        Excel::create($title, function ($excel) use ($rekap, $total) {
            $excel->sheet('Sheetname', function ($sheet) use ($rekap, $total) {

                $sheet->view('pages.admin.rekap-kas.rekapiuranwajib.laporan_rekap_excel')->with('rekap', $rekap)->with('total', $total);
            });
        })->export('xls');
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
