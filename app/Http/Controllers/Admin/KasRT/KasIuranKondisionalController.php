<?php

namespace App\Http\Controllers\Admin\KasRT;

use App\Datatables\Admin\KasRT\KasIuranKondisionalDataTable;
use App\Http\Controllers\Controller;
use App\Models\IuranKondisional;
use App\Models\PetugasTagihan;
use App\Models\KasIuranKondisional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Helpers\FileUploaderHelper;
use App\Http\Requests\Admin\IuranKondisionalForm;
use App\Models\KasIuranAgenda;
use Illuminate\Support\Facades\DB;


class KasIuranKondisionalController extends Controller
{
    public function index(KasIuranKondisionalDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas-rt.kasiurankondisional.index');
    }

    public function create()
    {
        $jenis_iurankondisional = IuranKondisional::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        return view('pages.admin.kas-rt.kasiurankondisional.add-edit', ['jenis_iurankondisional' => $jenis_iurankondisional, 'nama_petugas' => $nama_petugas]);
    }

    public function store(IuranKondisionalForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                $kondisional = KasIuranKondisional::createFromRequest($request);
                $kondisional->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'kondisional/foto');
                        $kondisional->dokumen()->create([
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
        return redirect(route('admin.kas-rt.kas-iuransukarela.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }


    public function edit($id, DataHelper $dataHelper)
    {
        $data = KasIuranAgenda::with('dokumen')->findOrFail($id);
        $jenis_iurankondisional = IuranKondisional::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        return view('pages.admin.kas-rt.kasiurankondisional.add-edit', [
            'data' => $data,
            'jenis_iurankondisional' => $jenis_iurankondisional,
            'nama_petugas' => $nama_petugas,
            'dataHelper' => $dataHelper
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_petugas' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {

            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = KasIuranKondisional::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        //tambahan
        // $foto = KasIuranKondisional::findorfail($id);
        // if ($request->has('picture')) {
        //     File::delete("BuktiPembayaran//" . $foto->picture);
        //     $picture = $request->picture;
        //     $pathFoto = time() . ' - ' . $picture->getClientOriginalName();
        //     $picture->move('BuktiPembayaran//', $pathFoto);

        //     $foto_data = [
        //         'jenis_iuran_id' => $request["jenis_iuran_id"],
        //         'bulan' => $request["bulan"],
        //         'tahun' => $request["tahun"],
        //         'pemberi' => $request["pemberi"],
        //         'total_biaya' => $request["total_biaya"],
        //         'bukti_pembayaran' => $pathFoto
        //     ];
        // } else {
        //     $foto_data = [
        //         'jenis_iuran_id' => $request["jenis_iuran_id"],
        //         'bulan' => $request["bulan"],
        //         'tahun' => $request["tahun"],
        //         'pemberi' => $request["pemberi"],
        //         'total_biaya' => $request["total_biaya"]
        //     ];
        // }

        // $foto->update($foto_data);

        return redirect(route('admin.kas-rt.kas-iurankondisional.index'))->withToastSuccess('Data tersimpan');
    }
    public function destroy($id)
    {
        try {
            KasIuranKondisional::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}