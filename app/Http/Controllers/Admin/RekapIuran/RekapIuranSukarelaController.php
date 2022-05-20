<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bulan;
use App\Models\Tahun;
use App\Models\IuranBulanan;
use App\Datatables\Admin\KasRT\KasIuranSukaRelaDataTable;
use App\Models\KasIuranSukaRela;

class RekapIuranSukarelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nama_bulans = Bulan::pluck('nama', 'id');
        $tahuns = Tahun::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiuransukarela.index', ['nama_bulans' => $nama_bulans, 'tahuns' => $tahuns]);
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
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $kas = KasIuranSukaRela::with('iuransukarela', 'petugastagihan', 'namabulanss', 'tahuns')->where('bulan', $bulan)->where('tahun', $tahun)->get();
        return view('pages.admin.rekap-kas.rekapiuransukarela.detail', ['kas' => $kas]);
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
