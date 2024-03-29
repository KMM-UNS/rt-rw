<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agama;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Helpers\DataHelper;
use App\Models\StatusKawin;
use App\Models\StatusWarga;
use App\Models\WargaNegara;
use App\Helpers\TrashHelper;
use Illuminate\Http\Request;
use App\Models\GolonganDarah;
use App\Models\StatusKeluarga;
use PHPUnit\Framework\Warning;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WargaForm;
use App\DataTables\Admin\WargaDataTable;
use App\DataTables\Admin\WargaPindahDataTable;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WargaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.warga.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agama = Agama::pluck('nama', 'id');
        $golongan_darah = GolonganDarah::pluck('nama', 'id');
        $warga_negara = WargaNegara::pluck('nama', 'id');
        $pendidikan = Pendidikan::pluck('nama', 'id');
        $pekerjaan = Pekerjaan::pluck('nama', 'id');
        $status_keluarga = StatusKeluarga::pluck('nama', 'id');
        $status_kawin = StatusKawin::pluck('nama', 'id');
        $status_warga = StatusWarga::pluck('nama', 'id');
        $keluarga = Keluarga::pluck('no_kk', 'id');


        return view('pages.admin.warga.add-edit', [
            'agama' => $agama,
            'golongan_darah' => $golongan_darah,
            'warga_negara' => $warga_negara,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'status_keluarga' => $status_keluarga,
            'status_kawin' => $status_kawin,
            'status_warga' => $status_warga,
            'keluarga' => $keluarga
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WargaForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                // dd($request->all());
                $warga = Warga::createFromRequest($request);
                $warga->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'warga/foto');
                        $warga->dokumen()->create([
                            'nama' => $key,
                            'public_url' => $upload['public_path']
                        ]);
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.warga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Warga::with('dokumen')->findOrFail($id);
        return view('pages.admin.warga.show',[
            'data' => $data
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Warga::with('dokumen')->findOrFail($id);
        $agama = Agama::pluck('nama', 'id');
        $golongan_darah = GolonganDarah::pluck('nama', 'id');
        $warga_negara = WargaNegara::pluck('nama', 'id');
        $pendidikan = Pendidikan::pluck('nama', 'id');
        $pekerjaan = Pekerjaan::pluck('nama', 'id');
        $status_keluarga = StatusKeluarga::pluck('nama', 'id');
        $status_kawin = StatusKawin::pluck('nama', 'id');
        $status_warga = StatusWarga::pluck('nama', 'id');
        $keluarga = Keluarga::pluck('no_kk', 'id');

        return view('pages.admin.warga.add-edit', [
            'data' => $data,
            'agama' => $agama,
            'golongan_darah' => $golongan_darah,
            'warga_negara' => $warga_negara,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'status_keluarga' => $status_keluarga,
            'status_kawin' => $status_kawin,
            'status_warga' => $status_warga,
            'keluarga' => $keluarga
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WargaForm $request, FileUploaderHelper $fileUploaderHelper, $id)
    {
        $warga = Warga::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $warga) {
            try {
                $warga->updateFromRequest($request);
                $warga->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $warga->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        TrashHelper::moveToTrash($old->public_url);

                        $upload = $fileUploaderHelper->store($file, 'warga/lampiran');
                        $old->update([
                            'public_url' => $upload['public_path']
                        ]);
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.warga.index'))->withInput()->withToastSuccess('Data tersimpan');
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
            Warga::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
