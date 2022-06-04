<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Datatables\Admin\RekapIuran\ActionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranAgenda;
use App\Models\IuranAgenda;
use App\Models\Tahun;
use App\Models\Bulan;

class RekapIuranAgendaController extends Controller
{
    public function index()
    {
        $jenis_iuran = IuranAgenda::pluck('nama', 'id');
        $nama_bulans = Bulan::pluck('nama', 'id');
        $tahun = Tahun::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiuranagenda.index', ['jenis_iuran' => $jenis_iuran, 'nama_bulans' => $nama_bulans, 'tahun' => $tahun]);
    }

    // public function coba(ActionDataTable $dataTable)
    // {
    //     return $dataTable->render('pages.admin.kas-rt.kasiuranwajib.detail');
    // }


    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $total = KasIuranAgenda::where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get()->sum('total_biaya');

        $rekap = KasIuranAgenda::with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();
        return view('pages.admin.rekap-kas.rekapiuranagenda.detail', ['rekap' => $rekap, 'total' => $total]);
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
