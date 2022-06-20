<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;

class KepalaKeluargaController extends Controller
{

    public function index()
    {
        $warga = Keluarga::all();
        $pos_tagihan = Pos::pluck('nama', 'id');
        return view('pages.user.kepala-keluarga.index', ['warga' => $warga, 'pos_tagihan' => $pos_tagihan]);
    }


    public function create()
    {
        $warga = Keluarga::all();
        $pos_tagihan = Pos::pluck('nama', 'id');
        return view('pages.user.kepala-keluarga.index', ['warga' => $warga, 'pos_tagihan' => $pos_tagihan]);
    }


    public function store(Request $request)
    {
        $warga = Keluarga::create($request->all());
        // $warga->update($request->all());
        return redirect(route('user.kepala-keluarga.bayar-iuranwajib.index', ['warga' => $warga]));
    }

    public function changeMemberStatus(Request $request)
    {
        // DB::table('keluargas')->where('id', $request->id)->update(['status' => $request->status]);

        $warga = Keluarga::find($request->id);
        $warga->status = $request->status;
        $warga->save();
        // return response()->json(['success' => 'User status change successfully.']);
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
        $warga = Keluarga::findOrFail($id);
        $warga->update($request->all());
        return redirect(route('user.kepala-keluarga.bayar-iuranwajib.index', ['warga' => $warga]));
    }


    public function destroy($id)
    {
        //
    }
}
