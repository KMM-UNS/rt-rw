<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\IuranKondisional;
use App\Models\KasIuranKondisional;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use Barryvdh\DomPDF\Facade\Pdf;

class BayarKondisionalController extends Controller
{
    public function index()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $jenis_iuran = IuranKondisional::pluck('nama', 'id');
        $wargaa = Keluarga::with(['warga_kondisional' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        return view('pages.user.kepala-keluarga.index_kondisional', [
            'jenis_iuran' => $jenis_iuran,
            'wargaa' => $wargaa
        ]);
    }

    public function create()
    {
        // return view('pages.user.petugas.add-edit');
    }

    public function store(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $warga = Keluarga::with(['warga_kondisional' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $wargaa = KasIuranKondisional::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        return view('pages.user.kepala-keluarga.pdf_kondisional.filter', [
            'wargaa' => $wargaa,
            'warga' => $warga,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }

    public function status($id)
    {
        $wargaa = Keluarga::find($id);
        $wargaa->status = !$wargaa->status;
        $wargaa->save();
        return redirect()->back();
    }

    // public function cetak_denda()
    // {
    //     $wargaa = KasIuranKondisional::where('jenis_iuran_id', 1)->with('warga_wajib', 'iuranwajib')->get();
    //     $warga = KasIuranKondisional::where('jenis_iuran_id', 1)->with('warga_wajib', 'iuranwajib')->first();
    //     $total = KasIuranKondisional::where('jenis_iuran_id', 1)->sum('total_biaya');
    //     $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
    //     $pdf = PDF::loadView('pages.user.kepala-keluarga.pdf_wajib.warga_pdf_denda', ['wargaa' => $wargaa, 'warga' => $warga, 'total' => $total, 'data' => $data]);
    //     return $pdf->download('wajib_setor_iuran_denda.pdf');
    // }
    public function cetak_dendaronda($bulann, $tahunn)
    {
        $bulan = $bulann;
        $tahun = $tahunn;
        $warga = Keluarga::with(['warga_kondisional' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $warga1 = KasIuranKondisional::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
        $wargaa = KasIuranKondisional::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $total = KasIuranKondisional::where('jenis_iuran_id', 1)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('total_biaya');
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf =  PDF::loadView('pages.user.kepala-keluarga.pdf_sukarela.warga_pdf_dendaronda', ['wargaa' => $wargaa, 'warga' => $warga, 'warga1' => $warga1, 'total' => $total, 'data' => $data]);
        return $pdf->download('sukarela_setor_iuran_dendaronda.pdf');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
