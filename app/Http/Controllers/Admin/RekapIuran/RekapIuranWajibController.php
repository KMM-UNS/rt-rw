<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranWajib;
use App\Models\IuranWajib;
use App\Models\Tahun;
use App\Models\Bulan;
use App\Models\IuranBulanan;
use App\Datatables\Admin\RekapIuran\RekapIuranWajibDataTable;

class RekapIuranWajibController extends Controller
{
    public function index()
    {
        $jenis_iuran = IuranWajib::pluck('nama', 'id');
        $nama_bulans = Bulan::pluck('nama', 'id');
        $tahun = Tahun::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiuranwajib.index', ['jenis_iuran' => $jenis_iuran, 'nama_bulans' => $nama_bulans, 'tahun' => $tahun]);
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

        // $rekap = KasIuranWajib::with('iuranwajib', 'rekapiuranwajib', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('tahun', $tahun)->get();
        $rekap = KasIuranWajib::with('iuranwajib', 'jenisiuranwajib', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();
        return view('pages.admin.rekap-kas.rekapiuranwajib.detail', ['rekap' => $rekap]);
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
