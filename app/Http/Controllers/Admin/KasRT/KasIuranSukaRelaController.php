<?php

namespace App\Http\Controllers\Admin\KasRT;

use Illuminate\Http\Request;
use App\Models\IuranSukarela;
use App\Models\KasIuranSukaRela;
use App\Models\PetugasTagihan;
use App\Models\Bulan;
use App\Models\Tahun;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Datatables\Admin\KasRT\KasIuranSukaRelaDataTable;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Helpers\FileUploaderHelper;
use App\Http\Requests\Admin\IuranSukarelaForm;
use App\Models\Keluarga;
use Illuminate\Support\Facades\DB;

class KasIuranSukaRelaController extends Controller
{
    public function index(KasIuranSukaRelaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas-rt.kasiuransukarela.index');
    }

    public function create()
    {
        $jenis_iuransukarela = IuranSukarela::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        $wargaa = KasIuranSukarela::all();
        return view('pages.admin.kas-rt.kasiuransukarela.add-edit', ['jenis_iuransukarela' => $jenis_iuransukarela, 'nama_petugas' => $nama_petugas, 'warga' => $warga, 'wargaa' => $wargaa]);
    }

    public function status($id)
    {
        $sukarela = KasIuranSukaRela::find($id);
        $sukarela->status = !$sukarela->status;
        $sukarela->save();
        return redirect()->back();
    }

    public function store(IuranSukarelaForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                $sukarela = KasIuranSukaRela::createFromRequest($request);
                $pos = Keluarga::where('id', $sukarela->warga)->first()->pos;
                $sukarela->pos = $pos->id;
                $sukarela->petugas = $pos->petugastagihan->id;

                $sukarela->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'sukarela/foto');
                        $sukarela->dokumen()->create([
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
    // public function store(Request $request)
    // {
    //     $sukarela = new KasIuranSukaRela;
    //     $sukarela->jenis_iuran_id = $request->input('jenis_iuran_id');
    //     $sukarela->bulan = $request->input('bulan');
    //     $sukarela->tahun = $request->input('tahun');
    //     $sukarela->pemberi = $request->input('pemberi');
    //     $sukarela->penerima = $request->input('penerima');
    //     $sukarela->total_biaya = $request->input('total_biaya');
    //     if ($request->hasfile('bukti_pembayaran')) {
    //         $file = $request->file('bukti_pembayaran');
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $ext;
    //         $file->move('uploads/sukarela/', $filename);
    //         $sukarela->bukti_pembayaran = $filename;
    //     }
    //     $sukarela->save();
    //     return redirect(route('admin.kas-rt.kas-iuransukarela.index'))->withToastSuccess('Data tersimpan');
    //     $sukarela->bukti_pembayaran = $request->input('bukti_pembayaran');
    // }

    public function show(KasIuranSukaRelaDataTable $dataTable, $id)
    {
        // $sukarela = KasIuranSukaRela::find($id);
        // return view('pages.admin.kas-rt.kasiuransukarela.show', compact('sukarela'));
    }


    public function edit($id, DataHelper $dataHelper)
    {
        $data = KasIuranSukaRela::findOrFail($id);
        $jenis_iuransukarela = IuranSukarela::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        return view(
            'pages.admin.kas-rt.kasiuransukarela.add-edit',
            [
                'data' => $data,
                'jenis_iuransukarela' => $jenis_iuransukarela,
                'nama_petugas' => $nama_petugas,
                'warga' => $warga,
                'dataHelper' => $dataHelper
            ]
        );
    }

    public function update(IuranSukarelaForm $request, FileUploaderHelper $fileUploaderHelper, $id)
    {
        $sukarela = KasIuranSukarela::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $sukarela) {
            try {
                $sukarela->updateFromRequest($request);
                $sukarela->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $sukarela->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        TrashHelper::moveToTrash($old->public_url);

                        $upload = $fileUploaderHelper->store($file, 'iuran-sukarela/lampiran');
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
        return redirect(route('admin.kas-rt.kas-iuransukarela.index'))->withToastSuccess('Data tersimpan');
    }

    // public function update(Request $request, $id)
    // {

    //     $sukarela = KasIuranSukaRela::find($id);

    //     $sukarela->jenis_iuran_id = $request->input('jenis_iuran_id');
    //     $sukarela->bulan = $request->input('bulan');
    //     $sukarela->pemberi = $request->input('pemberi');
    //     $sukarela->penerima = $request->input('penerima');
    //     $sukarela->total_biaya = $request->input('total_biaya');

    //     if ($request->hasfile('bukti_pembayaran')) {
    //         $destination_path = 'uploads/sukarela' . $sukarela->bukti_pembayaran;
    //         if (File::exists($destination_path)) {
    //             File::delete($destination_path);
    //         }

    //         $file = $request->file('bukti_pembayaran');
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $ext;
    //         $file->move('uploads/sukarela/', $filename);
    //         $sukarela->bukti_pembayaran = $filename;
    //     }
    //     $sukarela->update();
    //     return redirect(route('admin.kas-rt.kas-iuransukarela.index'))->withToastSuccess('Data tersimpan');
    // }

    public function destroy($id)
    {
        try {
            KasIuranSukaRela::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    // public function destroy($id)
    // {
    //     try {
    //         $sukarela = KasIuranSukaRela::find($id);
    //         $destination_path = 'uploads/sukarela' . $sukarela->bukti_pembayaran;
    //         if (File::exists($destination_path)) {
    //             File::delete($destination_path);
    //         }
    //         $sukarela->delete();
    //     } catch (\Throwable $th) {
    //         return response(['error' => 'Something went wrong']);
    //     }
    // }
}
