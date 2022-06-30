<?php

namespace App\Http\Controllers\Admin\RekapIuran;

use App\Datatables\Admin\RekapIuran\ActionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasIuranAgenda;
use App\Models\IuranAgenda;
use App\Models\Tahun;
use App\Models\Bulan;
use App\Models\KasIuranWajib;
use App\Models\Keluarga;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class RekapIuranAgendaController extends Controller
{
    public function index()
    {
        $jenis_iuran = IuranAgenda::pluck('nama', 'id');
        $nama_bulans = Bulan::pluck('nama', 'id');
        $tahun = Tahun::pluck('nama', 'id');
        return view('pages.admin.rekap-kas.rekapiuranagenda.index', ['jenis_iuran' => $jenis_iuran, 'nama_bulans' => $nama_bulans, 'tahun' => $tahun]);
    }

    // public function coba(ActionDataTable $dataTable)
    // {
    //     return $dataTable->render('pages.admin.kas-rt.kasiuranwajib.detail');
    // }


    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $total = KasIuranAgenda::where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get()->sum('total_biaya');

        $rekap = KasIuranAgenda::with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'namabulanss', 'tahuns')->where('jenis_iuran_id', $jenis_iuran)->where('bulan', $bulan)->where('tahun', $tahun)->get();
        return view('pages.admin.rekap-kas.rekapiuranagenda.detail', ['rekap' => $rekap, 'total' => $total]);
    }

    // public function cetakForm()
    // {
    //     return view('pages.admin.rekap-kas.rekapiuranagenda.index');
    // }

    public function cetakRekapAgendaPertanggal(Request $request, $tglawal, $tglakhir)
    {
        // dd(["Tanggal Awal :" . $tglawal, "Tanggal Akhir :" . $tglakhir]);
        $agenda = KasIuranWajib::all();
        // $pos = Keluarga::where('id', $agenda->pemberi)->first()->pos;

        // dd($pos->petugastagihan->nama);
        // $petugas = PetugasTagihan::select('pos')->where('id', $agenda->petugas)->first()->pos;

        // $pos = Pos::where('id', $petugas)->first()->nama;
        // // dd($pos);
        // $agenda->pos = $pos->nama;
        // $agenda->petugas = $pos->petugastagihan->nama;
        // $total = KasIuranAgenda::where('jenis_iuran_id', $jenis_iuran)->get()->sum('total_biaya');
        $total = KasIuranAgenda::sum('total_biaya');
        $cetakrekapagenda = KasIuranAgenda::with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'pemberii')->whereBetween('tanggal', [$tglawal, $tglakhir])->latest()->get();
        return view('pages.admin.rekap-kas.rekapiuranagenda.cetak', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total], compact('cetakrekapagenda'));
    }

    public function cetak_pdf()
    {
        return 'berhasil';
        // $agenda = KasIuranWajib::all();
        // $total = KasIuranAgenda::sum('total_biaya');
        // $cetakrekapagenda = KasIuranAgenda::with('iuranagenda', 'jenisiuranagenda', 'petugastagihan', 'pemberii')->get();
        // $pdf = PDF::loadView('pages.admin.rekap-kas.rekapiuranagenda.cetak', ['cetakrekapagenda' => $cetakrekapagenda, 'total' => $total], compact('cetakrekapagenda'));
        // return $pdf->download('laporan-pengeluaran.pdf');
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
