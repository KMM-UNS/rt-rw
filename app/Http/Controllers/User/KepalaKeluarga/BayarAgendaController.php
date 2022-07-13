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
        // return 'berhasil';
        $pos_tagihan = Pos::pluck('nama', 'id');
        // $wargaa = Keluarga::with(['pemberii'])->get();
        $wargaa = Keluarga::with(['warga_agenda'])->get();
        $iuran_agenda = IuranAgenda::all();

        return view('pages.user.kepala-keluarga.index_agenda', ['pos_tagihan' => $pos_tagihan, 'wargaa' => $wargaa, 'iuran_agenda' => $iuran_agenda]);
    }

    public function create()
    {
        // return view('pages.user.petugas.add-edit');
    }

    public function store(Request $request)
    {
        $wargaa = Keluarga::all();
        return redirect(route('user.kepala-keluarga.bayar-iuranagenda.index_agenda'))->withToastSuccess('Data tersimpan', ['wargaa' => $wargaa]);
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
