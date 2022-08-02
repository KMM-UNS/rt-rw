<?php

namespace App\Http\Controllers\Admin\KasRT;

use App\Datatables\Admin\KasRT\KasIuranAgendaDataTable;
use App\Http\Controllers\Controller;
use App\Models\IuranAgenda;
use App\Models\PetugasTagihan;
use App\Models\Bulan;
use App\Models\Tahun;
use App\Models\KasIuranAgenda;
use Illuminate\Http\Request;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Helpers\FileUploaderHelper;
use App\Http\Requests\Admin\IuranAgendaForm;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Support\Facades\DB;


class KasIuranAgendaController extends Controller
{
    public function index(KasIuranAgendaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas-rt.kasiuranagenda.index');
    }

    public function create()
    {
        $jenis_iuranagenda = Iuranagenda::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        $wargaa = KasIuranAgenda::all();

        return view('pages.admin.kas-rt.kasiuranagenda.add-edit', ['wargaa' => $wargaa, 'jenis_iuranagenda' => $jenis_iuranagenda,  'nama_petugas' => $nama_petugas, 'warga' => $warga]);
    }

    public function status($id)
    {
        $agenda = KasIuranAgenda::find($id);
        $agenda->status = !$agenda->status;
        $agenda->save();
        return redirect()->back();
    }

    public function store(IuranAgendaForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                $agenda = KasIuranAgenda::createFromRequest($request);
                $pos = Keluarga::where('id', $agenda->warga)->first()->pos;
                $agenda->pos = $pos->id;
                $agenda->petugas = $pos->petugastagihan->id;
                $agenda->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'agenda/foto');
                        $agenda->dokumen()->create([
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
        return redirect(route('admin.kas-rt.kas-iuranagenda.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        // $image = KasIuranAgenda::find($id);
        // return view('pages.admin.kas-rt.kasiuranagenda.show', compact('image'));
        // return view('pages.admin.kas-rt.kasiuranagenda.show', ['$bukti_pembayaran' => $bukti_pembayaran]);
    }
    public function edit($id, DataHelper $dataHelper)
    {
        $data = KasIuranAgenda::findOrFail($id);
        $jenis_iuranagenda = IuranAgenda::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        return view('pages.admin.kas-rt.kasiuranagenda.add-edit', [
            'data' => $data,
            'jenis_iuranagenda' => $jenis_iuranagenda,
            'nama_petugas' => $nama_petugas,
            'warga' => $warga,
            'dataHelper' => $dataHelper
        ]);
    }

    public function update(IuranAgendaForm $request, FileUploaderHelper $fileUploaderHelper, $id)
    {
        $agenda = KasIuranAgenda::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $agenda) {
            try {
                $agenda->updateFromRequest($request);
                $agenda->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $agenda->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        TrashHelper::moveToTrash($old->public_url);

                        $upload = $fileUploaderHelper->store($file, 'iuran-agenda/lampiran');
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
        return redirect(route('admin.kas-rt.kas-iuranagenda.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KasIuranAgenda::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
