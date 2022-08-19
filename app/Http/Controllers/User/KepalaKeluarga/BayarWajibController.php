<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use Carbon\Carbon;
use App\Models\Pos;
use App\Models\Dokumen;
use App\Models\Keluarga;
use App\Models\IuranWajib;
use Illuminate\Http\Request;
use App\Models\KasIuranWajib;
use Barryvdh\Snappy\Facade\Pdf;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Barryvdh\Snappy\Facades\SnappyPdf;

class BayarWajibController extends Controller
{
    public function index()
    {
        $bulan = date('m');
        $tahun = date('Y');
        // dd($month);
        $jenis_iuran = IuranWajib::pluck('nama', 'id');
        $wargaa = Keluarga::with(['warga_wajib' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $bulan7 = KasIuranWajib::where('tanggal');

        return view('pages.user.kepala-keluarga.index_wajib', [
            'jenis_iuran' => $jenis_iuran,
            'wargaa' => $wargaa,
            'bulan7' => $bulan7,
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
        $warga = Keluarga::with(['warga_wajib' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $wargaa = KasIuranWajib::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        return view('pages.user.kepala-keluarga.pdf_wajib.filter', [
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

    public function cetak_sosial($bulann, $tahunn)
    {
        $bulan = $bulann;
        $tahun = $tahunn;
        $warga = Keluarga::with(['warga_wajib' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $warga1 = KasIuranWajib::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
        $wargaa = KasIuranWajib::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $total = KasIuranWajib::where('jenis_iuran_id', 7)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('total_biaya');
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = FacadePdf::loadView('pages.user.kepala-keluarga.pdf_wajib.warga_pdf_sosial', ['wargaa' => $wargaa, 'warga' => $warga, 'warga1' => $warga1, 'total' => $total, 'data' => $data]);
        return $pdf->download('wajib_setor_iuran_sosial.pdf');
    }

    public function cetak_kebersihan($bulann, $tahunn)
    {
        $bulan = $bulann;
        $tahun = $tahunn;
        $warga = Keluarga::with(['warga_wajib' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $warga1 = KasIuranWajib::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
        $wargaa = KasIuranWajib::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $total = KasIuranWajib::where('jenis_iuran_id', 8)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('total_biaya');
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = FacadePdf::loadView('pages.user.kepala-keluarga.pdf_wajib.warga_pdf_kebersihan', ['wargaa' => $wargaa, 'warga' => $warga, 'warga1' => $warga1, 'total' => $total, 'data' => $data, 'bulan' => $bulan, 'tahun' => $tahun]);
        return $pdf->download('wajib_setor_iuran_kebersihan.pdf');
    }

    public function detaill()
    {
        return ('berhasil');
        // return view('pages.user.kepala-keluarga.detail_wajib');
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
