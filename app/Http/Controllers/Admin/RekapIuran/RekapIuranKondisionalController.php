<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranKondisional;
use App\Models\IuranKondisional;
use App\Models\Tahun;
use App\Models\Bulan;
use App\Models\IuranBulanan;
use App\Datatables\Admin\RekapIuran\RekapIuranKondisionalDataTable;

class RekapIuranKondisionalController extends Controller
{
    public function index()
    {
        $jenis_iuran = IuranKondisional::pluck('nama', 'id');
        $nama_bulans = Bulan::pluck('nama', 'id');
        $tahun = Tahun::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiurankondisional.index', ['jenis_iuran' => $jenis_iuran, 'nama_bulans' => $nama_bulans, 'tahun' => $tahun]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // $rekap = KasIuranKondisional::with('iurankondisional', 'rekapiurankondisional', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('tahun', $tahun)->get();
        $rekap = KasIuranKondisional::with('iurankondisional', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();
        return view('pages.admin.rekap-kas.rekapiurankondisional.detail', ['rekap' => $rekap]);
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
