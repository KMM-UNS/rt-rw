<?php

namespace App\Http\Controllers\Admin\ManajemenKeuangan;

use App\Http\Controllers\Controller;
use App\Models\KasIuranAgenda;
use App\Models\KasIuranKondisional;
use App\Models\KasIuranSukaRela;
use Illuminate\Http\Request;
use App\Models\KasIuranWajib;
use App\Models\ManajemenPemasukan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;

class ManajemenPemasukanController extends Controller
{

    public function index()
    {
        $total_wajib = KasIuranWajib::sum('total_biaya');
        $total_agenda = KasIuranAgenda::sum('total_biaya');
        $total_kondisional = KasIuranKondisional::sum('total_biaya');
        $total_sukarela = KasIuranSukaRela::sum('total_biaya');
        $pemasukannn = ManajemenPemasukan::sum('nominal');
        $pemasukan = $total_agenda + $total_wajib + $total_kondisional + $total_sukarela + $pemasukannn;
        $pemasukann = ManajemenPemasukan::all();

        return view('pages.admin.manajemen-keuangan.manajemen-pemasukan.index', ['total_wajib' => $total_wajib, 'total_agenda' => $total_agenda, 'pemasukan' => $pemasukan, 'total_kondisional' => $total_kondisional, 'total_sukarela' => $total_sukarela, 'pemasukann' => $pemasukann, 'pemasukannn' => $pemasukannn]);
    }


    public function create()
    {
        return view('pages.admin.manajemen-keuangan.manajemen-pemasukan.add-edit');
    }


    public function store(Request $request)
    {
        $total_wajib = KasIuranWajib::sum('total_biaya');
        $total_agenda = KasIuranAgenda::sum('total_biaya');
        $total_kondisional = KasIuranKondisional::sum('total_biaya');
        $total_sukarela = KasIuranSukaRela::sum('total_biaya');
        $pemasukannn = ManajemenPemasukan::sum('nominal');
        $pemasukan = $total_agenda + $total_wajib + $total_kondisional + $total_sukarela + $pemasukannn;
        $pemasukann = ManajemenPemasukan::all();
        $keterangan = $request->keterangan;
        $nominal = $request->nominal;

        ManajemenPemasukan::create($request->all());
        return redirect(route('admin.manajemen-keuangan.manajemen-pemasukan.index'))->withToastSuccess('Data tersimpan');
    }

    public function cetak_pdf()
    {
        $total_wajib = KasIuranWajib::sum('total_biaya');
        $total_agenda = KasIuranAgenda::sum('total_biaya');
        $total_kondisional = KasIuranKondisional::sum('total_biaya');
        $total_sukarela = KasIuranSukaRela::sum('total_biaya');
        $pemasukannn = ManajemenPemasukan::sum('nominal');
        $data = Dokumen::where('nama', 'foto_ttd_bendahara')->first();
        $pemasukan = $total_agenda + $total_wajib + $total_kondisional + $total_sukarela + $pemasukannn;
        $pemasukann = ManajemenPemasukan::all();

        $pdf = PDF::loadView('pages.admin.manajemen-keuangan.manajemen-pemasukan.pemasukan_pdf', [
            'total_wajib' => $total_wajib,
            'data' => $data,
            'total_agenda' => $total_agenda,
            'pemasukan' => $pemasukan,
            'pemasukann' => $pemasukann,
            'pemasukannn' => $pemasukannn,
            'total_kondisional' => $total_kondisional,
            'total_sukarela' => $total_sukarela,
        ]);
        return $pdf->download('laporan-pemasukan.pdf');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = ManajemenPemasukan::findOrFail($id);
        $pemasukannn = ManajemenPemasukan::sum('nominal');

        return view('pages.admin.manajemen-keuangan.manajemen-pemasukan.add-edit', [
            'data' => $data,
            'pemasukannn' => $pemasukannn,
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'keterangan' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = ManajemenPemasukan::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.manajemen-keuangan.manajemen-pemasukan.index'))->withToastSuccess('Data tersimpan');
    }



    public function destroy($id)
    {
        try {
            DB::table('manajemen_pemasukans')->where('id', $id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
        return redirect(route('admin.manajemen-keuangan.manajemen-pemasukan.index'))->withToastSuccess('Data terhapus');
    }
}
