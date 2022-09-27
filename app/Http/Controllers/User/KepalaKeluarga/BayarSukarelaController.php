<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\IuranSukarela;
use App\Models\KasIuranAgenda;
use App\Models\KasIuranSukaRela;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use Barryvdh\DomPDF\Facade\Pdf;

class BayarSukarelaController extends Controller
{
    public function index()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $jenis_iuran = IuranSukarela::pluck('nama', 'id');
        $wargaa = Keluarga::with(['warga_sukarela' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();

        return view('pages.user.kepala-keluarga.index_sukarela', [
            'jenis_iuran' => $jenis_iuran,
            'wargaa' => $wargaa
        ]);
    }

    // public function cetak_pendidikan()
    // {
    //     $wargaa = KasIuranSukaRela::where('jenis_iuran_id', 1)->with('warga_sukarela', 'iuransukarela')->get();
    //     $warga = KasIuranSukaRela::where('jenis_iuran_id', 1)->with('warga_sukarela', 'iuransukarela')->first();
    //     $total = KasIuranSukaRela::where('jenis_iuran_id', 1)->sum('total_biaya');
    //     $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
    //     $pdf = PDF::loadView('pages.user.kepala-keluarga.pdf_sukarela.warga_pdf_pendidikan', ['wargaa' => $wargaa, 'warga' => $warga, 'total' => $total, 'data' => $data]);
    //     return $pdf->download('sukarela_setor_iuran_pendidikan.pdf');
    // }

    // public function cetak_arisan()
    // {
    //     $wargaa = KasIuranSukaRela::where('jenis_iuran_id', 2)->with('warga_sukarela', 'iuransukarela')->get();
    //     $warga = KasIuranSukaRela::where('jenis_iuran_id', 2)->with('warga_sukarela', 'iuransukarela')->first();
    //     $total = KasIuranSukaRela::where('jenis_iuran_id', 2)->sum('total_biaya');
    //     $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
    //     $pdf = PDF::loadView('pages.user.kepala-keluarga.pdf_sukarela.warga_pdf_arisan', ['wargaa' => $wargaa, 'warga' => $warga, 'total' => $total, 'data' => $data]);
    //     return $pdf->download('sukarela_setor_iuran_arisan.pdf');
    // }

    public function create()
    {
        // return view('pages.user.petugas.add-edit');
    }

    public function store(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $warga = Keluarga::with(['warga_sukarela' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $wargaa = KasIuranSukaRela::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        return view('pages.user.kepala-keluarga.pdf_sukarela.filter', [
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

    public function cetak_pendidikan($bulann, $tahunn)
    {
        $bulan = $bulann;
        $tahun = $tahunn;
        $warga = Keluarga::with(['warga_sukarela' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $warga1 = KasIuranSukaRela::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
        $wargaa = KasIuranSukaRela::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $total = KasIuranSukaRela::where('jenis_iuran_id', 1)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('total_biaya');
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf =  PDF::loadView('pages.user.kepala-keluarga.pdf_sukarela.warga_pdf_pendidikan', ['wargaa' => $wargaa, 'warga' => $warga, 'warga1' => $warga1, 'total' => $total, 'data' => $data]);
        return $pdf->download('sukarela_setor_iuran_pendidikan.pdf');
    }

    public function cetak_arisan($bulann, $tahunn)
    {
        $bulan = $bulann;
        $tahun = $tahunn;
        $warga = Keluarga::with(['warga_sukarela' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $warga1 = KasIuranSukaRela::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
        $wargaa = KasIuranSukaRela::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $total = KasIuranSukaRela::where('jenis_iuran_id', 2)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('total_biaya');
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf =  PDF::loadView('pages.user.kepala-keluarga.pdf_sukarela.warga_pdf_arisan', ['wargaa' => $wargaa, 'warga' => $warga, 'warga1' => $warga1, 'total' => $total, 'data' => $data]);
        return $pdf->download('sukarela_setor_iuran_arisan.pdf');
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
