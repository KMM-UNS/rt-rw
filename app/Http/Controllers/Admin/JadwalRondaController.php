<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hari;
use App\Models\Surat;
use App\Models\Warga;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\JadwalRondaDataTable;
use App\Models\JadwalRonda;

class JadwalRondaController extends Controller
{
    public function index(JadwalRondaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.ronda.jadwal.index');
    }

    public function create()
    {
        $warga = Warga::where('status_keluarga_id', "1")->pluck('nama', 'id');
        $hari = Hari::pluck('nama', 'id');
        // dd($hari);
        return view('pages.admin.ronda.jadwal.add-edit', [
            'warga' => $warga,
            'hari' => $hari,
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            try {
                // dd($request->jadwal_ronda_warga_id[1]);
                foreach($request->jadwal_ronda_warga_id as $key) {
                    // dd($key);
                    $jadwal_ronda = JadwalRonda::createFromRequest($request);
                    $jadwal_ronda->warga_id = $key;
                    $jadwal_ronda->save();
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.ronda.jadwal.index'))->withInput()->withToastSuccess('Data tersimpan');
    }
}
