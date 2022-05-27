<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranSukaRela;
use App\Models\IuranSukaRela;
use App\Models\Bulan;
use App\Models\Tahun;
use App\Models\IuranBulanan;
use App\Datatables\Admin\KasRT\KasIuranSukaRelaDataTable;
use App\Models\KasIuranWajib;

class RekapIuranSukarelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_iuran = IuranSukaRela::pluck('nama', 'id');
        $nama_bulans = Bulan::pluck('nama', 'id');
        $tahun = Tahun::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiuransukarela.index', ['jenis_iuran' => $jenis_iuran, 'nama_bulans' => $nama_bulans, 'tahun' => $tahun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $total = KasIuranSukarela::where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get()->sum('total_biaya');

        $rekap = KasIuranSukaRela::with('iuransukarela', 'jenisiuransukarela', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();
        return view('pages.admin.rekap-kas.rekapiuransukarela.detail', ['rekap' => $rekap, 'total' => $total]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
