<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\IuranKondisional;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;

class BayarKondisionalController extends Controller
{
    public function index()
    {
        $pos_tagihan = Pos::pluck('nama', 'id');
        $warga = Keluarga::all();
        $iuran_kondisional = IuranKondisional::all();

        return view('pages.user.kepala-keluarga.index_kondisional', ['pos_tagihan' => $pos_tagihan, 'warga' => $warga, 'iuran_kondisional' => $iuran_kondisional]);
    }

    public function create()
    {
        // return view('pages.user.petugas.add-edit');
    }

    public function store(Request $request)
    {
        $warga = Keluarga::all();
        return redirect(route('user.kepala-keluarga.bayar-iurankondisional.index_kondisional'))->withToastSuccess('Data tersimpan', ['warga' => $warga]);
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
