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

    public function create()
    {
        $minggu = JadwalRonda::with('warga:id,nama')->where('hari_id', 1)->get()->pluck('warga.nama', 'id');
        $senin = JadwalRonda::with('warga:id,nama')->where('hari_id', 2)->get()->pluck('warga.nama', 'id');
        $selasa = JadwalRonda::with('warga:id,nama')->where('hari_id', 3)->get()->pluck('warga.nama', 'id');
        $rabu = JadwalRonda::with('warga:id,nama')->where('hari_id', 4)->get()->pluck('warga.nama', 'id');
        $kamis = JadwalRonda::with('warga:id,nama')->where('hari_id', 5)->get()->pluck('warga.nama', 'id');
        $jumat = JadwalRonda::with('warga:id,nama')->where('hari_id', 6)->get()->pluck('warga.nama', 'id');
        $sabtu = JadwalRonda::with('warga:id,nama')->where('hari_id', 7)->get()->pluck('warga.nama', 'id');
        $hari = Hari::pluck('nama', 'id');
        return view('pages.admin.ronda.presensi.add-edit', [
            'minggu' => $minggu,
            'senin' => $senin,
            'selasa' => $selasa,
            'rabu' => $rabu,
            'kamis' => $kamis,
            'jumat' => $jumat,
            'sabtu' => $sabtu,
            'hari' => $hari,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            try {
            // dd($request->all());

                $presensi_ronda = PresensiRonda::createFromRequest($request);
                $presensi_ronda->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.ronda.presensi.index'))->withInput()->withToastSuccess('Data tersimpan');
    }
}
