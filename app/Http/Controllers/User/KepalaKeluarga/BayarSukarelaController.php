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
        $warga = Keluarga::all();
        $iuran_sukarela = IuranSukarela::all();

        return view('pages.user.kepala-keluarga.index_sukarela', ['pos_tagihan' => $pos_tagihan, 'warga' => $warga, 'iuran_sukarela' => $iuran_sukarela]);
    }

    public function create()
    {
        // return view('pages.user.petugas.add-edit');
    }

    public function store(Request $request)
    {
        $jenis_iuran = $request->jenis_iuran_id;
        $status_bayar = KasIuranAgenda::with('iuranagenda')->where('jenis_iuran_id', $jenis_iuran)->get();
        $warga = Keluarga::all();
        // $warga = Keluarga::with();
        return redirect(route('user.kepala-keluarga.bayar-iuransukarela.index_sukarela'))->withToastSuccess('Data tersimpan', ['warga' => $warga, 'status_bayar' => $status_bayar]);
    }

    public function status($id)
    {
        $warga = Keluarga::find($id);
        $warga->status = !$warga->status;
        $warga->save();
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
