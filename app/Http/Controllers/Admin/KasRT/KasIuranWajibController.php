<?php

namespace App\Http\Controllers\Admin\KasRT;

use App\Datatables\Admin\KasRT\KasIuranWajibDataTable;
use App\Models\IuranWajib;
use App\Models\PetugasTagihan;
use App\Models\Bulan;
use App\Models\Tahun;
use App\Http\Controllers\Controller;
use App\Models\KasIuranWajib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Helpers\FileUploaderHelper;
use App\Http\Requests\Admin\IuranWajibForm;

class KasIuranWajibController extends Controller
{
    public function index(KasIuranWajibDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas-rt.kasiuranwajib.index');
    }

    public function create()
    {
        $jenis_iuranwajib = IuranWajib::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $nama_bulan = Bulan::pluck('nama', 'id');
        $tahun = Tahun::pluck('nama', 'id');
        return view('pages.admin.kas-rt.kasiuranwajib.add-edit', ['jenis_iuranwajib' => $jenis_iuranwajib, 'nama_petugas' => $nama_petugas, 'nama_bulan' => $nama_bulan, 'tahun' => $tahun]);
    }

    public function store(IuranWajibForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                $wajib = KasIuranWajib::createFromRequest($request);
                $wajib->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'wajib/foto');
                        $wajib->dokumen()->create([
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
        return redirect(route('admin.kas-rt.kas-iuranwajib.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id, DataHelper $dataHelper)
    {
        $data = KasIuranWajib::with('dokumen')->findOrFail($id);
        $jenis_iuranwajib = IuranWajib::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $nama_bulan = Bulan::pluck('nama', 'id');
        $tahun = Tahun::pluck('nama', 'id');
        return view('pages.admin.kas-rt.kasiuranwajib.add-edit', [
            'data' => $data,
            'jenis_iuranwajib' => $jenis_iuranwajib,
            'nama_petugas' => $nama_petugas,
            'nama_bulan' => $nama_bulan,
            'tahun' => $tahun,
            'dataHelper' => $dataHelper
        ]);
    }


    public function update(IuranWajibForm $request, FileUploaderHelper $fileUploaderHelper, $id)
    {
        $wajib = KasIuranWajib::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $wajib) {
            try {
                $wajib->updateFromRequest($request);
                $wajib->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $wajib->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        TrashHelper::moveToTrash($old->public_url);

                        $upload = $fileUploaderHelper->store($file, 'iuran-wajib/lampiran');
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
        return redirect(route('admin.kas-rt.kas-iuranwajib.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KasIuranWajib::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
