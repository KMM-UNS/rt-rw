<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hari;
use App\Models\Warga;
use Illuminate\Http\Request;
use App\Models\PresensiRonda;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\PresensiRondaDataTable;

class PresensiRondaController extends Controller
{
    public function index(PresensiRondaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.ronda.jadwal.index');
    }

    public function create()
    {
        $warga = Warga::where('status_keluarga_id', "1")->pluck('nama', 'id');
        $hari = Hari::pluck('nama', 'id');
        return view('pages.admin.ronda.presensi.add-edit', [
            'warga' => $warga,
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
