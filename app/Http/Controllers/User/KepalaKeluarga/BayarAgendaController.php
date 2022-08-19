<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\IuranAgenda;
use App\Models\KasIuranAgenda;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class BayarAgendaController extends Controller
{
    public function index()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $jenis_iuran = IuranAgenda::pluck('nama', 'id');
        $wargaa = Keluarga::with(['warga_agenda' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();

        return view('pages.user.kepala-keluarga.index_agenda', [
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
        $warga = Keluarga::with(['warga_agenda' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $wargaa = KasIuranAgenda::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        return view('pages.user.kepala-keluarga.pdf_agenda.filter', [
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

    // public function cetak_halal()
    // {
    //     $wargaa = KasIuranAgenda::where('jenis_iuran_id', 1)->with('warga_agenda', 'iuranagenda')->get();
    //     $warga = KasIuranAgenda::where('jenis_iuran_id', 1)->with('warga_agenda', 'iuranagenda')->first();
    //     $total = KasIuranAgenda::where('jenis_iuran_id', 1)->sum('total_biaya');
    //     $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
    //     $pdf = PDF::loadView('pages.user.kepala-keluarga.pdf_agenda.warga_pdf_halal', ['wargaa' => $wargaa, 'warga' => $warga, 'total' => $total, 'data' => $data]);
    //     return $pdf->download('agenda_setor_iuran_halal.pdf');
    // }

    // public function cetak_hut()
    // {
    //     $wargaa = KasIuranAgenda::where('jenis_iuran_id', 2)->with('warga_agenda', 'iuranagenda')->get();
    //     $warga = KasIuranAgenda::where('jenis_iuran_id', 2)->with('warga_agenda', 'iuranagenda')->first();
    //     $total = KasIuranAgenda::where('jenis_iuran_id', 2)->sum('total_biaya');
    //     $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
    //     $pdf = PDF::loadView('pages.user.kepala-keluarga.pdf_agenda.warga_pdf_hut', ['wargaa' => $wargaa, 'warga' => $warga, 'total' => $total, 'data' => $data]);
    //     return $pdf->download('agenda_setor_iuran_hut.pdf');
    // }

    public function cetak_halal($bulann, $tahunn)
    {
        $bulan = $bulann;
        $tahun = $tahunn;
        $warga = Keluarga::with(['warga_agenda' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $warga1 = KasIuranAgenda::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
        $wargaa = KasIuranAgenda::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $total = KasIuranAgenda::where('jenis_iuran_id', 1)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('total_biaya');
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf =  PDF::loadView('pages.user.kepala-keluarga.pdf_agenda.warga_pdf_halal', ['wargaa' => $wargaa, 'warga' => $warga,  'warga1' => $warga1, 'total' => $total, 'data' => $data]);
        return $pdf->download('agenda_setor_iuran_halal.pdf');
    }

    public function ccetak_hut($bulann, $tahunn)
    {
        $bulan = $bulann;
        $tahun = $tahunn;
        $warga = Keluarga::with(['warga_agenda' => function ($query) use ($bulan, $tahun) {
            return $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();
        $warga1 = KasIuranAgenda::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
        $wargaa = KasIuranAgenda::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        $total = KasIuranAgenda::where('jenis_iuran_id', 2)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('total_biaya');
        $data = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $pdf =  PDF::loadView('pages.user.kepala-keluarga.pdf_agenda.warga_pdf_hut', ['wargaa' => $wargaa, 'warga' => $warga, 'warga1' => $warga1, 'total' => $total, 'data' => $data]);
        return $pdf->download('agenda_setor_iuran_hut.pdf');
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
