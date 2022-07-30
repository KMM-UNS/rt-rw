<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Rumah;
use App\Models\Keluarga;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Models\RiwayatRumah;
use Illuminate\Http\Request;
use App\Models\StatusTinggal;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KeluargaForm;
use App\DataTables\User\KeluargaDataTable;

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
        return view('pages.user.keluarga.add-edit', [
            'rumah' => $rumah
        ]);
    }

    public function store(KeluargaForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                $status_tinggal = StatusTinggal::select('id')->where('nama', 'Warga Tinggal')->first();
                $keluarga = Keluarga::createFromRequest($request);
                $keluarga->status_tinggal_id = $status_tinggal->id;
                $keluarga->createable()->associate($request->user());
                $keluarga->save();

                // $riwayat = RiwayatRumah::createFromRequest($request);
                // $riwayat->rumah_id = $keluarga->rumah_id;
                // $riwayat->keluarga_id = $keluarga->id;
                // $riwayat->tanggal_masuk = Carbon::now()->format('Y-m-d');
                // $riwayat->save();

                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'keluarga/dokumen');
                        $keluarga->dokumen()->create([
                            'nama' => $key,
                            'public_url' => $upload['public_path']
                        ]);
                    }
                }

            } catch (\Throwable $th) {
                // dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Terdapat kesalahan saat menyimpan data');
            }
        });
        return redirect(route('user.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = Keluarga::findOrFail($id);
        $rumah = Rumah::pluck('nomor_rumah', 'id');
        return view('pages.user.keluarga.add-edit', [
            'rumah' => $rumah,
            'data' => $data
        ]);
    }

    public function update(KeluargaForm $request, $id,  FileUploaderHelper $fileUploaderHelper)
    {
        // dd($request->all());
        $keluarga = Keluarga::findorFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $keluarga) {
            try {
                $keluarga->updateFromRequest($request);
                $keluarga->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $keluarga->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        if ($old != null){
                            TrashHelper::moveToTrash($old->public_url);
                            $upload = $fileUploaderHelper->store($file, 'keluarga/dokumen');
                            $old->update([
                                'public_url' => $upload['public_path']
                            ]);
                        } else {
                            $upload = $fileUploaderHelper->store($file, 'keluarga/dokumen');
                            $keluarga->dokumen()->create([
                                'nama' => $key,
                                'public_url' => $upload['public_path']
                            ]);
                        }

                    }
                }
            } catch (\Throwable $th) {
                // dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Terdapat kesalahan saat menyimpan data');
            }
        });
        return redirect(route('user.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }
}
