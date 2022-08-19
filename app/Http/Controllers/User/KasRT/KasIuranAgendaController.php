<?php

namespace App\Http\Controllers\User\KasRT;

use App\Datatables\User\KasRT\KasIuranAgendaDataTable;
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
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Dokumen;
use App\Http\Requests\Admin\IuranAgendaForm;
use App\Models\Keluarga;
use Illuminate\Support\Facades\DB;


class KasIuranAgendaController extends Controller
{
    public function index(KasIuranAgendaDataTable $dataTable)
    {
        return $dataTable->render('pages.user.kas-rt.kasiuranagenda.index');
    }

    public function create()
    {
        $jenis_iuranagenda = IuranAgenda::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        $wargaa = KasIuranAgenda::all();

        return view('pages.user.kas-rt.kasiuranagenda.add-edit',  ['jenis_iuranagenda' => $jenis_iuranagenda, 'nama_petugas' => $nama_petugas, 'wargaa' => $wargaa, 'warga' => $warga]);
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
        return redirect(route('user.kas-rt.kas-iuranagenda.index'))->withToastSuccess('Data tersimpan');
    }

    public function cetak_pdf($id)
    {
        $warga = KasIuranAgenda::with(['iuranagenda', 'petugastagihan', 'postagihanagenda', 'warga_agenda'])->findOrFail($id);
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = PDF::loadView('pages.user.kas-rt.kasiuranagenda.agenda_pdf', ['warga' => $warga, 'data' => $data]);
        // $pdf = PDF::loadView('pages.user.kas-rt.kasiuranagenda.agenda_pdf', ['warga' => $warga]);
        return $pdf->download('agenda_buktipembayaran.pdf');
    }

    public function show($id)
    {
        //
    }

    public function edit($id, DataHelper $dataHelper)
    {
        $data = KasIuranAgenda::findOrFail($id);
        $jenis_iuranagenda = IuranAgenda::pluck('nama', 'id');
        $nama_petugas = PetugasTagihan::pluck('nama', 'id');
        $warga = Keluarga::pluck('warga', 'id');
        return view('pages.user.kas-rt.kasiuranagenda.add-edit', [
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
        return redirect(route('user.kas-rt.kas-iuranagenda.index'))->withToastSuccess('Data tersimpan');
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
