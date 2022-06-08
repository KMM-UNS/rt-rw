<?php

namespace App\Http\Controllers\Admin;

use App\Models\Surat;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Helpers\DataHelper;
use App\Models\StatusSurat;
use App\Helpers\TrashHelper;
use Illuminate\Http\Request;
use App\Models\KeperluanSurat;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDFCetak;
use App\DataTables\Admin\SuratDataTable;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SuratDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.surat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keperluan_surat = KeperluanSurat::pluck('nama', 'id');
        $status_surat = StatusSurat::pluck('nama', 'id');
        // mengambil data keluarga yang login
        // $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->with('surat')->first();
        $warga = Warga::pluck('nama', 'id');
        return view('pages.admin.surat.add', [
            'keperluan_surat' => $keperluan_surat,
            'status_surat' => $status_surat,
            // 'keluarga' => $keluarga,
            'warga' => $warga,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verifikasi($id, Request $request)
    {
        $surat = Surat::findOrFail($id);
        DB::transaction(function () use ($request, $surat) {
            try {
                    $surat->updateFromRequest($request);
                    $surat->save();

            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.surat.index'))->withInput()->withToastSuccess('success saving data');
    }

    public function cetak($id)
    {
        $pendaftar = Surat::findOrFail($id);
        $pdf = PDFCetak::loadview('pages.admin.surat.cetak', [
            'pendaftar' => $pendaftar
        ]);
        return $pdf->download('cetak_' . $pendaftar->no_pendaftaran . '.pdf');
    }
}
