<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rumah;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\RiwayatRumah;
use Illuminate\Http\Request;
use App\Models\StatusTinggal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KeluargaForm;
use App\DataTables\Admin\KeluargaDataTable;
use App\DataTables\Admin\DetailKeluargaDataTable;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KeluargaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.keluarga.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rumah = Rumah::pluck('nomor_rumah', 'id');
        return view('pages.admin.keluarga.add-edit', [
            'rumah' => $rumah
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DetailKeluargaDataTable $dataTable, $id)
    {
        $data = Keluarga::findorFail($id);
        $rumah = Rumah::pluck('nomor_rumah', 'id');
        // $status_tinggal = StatusTinggal::pluck('nama', 'id');
        return $dataTable->render('pages.admin.keluarga.show', [
            'data' => $data,
            'rumah' => $rumah,
            // 'status_tinggal' => $status_tinggal
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Keluarga::findorFail($id);
        $rumah = Rumah::pluck('nomor_rumah', 'id');

        return view('pages.admin.keluarga.add-edit', [
            'data' => $data,
            'rumah' => $rumah,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KeluargaForm $request, $id)
    {
        $keluarga = Keluarga::findorFail($id);
        DB::transaction(function () use ($request, $keluarga) {
            try {
                $keluarga->updateFromRequest($request);
                $keluarga->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Keluarga::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function pindah(Request $request, $id)
    {
        $keluarga = Keluarga::findorFail($id);
        // dd($request->lokasi);
        if ($request->lokasi == "Dalam Lingkungan")
        {
            DB::transaction(function () use ($request, $keluarga) {
                try {
                    // dd($keluarga->rumah_id == null);
                    if ($keluarga->rumah_id != null)
                    {
                        // mencari riwayat
                        $riwayatBefore = RiwayatRumah::where('keluarga_id', $keluarga->id)->where('rumah_id', $keluarga->rumah_id)->firstorFail();

                        // update ke rumah yang dipilih
                        $keluarga->updateFromRequest($request);
                        $keluarga->save();

                        // update tanggal keluar rumah sebelum
                        // dd($riwayatBefore);
                        $riwayatBefore->updateFromRequest($request);
                        $riwayatBefore->tanggal_keluar = Carbon::now()->format('Y-m-d');
                        $riwayatBefore->save();

                        // create riwayat baru dengan rumah baru
                        $riwayat = RiwayatRumah::createFromRequest($request);
                        $riwayat->rumah_id = $keluarga->rumah_id;
                        $riwayat->keluarga_id = $keluarga->id;
                        $riwayat->tanggal_masuk = Carbon::now()->format('Y-m-d');
                        $riwayat->save();
                    }
                    else
                    {
                        // update ke rumah yang dipilih
                        $keluarga->updateFromRequest($request);
                        $keluarga->status_tinggal = 1;
                        // dd($keluarga);
                        $keluarga->save();

                        // create riwayat baru dengan rumah baru
                        $riwayat = RiwayatRumah::createFromRequest($request);
                        $riwayat->rumah_id = $keluarga->rumah_id;
                        $riwayat->keluarga_id = $keluarga->id;
                        $riwayat->tanggal_masuk = Carbon::now()->format('Y-m-d');
                        $riwayat->save();
                    }
                } catch (\Throwable $th) {
                    dd($th);
                    DB::rollback();
                    return back()->withInput()->withToastError('Something what happen');
                }
            });
            return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
        }
        elseif ($request->lokasi == "Luar Lingkungan")
        {
            DB::transaction(function () use ($request, $keluarga) {
                try {
                        $riwayatBefore = RiwayatRumah::where('keluarga_id', $keluarga->id)->where('rumah_id', $keluarga->rumah_id)->firstorFail();

                        // update ke rumah yang dipilih
                        $keluarga->updateFromRequest($request);
                        $keluarga->status_tinggal = 2;
                        $keluarga->rumah_id = "";
                        $keluarga->save();

                        // update tanggal keluar rumah sebelum
                        $riwayatBefore->updateFromRequest($request);
                        $riwayatBefore->tanggal_keluar = Carbon::now()->format('Y-m-d');
                        $riwayatBefore->save();
                } catch (\Throwable $th) {
                    dd($th);
                    DB::rollback();
                    return back()->withInput()->withToastError('Something what happen');
                }
            });
            return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
        }
    }
}