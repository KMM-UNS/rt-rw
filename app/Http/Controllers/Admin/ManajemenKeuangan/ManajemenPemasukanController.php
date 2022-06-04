<?php

namespace App\Http\Controllers\Admin\ManajemenKeuangan;

use App\Http\Controllers\Controller;
use App\Models\KasIuranAgenda;
use App\Models\KasIuranKondisional;
use App\Models\KasIuranSukaRela;
use Illuminate\Http\Request;
use App\Models\KasIuranWajib;

class ManajemenPemasukanController extends Controller
{

    public function index()
    {
        $total_wajib = KasIuranWajib::sum('total_biaya');
        $total_agenda = KasIuranAgenda::sum('total_biaya');
        $total_kondisional = KasIuranKondisional::sum('total_biaya');
        $total_sukarela = KasIuranSukaRela::sum('total_biaya');
        $pemasukan = $total_agenda + $total_wajib + $total_kondisional + $total_sukarela;
        return view('pages.admin.manajemen-keuangan.manajemen-pemasukan.index', ['total_wajib' => $total_wajib, 'total_agenda' => $total_agenda, 'pemasukan' => $pemasukan, 'total_kondisional' => $total_kondisional, 'total_sukarela' => $total_sukarela]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $total_wajib = KasIuranWajib::sum('total_biaya');
        $total_agenda = KasIuranAgenda::sum('total_biaya');
        $total_kondisional = KasIuranKondisional::sum('total_biaya');
        $total_sukarela = KasIuranSukaRela::sum('total_biaya');
        $pemasukan = $total_agenda + $total_wajib;
        return view('pages.admin.manajemen-keuangan.manajemen-pemasukan.index', ['total_wajib' => $total_wajib, 'total_agenda' => $total_agenda, 'pemasukan' => $pemasukan, 'total_kondisional' => $total_kondisional, 'total_sukarela' => $total_sukarela]);
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
