<?php

namespace App\Http\Controllers\Admin\ManajemenKeuangan;

use App\Http\Controllers\Controller;
use App\Models\KasIuranAgenda;
use App\Models\KasIuranKondisional;
use App\Models\KasIuranSukaRela;
use Illuminate\Http\Request;
use App\Models\KasIuranWajib;
use App\Models\ManajemenPemasukan;

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
        // $pemasukann = new ManajemenPemasukan();

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
        // $pemasukann = new ManajemenPemasukan();
        // $pemasukann->keterangan = $request->input('keterangan');
        // $pemasukann->nominal = $request->input('nominal');
        // $pemasukann->save();
        return view('pages.admin.manajemen-keuangan.manajemen-pemasukan.index', ['total_wajib' => $total_wajib, 'total_agenda' => $total_agenda, 'pemasukan' => $pemasukan, 'pemasukann' => $pemasukann, 'pemasukannn' => $pemasukannn, 'total_kondisional' => $total_kondisional, 'total_sukarela' => $total_sukarela, 'keterangan' => $keterangan, 'nominal' => $nominal]);
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
