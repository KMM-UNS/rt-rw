<?php

namespace App\Http\Controllers\User;

use App\Models\Dokumen;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use App\Models\KasIuranWajib;
use App\Models\KasIuranAgenda;
use App\Models\KasIuranSukaRela;
use App\Models\KasIuranKondisional;
use Barryvdh\DomPDF\Facade\Pdf as PDFCetak;
use App\Http\Controllers\Controller;

class KasController extends Controller
{
    function __construct()
    {
        $this->middleware('warga')->except('index');
    }

    public function index()
    {
        $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->first();
        if ($keluarga == null)
        {
            return view('pages.user.kas.index', [
                'keluarga' => $keluarga,
            ]);
        }
        else
        {
            $bulan = date('m');
            $tahun = date('Y');
            $warga1 = KasIuranWajib::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
            $id_keluarga = Keluarga::where('createable_id', auth()->user()->id)->first()->id;
            $data1 = KasIuranWajib::where('warga', $id_keluarga)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
            $data2 = KasIuranSukaRela::where('warga', $id_keluarga)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
            $data3 = KasIuranKondisional::where('warga', $id_keluarga)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
            $data4 = KasIuranAgenda::where('warga', $id_keluarga)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();

            return view('pages.user.kas.index', [
                'data1' => $data1,
                'warga1' => $warga1,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4,
            ]);
        }

    }

    public function status($id)
    {
        $data = Keluarga::find($id);
        $data->status = !$data->status;
        $data->save();
        return redirect()->back();
    }

    public function create()
    {
        //
    }

    public function cetak_pdf_wajib()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $warga = KasIuranWajib::with(['iuranwajib', 'petugastagihan', 'postagihanwajib', 'warga_wajib'])->where('warga', $id_keluarga)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $wargaa = KasIuranWajib::with(['iuranwajib', 'petugastagihan', 'postagihanwajib', 'warga_wajib'])->where('warga', $id_keluarga)->first();
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = PDFCetak::loadView('warga_pdf_wajib', ['wargaa' => $wargaa, 'warga' => $warga, 'data' => $data]);
        return $pdf->download('wajib_buktipembayaranwarga.pdf');
    }

    public function cetak_pdf_sukarela()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $warga = KasIuranSukaRela::with(['iuransukarela', 'petugastagihan', 'postagihansukarela', 'warga_sukarela'])->where('warga', $id_keluarga)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $wargaa = KasIuranSukaRela::with(['iuransukarela', 'petugastagihan', 'postagihansukarela', 'warga_sukarela'])->where('warga', $id_keluarga)->first();
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = PDFCetak::loadView('warga_pdf_sukarela', ['wargaa' => $wargaa, 'warga' => $warga, 'data' => $data]);
        return $pdf->download('sukarela_buktipembayaranwarga.pdf');
    }

    public function cetak_pdf_kondisional()
    {
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $warga = KasIuranKondisional::with(['iurankondisional', 'petugastagihan', 'postagihankondisional', 'warga_kondisional'])->where('warga', $id_keluarga)->get();
        $wargaa = KasIuranKondisional::with(['iurankondisional', 'petugastagihan', 'postagihankondisional', 'warga_kondisional'])->where('warga', $id_keluarga)->first();
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = PDFCetak::loadView('warga_pdf_kondisional', ['wargaa' => $wargaa, 'warga' => $warga, 'data' => $data]);
        return $pdf->download('kondisional_buktipembayaranwarga.pdf');
    }

    public function cetak_pdf_agenda()
    {
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $warga = KasIuranAgenda::with(['iuranagenda', 'petugastagihan', 'postagihanagenda', 'warga_agenda'])->where('warga', $id_keluarga)->get();
        $wargaa = KasIuranAgenda::with(['iuranagenda', 'petugastagihan', 'postagihanagenda', 'warga_agenda'])->where('warga', $id_keluarga)->first();
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf = PDFCetak::loadView('warga_pdf_agenda', ['wargaa' => $wargaa, 'warga' => $warga, 'data' => $data]);
        return $pdf->download('agenda_buktipembayaranwarga.pdf');
    }

    public function store(Request $request)
    {
        $warga = Keluarga::all();
        return view('pages.user.home', ['keluarga' => $warga]);
    }
}
