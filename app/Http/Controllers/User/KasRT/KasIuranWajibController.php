<?php

namespace App\Http\Controllers\User\KasRT;

use App\Datatables\User\KasRT\KasIuranWajibDataTable;
use App\Models\IuranWajib;
use App\Models\PetugasTagihan;
use App\Http\Controllers\Controller;
use App\Models\KasIuranWajib;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dokumen;
use Illuminate\Support\Facades\File;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Helpers\FileUploaderHelper;
use App\Http\Requests\Admin\IuranWajibForm;
use App\Models\Keluarga;

class KasIuranWajibController extends Controller
{
    public function index(KasIuranWajibDataTable $dataTable)
    {
        return $dataTable->render('pages.user.kas-rt.kasiuranwajib.index');
    }

    public function create()
    {
        $jenis_iuranwajib = IuranWajib::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        $wargaa = KasIuranWajib::all();

        return view('pages.user.kas-rt.kasiuranwajib.add-edit',  ['jenis_iuranwajib' => $jenis_iuranwajib, 'nama_petugas' => $nama_petugas, 'wargaa' => $wargaa, 'warga' => $warga]);
    }

    public function store(IuranWajibForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                $wajib = KasIuranWajib::createFromRequest($request);
                $pos = Keluarga::where('id', $wajib->warga)->first()->pos;
                $wajib->pos = $pos->id;
                $wajib->petugas = $pos->petugastagihan->id;

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
        return redirect(route('user.kas-rt.kas-iuranwajib.index'))->withToastSuccess('Data tersimpan');
    }

    public function cetak_pdf($id)
    {
        $warga = KasIuranWajib::with(['iuranwajib', 'petugastagihan', 'postagihanwajib', 'warga_wajib'])->findOrFail($id);
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = PDF::loadView('pages.user.kas-rt.kasiuranwajib.wajib_pdf', ['warga' => $warga, 'data' => $data]);
        // $pdf = PDF::loadView('pages.user.kas-rt.kasiuranwajib.wajib_pdf', ['warga' => $warga]);
        return $pdf->download('wajib_buktipembayaran.pdf');
    }

    public function show($id)
    {
        //
    }

    public function edit($id, DataHelper $dataHelper)
    {
        $data = KasIuranWajib::findOrFail($id);
        $jenis_iuranwajib = IuranWajib::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        return view('pages.user.kas-rt.kasiuranwajib.add-edit', [
            'data' => $data,
            'jenis_iuranwajib' => $jenis_iuranwajib,
            'nama_petugas' => $nama_petugas,
            'warga' => $warga,
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
        return redirect(route('user.kas-rt.kas-iuranwajib.index'))->withToastSuccess('Data tersimpan');
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
