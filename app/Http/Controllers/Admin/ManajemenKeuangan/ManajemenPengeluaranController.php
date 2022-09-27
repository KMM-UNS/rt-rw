<?php

namespace App\Http\Controllers\Admin\ManajemenKeuangan;

use App\DataTables\Admin\ManajemenKeuangan\ManajemenPemasukanDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManajemenPengeluaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Helpers\FileUploaderHelper;
use App\Http\Requests\Admin\PengeluaranForm;
use App\Models\Dokumen;

class ManajemenPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pengeluarann = ManajemenPengeluaran::with('dokumen')->get();
        $pengeluarannn = ManajemenPengeluaran::sum('nominal');
        return view('pages.admin.manajemen-keuangan.manajemen-pengeluaran.index', ['pengeluarann' => $pengeluarann, 'pengeluarannn' => $pengeluarannn]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.manajemen-keuangan.manajemen-pengeluaran.add-edit');
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'keterangan' => 'required|min:3'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
    //     }

    //     try {
    //         ManajemenPengeluaran::create($request->all());
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError('Something went wrong');
    //     }

    //     return redirect(route('admin.manajemen-keuangan.manajemen-pengeluaran.index'))->withToastSuccess('Data tersimpan');
    // }
    public function store(PengeluaranForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                // dd($request->all());
                $pengeluaran = ManajemenPengeluaran::createFromRequest($request);
                $pengeluaran->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'pengeluaran/foto');
                        $pengeluaran->dokumen()->create([
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
        return redirect(route('admin.manajemen-keuangan.manajemen-pengeluaran.index'))->withToastSuccess('Data tersimpan');
    }

    public function cetak_pdf()
    {
        $pengeluarann = ManajemenPengeluaran::with('dokumen')->get();
        $pengeluarannn = ManajemenPengeluaran::sum('nominal');
        $data = Dokumen::where('nama', 'foto_ttd_bendahara')->first();
        $pdf = PDF::loadView('pages.admin.manajemen-keuangan.manajemen-pengeluaran.pengeluaran_pdf', ['pengeluarann' => $pengeluarann, 'pengeluarannn' => $pengeluarannn, 'data' => $data]);
        return $pdf->download('laporan-pengeluaran.pdf');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = ManajemenPengeluaran::with('dokumen')->findOrFail($id);
        $pengeluarannn = ManajemenPengeluaran::sum('nominal');

        return view('pages.admin.manajemen-keuangan.manajemen-pengeluaran.add-edit', [
            'data' => $data,
            'pengeluarannn' => $pengeluarannn,
        ]);
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $request->validate([
    //             'keterangan' => 'required|min:3'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
    //     }

    //     try {
    //         $data = ManajemenPengeluaran::findOrFail($id);
    //         $data->update($request->all());
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError('Something went wrong');
    //     }

    //     return redirect(route('admin.manajemen-keuangan.manajemen-pengeluaran.index'))->withToastSuccess('Data tersimpan');
    // }

    public function update(PengeluaranForm $request, FileUploaderHelper $fileUploaderHelper, $id)
    {
        $pengeluaran = ManajemenPengeluaran::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $pengeluaran) {
            try {
                $pengeluaran->updateFromRequest($request);
                $pengeluaran->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $pengeluaran->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        TrashHelper::moveToTrash($old->public_url);

                        $upload = $fileUploaderHelper->store($file, 'pengeluaran/lampiran');
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
        return redirect(route('admin.manajemen-keuangan.manajemen-pengeluaran.index'))->withToastSuccess('Data tersimpan');
    }



    public function destroy($id)
    {
        try {
            DB::table('manajemen_pengeluarans')->where('id', $id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
        return redirect(route('admin.manajemen-keuangan.manajemen-pengeluaran.index'))->withToastSuccess('Data terhapus');
    }
}
