<?php

namespace App\Http\Controllers\User;

use App\Models\Surat;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\JenisSurat;
use App\Models\StatusSurat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KeperluanSurat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\JenisSuratKeterangan;
use App\Http\Requests\Admin\SuratForm;
use HnhDigital\LaravelNumberConverter\Facade as NumConvert;

class SuratController extends Controller
{
    function __construct()
    {
        $this->middleware('warga')->except('index');
    }

    public function index()
    {
        // mengambil data keluarga yang login
        $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->with('rumah')->first();
        $warga = Warga::where('keluarga_id', $keluarga->id)->pluck('nama', 'id');
        return view('pages.user.surat.index', [
            'keluarga' => $keluarga,
            'warga' => $warga,
        ]);
    }

    public function create()
    {
        $keperluan_surat = KeperluanSurat::pluck('nama', 'id');
        $status_surat = StatusSurat::pluck('nama', 'id');
        // mengambil data keluarga yang login
        $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->with('rumah')->first();
        $warga = Warga::where('keluarga_id', $keluarga->id)->pluck('nama', 'id');
        return view('pages.user.surat.add', [
            'keperluan_surat' => $keperluan_surat,
            'status_surat' => $status_surat,
            'keluarga' => $keluarga,
            'warga' => $warga,
        ]);
    }

    public function store(SuratForm $request)
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
                $surat->nomor_surat = $nomor_surat;
                $surat->tanggal_pengajuan = Carbon::now()->format('Y-m-d');
                $surat->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('user.surat.index'))->withInput()->withToastSuccess('Data tersimpan');
    }
}
