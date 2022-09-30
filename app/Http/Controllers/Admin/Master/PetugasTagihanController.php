<?php

namespace App\Http\Controllers\Admin\MAster;

use App\Models\Pos;
use App\Models\User;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use Illuminate\Http\Request;
use App\Models\PetugasTagihan;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\PetugasTagihanForm;
use App\DataTables\Admin\Master\PetugasTagihanDataTable;

class PetugasTagihanController extends Controller
{

    public function index(PetugasTagihanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.petugas-tagihan.index');
    }


    public function create()
    {
        $user_id = User::pluck('name', 'id');
        $pos_id = Pos::pluck('nama', 'id');
        return view('pages.admin.master.petugas-tagihan.add-edit', [
            'user_id' => $user_id,
            'pos_id' => $pos_id
        ]);
    }

    public function store(PetugasTagihanForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                // dd($request->all());
                $petugas = PetugasTagihan::createFromRequest($request);
                $petugas->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'petugas/foto');
                        $petugas->dokumen()->create([
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
        return redirect(route('admin.master-data.petugas-tagihan.index'))->withToastSuccess('Data tersimpan');
    }


    public function show($id)
    {
        //
    }

    public function edit($id, DataHelper $dataHelper)
    {
        $data = PetugasTagihan::with('dokumen')->findOrFail($id);
        $area_pos = Pos::pluck('nama', 'id');
        return view(
            'pages.admin.master.petugas-tagihan.add-edit',
            [
                'data' => $data,
                'dataHelper' => $dataHelper,
                'area_pos' => $area_pos
            ]
        );
    }

    public function update(PetugasTagihanForm $request, FileUploaderHelper $fileUploaderHelper, $id)
    {
        $petugas = PetugasTagihan::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $petugas) {
            try {
                $petugas->updateFromRequest($request);
                $petugas->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $petugas->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        TrashHelper::moveToTrash($old->public_url);

                        $upload = $fileUploaderHelper->store($file, 'petugas/lampiran');
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
        return redirect(route('admin.master-data.petugas-tagihan.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            PetugasTagihan::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
