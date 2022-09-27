<?php

namespace App\Http\Controllers\Admin\KasRT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bulan;
use App\Models\Tahun;
use App\Models\IuranBulanan;
use App\Datatables\Admin\KasRT\KasIuranWajibDataTable;
use App\Models\KasIuranWajib;

class IuranBulananController extends Controller
{
    public function index()
    {
        // $nama_bulans = Bulan::pluck('nama', 'id');
        // $tahuns = Tahu::pluck('nama', 'id');
        // return view('pages.admin.kas-rt.iuranbulanan.index', ['nama_bulans' => $nama_bulans, 'tahuns' => $tahuns]);
    }

    // function detail(KasIuranWajibDataTable $dataTable)
    // {
    // }

    public function create()
    {
        // $nama_bulans = Bulan::pluck('nama', 'id');
        // $tahuns = Tahun::pluck('nama', 'id');
        // return view('pages.admin.kas-rt.iuranbulanan.index', ['nama_bulans' => $nama_bulans, 'tahuns' => $tahuns]);
    }

    public function store(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $kas = KasIuranWajib::with('iuranwajib', 'petugastagihan', 'namabulanss', 'tahuns')->where('bulan', $bulan)->where('tahun', $tahun)->get();
        return view('pages.admin.kas-rt.iuranbulanan.detail', ['kas' => $kas]);
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
