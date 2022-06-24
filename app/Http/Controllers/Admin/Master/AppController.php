<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\App;
use App\Models\Warga;
use App\Models\Regency;
use App\Models\District;
use App\Models\Province;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\Cloner\Data;
use App\DataTables\Admin\Master\AppDataTable;

class AppController extends Controller
{
    public function index()
    {
        $data = App::orderBy('id', 'DESC')->first();
        $provinsi = Province::pluck('name', 'id');
        $kabupaten = [];
        $kecamatan = [];
        $kelurahan = [];

        if(isset($data)) {
            if (old('provinsi_id') || $data->provinsi_id) {
                $dt = old('provinsi_id') ?? $data->provinsi_id;
                $kabupaten = Province::find($dt)->regencies->pluck('name', 'id');
            }

            if (old('kabupaten_id') || $data->kabupaten_id) {
                $dt = old('kabupaten_id') ?? $data->kabupaten_id;
                $kecamatan = Regency::find($dt)->districts->pluck('name', 'id');
            }

            if (old('kecamatan_id') || $data->kecamatan_id) {
                $dt = old('kecamatan_id') ?? $data->kecamatan_id;
                //$dt=$data->asal_kecamatan;
                $kelurahan = District::find($dt)->villages->pluck('name', 'id');
            }
        }
        else
        {
            if (old('provinsi_id')) {
                $kabupaten = Province::find(old('provinsi_id'))->regencies->pluck('name', 'id');
            }

            if (old('kabupaten_id')) {
                $kecamatan = Regency::find(old('kabupaten_id'))->districts->pluck('name', 'id');
            }

            if (old('kecamatan_id')) {
                $kelurahan = District::find(old('kecamatan_id'))->villages->pluck('name', 'id');
            }
        }

        return view('pages.admin.master.app.index', [
            'data' => $data,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
        ]);
    }

    public function create()
    {
        $provinsi = Province::pluck('name', 'id');
        $kabupaten = [];
        $kecamatan = [];
        $kelurahan = [];

        if (old('apps_provinsi')) {
            $kabupaten = Province::find(old('apps_provinsi'))->regencies->pluck('name', 'id');
        }

        if (old('apps_kabupaten')) {
            $kecamatan = Regency::find(old('apps_kabupaten'))->districts->pluck('name', 'id');
        }

        if (old('apps_kecamatan')) {
            $kelurahan = District::find(old('apps_kecamatan'))->villages->pluck('name', 'id');
        }
        return view('pages.admin.master.app.add-edit', [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
        ]);
    }

    public function store(Request $request, FileUploaderHelper $fileUploaderHelper)
    {
        // dd($request->all());
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                // dd($request->all());
                $app = App::createFromRequest($request);
                $app->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'app/ttd');
                        $app->dokumen()->create([
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
        return redirect(route('admin.master-data.aplikasi.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = App::findOrFail($id);
        return view('pages.admin.master.app.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id, FileUploaderHelper $fileUploaderHelper)
    {
        $app = App::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $app) {
            try {
                $app->updateFromRequest($request);
                $app->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $app->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        TrashHelper::moveToTrash($old->public_url);

                        $upload = $fileUploaderHelper->store($file, 'app/lampiran');
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

        return redirect(route('admin.master-data.aplikasi.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            App::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
