<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\IuranAgenda;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;

class BayarAgendaController extends Controller
{
    public function index()
    {
        $pos_tagihan = Pos::pluck('nama', 'id');
        $warga = Keluarga::all();
        $iuran_agenda = IuranAgenda::all();

        return view('pages.user.kepala-keluarga.index_agenda', ['pos_tagihan' => $pos_tagihan, 'warga' => $warga, 'iuran_agenda' => $iuran_agenda]);
    }

    public function create()
    {
        // return view('pages.user.petugas.add-edit');
    }

    public function store(Request $request)
    {
        $warga = Keluarga::all();
        return redirect(route('user.kepala-keluarga.bayar-iuranagenda.index_agenda'))->withToastSuccess('Data tersimpan', ['warga' => $warga]);
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
