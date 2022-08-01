<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hari;
use App\Models\Ronda;
use App\Models\Surat;
use App\Models\Warga;
use App\Helpers\DataHelper;
use App\Models\JadwalRonda;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\JadwalRondaDataTable;

class JadwalRondaController extends Controller
{
    function __construct()
    {
    $this->middleware('role:admin')->except(['index']);
    }

    public function index(JadwalRondaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.ronda.jadwal.index');
    }

    public function create(DataHelper $dataHelper)
    {
        $warga = Warga::where('status_keluarga_id', "1")->whereDoesntHave('jadwal_ronda.ronda', function ($query){
            return $query->where('status', 'aktif');
        })->pluck('nama', 'id');
        $hari = $dataHelper->dayDropdownData();
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
                $ronda = Ronda::where('status', 'aktif')->first();
                foreach($request->jadwal_ronda_warga_id as $key) {
                    // dd($key);
                    $jadwal_ronda = JadwalRonda::createFromRequest($request);
                    $jadwal_ronda->warga_id = $key;
                    $jadwal_ronda->ronda_id = $ronda->id;
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

    public function edit(DataHelper $dataHelper, $id)
    {
        $data = JadwalRonda::findOrFail($id);
        $warga = Warga::where('status_keluarga_id', "1")->pluck('nama', 'id');
        $hari = $dataHelper->dayDropdownData();
        // dd($hari);
        return view('pages.admin.ronda.jadwal.add-edit', [
            'data' => $data,
            'warga' => $warga,
            'hari' => $hari,
        ]);
    }

    public function update(Request $request, $id)
    {
        $jadwal_ronda = JadwalRonda::findOrFail($id);
        DB::transaction(function () use ($request, $jadwal_ronda) {
            try {
                $jadwal_ronda->updateFromRequest($request);
                $jadwal_ronda->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.ronda.jadwal.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            JadwalRonda::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
