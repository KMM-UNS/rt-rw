<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\App;
use App\Models\Surat;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Helpers\DataHelper;
use App\Models\StatusSurat;
use Illuminate\Support\Str;
use App\Helpers\TrashHelper;
use Illuminate\Http\Request;
use App\Models\KeperluanSurat;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\SuratDataTable;
use App\Http\Requests\Admin\SuratForm;
use Barryvdh\DomPDF\Facade\Pdf as PDFCetak;
use HnhDigital\LaravelNumberConverter\Facade as NumConvert;


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
        return view('pages.admin.surat.add-edit', [
            'keperluan_surat' => $keperluan_surat,
            'status_surat' => $status_surat,
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
        DB::transaction(function () use ($request) {
            try {
                // dd($request->all());
                // Generate Kode Surat
                // kode
                $kode = Str::of("0")->append($request->surat_keperluan_surat_id);

                // jumlah surat
                $surat = Surat::where('keperluan_surat_id', $request->surat_keperluan_surat_id)->count();
                $jumlah = (strlen($surat + 1) == 1) ? substr_replace("000", $surat + 1,2) : ( (strlen($surat + 1) == 2) ? substr_replace("000", $surat + 1, 1) : substr_replace("000", $surat + 1, 0)) ;

                // nama lembaga
                $lembaga = "RT-RW";

                //bulan
                // $date = Carbon::now()->format('m');
                $int = (int) Carbon::now()->format('m');
                $bulan = NumConvert::roman($int);

                // tahun
                $tahun = Carbon::now()->format('Y');

                // menggabungkan variabel yang sudah dibuat
                $nomor_surat = "{$kode}.{$jumlah}/{$lembaga}/{$bulan}/{$tahun}";


                $surat = Surat::createFromRequest($request);
                $surat->createable()->associate($request->user());
                $surat->nomor_surat = $nomor_surat;
                $surat->tanggal_pengajuan = Carbon::now()->format('Y-m-d');
                $surat->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.surat.index'))->withInput()->withToastSuccess('Data tersimpan');
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
        // return view('pages.admin.surat.add-edit');
        $data = Surat::findOrFail($id);
        // dd($data);
        $keperluan_surat = KeperluanSurat::pluck('nama', 'id');
        $status_surat = StatusSurat::pluck('nama', 'id');
        // mengambil data keluarga yang login
        // $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->with('surat')->first();
        $warga = Warga::pluck('nama', 'id');
        return view('pages.admin.surat.add-edit', [
            'data' => $data,
            'keperluan_surat' => $keperluan_surat,
            'status_surat' => $status_surat,
            'warga' => $warga,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratForm $request, $id)
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
        return redirect(route('admin.surat.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Surat::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function verifikasi($id, Request $request)
    {
        $surat = Surat::findOrFail($id);
        DB::transaction(function () use ($request, $surat) {
            try {

                $surat->updateFromRequest($request);
                if ($surat->status == 4 ) {
                    $tanggal_disetujui = Carbon::now()->format('Y-m-d');
                    $surat->tanggal_disetujui = $tanggal_disetujui;
                }
                $surat->save();

            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.surat.index'))->withInput()->withToastSuccess('Surat Terverifikasi');
    }

    public function cetak($id)
    {
        $surat = Surat::findOrFail($id);
        $app = App::first();
        // dd($app->dokumen->where('nama', 'ttd_rw'));
        $pdf = PDFCetak::loadview('pages.admin.surat.cetak', [
            'surat' => $surat,
            'app' => $app,
            'ttd_rt'=> $app->dokumen->where('nama', 'ttd_rt'),
            'ttd_rw'=> $app->dokumen->where('nama', 'ttd_rw')
        ]);
        return $pdf->download('cetak_' . $surat->nomor_surat . '.pdf');
    }
}
