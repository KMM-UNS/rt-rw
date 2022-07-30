<?php

namespace App\Http\Controllers\Admin;

use App\Models\App;
use App\Models\Rumah;
use App\Models\Surat;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\JadwalRonda;
use Illuminate\Http\Request;
use App\Models\GolonganDarah;
use App\Charts\Admin\SuratChart;
use App\Charts\Admin\GenderChart;
use App\Charts\Admin\PekerjaanChart;
use App\Http\Controllers\Controller;
use App\Charts\Admin\PendidikanChart;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GenderChart $genderChart, PendidikanChart $pendidikanChart, PekerjaanChart $pekerjaanChart, SuratChart $suratChart)
    {
        $minggu = JadwalRonda::whereHas('ronda', function ($query){
            return $query->where('status', 'aktif');
        })->with(['warga'])->where('hari_id', '1')->get();
        $senin = JadwalRonda::whereHas('ronda', function ($query){
            return $query->where('status', 'aktif');
        })->with(['warga'])->where('hari_id', '2')->get();
        $selasa = JadwalRonda::whereHas('ronda', function ($query){
            return $query->where('status', 'aktif');
        })->with(['warga'])->where('hari_id', '3')->get();
        $rabu = JadwalRonda::whereHas('ronda', function ($query){
            return $query->where('status', 'aktif');
        })->with(['warga'])->where('hari_id', '4')->get();
        $kamis = JadwalRonda::whereHas('ronda', function ($query){
            return $query->where('status', 'aktif');
        })->with(['warga'])->where('hari_id', '5')->get();
        $jumat = JadwalRonda::whereHas('ronda', function ($query){
            return $query->where('status', 'aktif');
        })->with(['warga'])->where('hari_id', '6')->get();
        $sabtu = JadwalRonda::whereHas('ronda', function ($query){
            return $query->where('status', 'aktif');
        })->with(['warga'])->where('hari_id', '7')->get();
        // dd($jadwal);
        $app = App::first();
        $warga = Warga::count();
        $keluarga = Keluarga::count();
        $surat = Surat::where('status_surat_id', '!=', '1')->count();
        $rumah = Rumah::count();
        return view('pages.admin.dashboard', [
            'minggu' => $minggu,
            'senin' => $senin,
            'selasa' => $selasa,
            'rabu' => $rabu,
            'kamis' => $kamis,
            'jumat' => $jumat,
            'sabtu' => $sabtu,
            'app' => $app,
            'warga' => $warga,
            'keluarga' => $keluarga,
            'surat' => $surat,
            'rumah' => $rumah,
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
