<?php

namespace App\Http\Controllers\User\KasRT;

use Illuminate\Http\Request;
use App\Models\IuranSukarela;
use App\Models\KasIuranSukaRela;
use App\Models\PetugasTagihan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Datatables\User\KasRT\KasIuranSukaRelaDataTable;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Helpers\FileUploaderHelper;
use App\Http\Requests\Admin\IuranSukarelaForm;
use App\Models\Keluarga;
use App\Models\Dokumen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class KasIuranSukaRelaController extends Controller
{
    public function index(KasIuranSukarelaDataTable $dataTable)
    {
        return $dataTable->render('pages.user.kas-rt.kasiuransukarela.index');
    }

    public function create()
    {
        $jenis_iuransukarela = IuranSukarela::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        $wargaa = KasIuranSukarela::all();

        return view('pages.user.kas-rt.kasiuransukarela.add-edit',  ['jenis_iuransukarela' => $jenis_iuransukarela, 'nama_petugas' => $nama_petugas, 'wargaa' => $wargaa, 'warga' => $warga]);
    }

    public function store(IuranSukarelaForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                $sukarela = KasIuranSukarela::createFromRequest($request);
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
        return redirect(route('user.kas-rt.kas-iuransukarela.index'))->withToastSuccess('Data tersimpan');
    }

    public function cetak_pdf($id)
    {
        $warga = KasIuranSukaRela::with(['iuransukarela', 'petugastagihan', 'postagihansukarela', 'warga_sukarela'])->findOrFail($id);
        // $pdf = PDF::loadView('pages.user.kas-rt.kasiuransukarela.sukarela_pdf', ['warga' => $warga]);
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = PDF::loadView('pages.user.kas-rt.kasiuransukarela.sukarela_pdf', ['warga' => $warga, 'data' => $data]);
        return $pdf->download('sukarela_buktipembayaran.pdf');
    }

    public function show($id)
    {
        //
    }

    public function edit($id, DataHelper $dataHelper)
    {
        $data = KasIuranSukarela::findOrFail($id);
        $jenis_iuransukarela = IuranSukarela::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        return view('pages.user.kas-rt.kasiuransukarela.add-edit', [
            'data' => $data,
            'jenis_iuransukarela' => $jenis_iuransukarela,
            'nama_petugas' => $nama_petugas,
            'warga' => $warga,
            'dataHelper' => $dataHelper
        ]);
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
        return redirect(route('user.kas-rt.kas-iuransukarela.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KasIuranSukarela::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
