<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\IuranSukarela;
use App\Models\KasIuranAgenda;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;

class BayarSukarelaController extends Controller
{
    public function index()
    {
        $pos_tagihan = Pos::pluck('nama', 'id');
        $wargaa = Keluarga::with(['warga_sukarela'])->get();
        $iuran_sukarela = IuranSukarela::all();

        return view('pages.user.kepala-keluarga.index_sukarela', [
            'pos_tagihan' => $pos_tagihan,
            'wargaa' => $wargaa,
            'iuran_sukarela' => $iuran_sukarela
        ]);
    }

    public function create()
    {
        // return view('pages.user.petugas.add-edit');
    }

    public function store(Request $request)
    {
        $wargaa = Keluarga::all();
        return redirect(route('user.kepala-keluarga.bayar-iuransukarela.index_sukarela'))->withToastSuccess('Data tersimpan', ['wargaa' => $wargaa]);
    }

    public function status($id)
    {
        $wargaa = Keluarga::find($id);
        $wargaa->status = !$wargaa->status;
        $wargaa->save();
        return redirect()->back();
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
