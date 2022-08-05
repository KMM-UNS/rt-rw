<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hari;
use App\Models\Warga;
use Illuminate\Http\Request;
use App\Models\PresensiRonda;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\PresensiRondaDataTable;
use App\Models\JadwalRonda;

class PresensiRondaController extends Controller
{
    function __construct()
    {
    $this->middleware('role:admin')->except(['index']);
    }

    public function index(PresensiRondaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.ronda.presensi.index');
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $hari = Hari::pluck('nama', 'id');
        if($request->has('hari')) {
            $hari_id = $request->get("hari");
            $jadwal_ronda = JadwalRonda::whereHas('ronda', function ($query){
                return $query->where('status', 'aktif');
            })->whereHas('warga', function ($query){
                return $query->where('status_warga_id', 1);
            })->where('hari_id', $hari_id )->get();
            // dd($jadwal_ronda);
        } else {
            $jadwal_ronda = null;
        }
        return view('pages.admin.ronda.presensi.add-edit', [
            'jadwal_ronda' => $jadwal_ronda,
            'hari' => $hari,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            try {
            // dd($request->all());
                foreach($request->presensi_ronda_jadwal_ronda_id as $key => $jadwal) {
                    // dd($key);
                    if($request->presensi_ronda_kehadiran != null && array_key_exists($key, $request->presensi_ronda_kehadiran) ) {
                        $kehadiran = $request->presensi_ronda_kehadiran[$key];
                    }
                    else {
                        $kehadiran = 'tidak hadir';
                    }
                    $presensi_ronda = PresensiRonda::createFromRequest($request);
                    $presensi_ronda->jadwal_ronda_id = $jadwal;
                    $presensi_ronda->kehadiran = $kehadiran;
                    $presensi_ronda->save();
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.ronda.presensi.index'))->withInput()->withToastSuccess('Data tersimpan');
    }
}
