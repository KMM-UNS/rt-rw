<?php

namespace App\Http\Controllers\User;

use App\Models\Rumah;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\User\KeluargaDataTable;
use App\Http\Requests\Admin\KeluargaForm;
use App\Models\RiwayatRumah;
use App\Models\StatusTinggal;
use Carbon\Carbon;

class KeluargaController extends Controller
{
    function __construct()
    {
    $this->middleware('keluarga')->except('index');
    }

    public function index()
    {
        $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->with('rumah')->first();
        // dd($keluarga);
        return view('pages.user.keluarga.index', [
            'keluarga' => $keluarga
        ]);
    }

    public function create()
    {
        $rumah = Rumah::pluck('nomor_rumah', 'id');
        return view('pages.user.keluarga.add', [
            'rumah' => $rumah
        ]);
    }

    public function store(KeluargaForm $request)
    {
        DB::transaction(function () use ($request) {
            try {
                $status_tinggal = StatusTinggal::select('id')->where('nama', 'Warga Tinggal')->first();
                $keluarga = Keluarga::createFromRequest($request);
                $keluarga->status_tinggal = $status_tinggal->id;
                $keluarga->createable()->associate($request->user());
                $keluarga->save();

                $riwayat = RiwayatRumah::createFromRequest($request);
                $riwayat->rumah_id = $keluarga->rumah_id;
                $riwayat->keluarga_id = $keluarga->id;
                $riwayat->tanggal_masuk = Carbon::now()->format('Y-m-d');
                $riwayat->save();

            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('user.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }
}
