<?php

namespace App\Http\Controllers\User;

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
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WargaForm;
use App\Models\Dokumen;

class WargaController extends Controller
{
    function __construct()
    {
        $this->middleware('warga')->except('index');
    }

    public function index()
    {
        $keluarga = Keluarga::select('id')->where('createable_id', auth()->user()->id)->first();
        if ($keluarga == null)
        {
            return view('pages.user.warga.index', [
                'keluarga' => $keluarga,
            ]);
        }
        else
        {
            $data = Warga::select('*')->with(['dokumen', 'status_keluarga'])->where('keluarga_id', $keluarga->id)->get();
            // dd($data->dokumen);
            return view('pages.user.warga.index', [
                'keluarga' => $keluarga,
                'data' => $data
            ]);
        }
    }

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

        return view('pages.user.warga.add-edit', [
            'agama' => $agama,
            'golongan_darah' => $golongan_darah,
            'warga_negara' => $warga_negara,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'status_keluarga' => $status_keluarga,
            'status_kawin' => $status_kawin,
            'status_warga' => $status_warga
        ]);
    }

    public function store(WargaForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                $keluarga_id = Keluarga::select('id')->where('createable_id', auth()->user()->id)->first();
                $warga = Warga::createFromRequest($request);
                $warga->keluarga_id = $keluarga_id->id;
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
        return redirect(route('user.warga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        $data = Warga::with('dokumen')->findOrFail($id);
        // $dokumen = Dokumen::where()
        return view('pages.user.warga.show', [
            'data' => $data,
        ]);
    }

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

        return view('pages.user.warga.add-edit', [
            'data' => $data,
            'agama' => $agama,
            'golongan_darah' => $golongan_darah,
            'warga_negara' => $warga_negara,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'status_keluarga' => $status_keluarga,
            'status_kawin' => $status_kawin,
            'status_warga' => $status_warga
        ]);
    }

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
        return redirect(route('user.warga.index'))->withInput()->withToastSuccess('Data Tersimpan!');
    }

    public function destroy($id)
    {
        try {
            Warga::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}


