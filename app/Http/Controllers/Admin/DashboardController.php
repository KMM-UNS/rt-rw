<?php

namespace App\Http\Controllers\Admin;

use App\Charts\Admin\GenderChart;
use App\Charts\Admin\PekerjaanChart;
use App\Charts\Admin\PendidikanChart;
use App\Charts\Admin\SuratChart;
use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\JadwalRonda;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GenderChart $genderChart, PendidikanChart $pendidikanChart, PekerjaanChart $pekerjaanChart, SuratChart $suratChart)
    {
        $minggu = JadwalRonda::with(['warga'])->where('hari_id', '1')->get();
        $senin = JadwalRonda::with(['warga'])->where('hari_id', '2')->get();
        $selasa = JadwalRonda::with(['warga'])->where('hari_id', '3')->get();
        $rabu = JadwalRonda::with(['warga'])->where('hari_id', '4')->get();
        $kamis = JadwalRonda::with(['warga'])->where('hari_id', '5')->get();
        $jumat = JadwalRonda::with(['warga'])->where('hari_id', '6')->get();
        $sabtu = JadwalRonda::with(['warga'])->where('hari_id', '7')->get();
        // dd($jadwal);
        $app = App::first();
        return view('pages.admin.dashboard', [
            'minggu' => $minggu,
            'senin' => $senin,
            'selasa' => $selasa,
            'rabu' => $rabu,
            'kamis' => $kamis,
            'jumat' => $jumat,
            'sabtu' => $sabtu,
            'app' => $app,
            'genderChart' => $genderChart->build(),
            'pendidikanChart' => $pendidikanChart->build(),
            'pekerjaanChart' => $pekerjaanChart->build(),
            'suratChart' => $suratChart->build()
        ]);
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
        //
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
