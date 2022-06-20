<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;

class KeluargaaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pos_tagihan = Pos::pluck('nama', 'id');
        $warga = Keluarga::all();
        return view('pages.user.kepala-keluarga.index', ['pos_tagihan' => $pos_tagihan, 'warga' => $warga]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $warga = Keluarga::all();
        return redirect(route('user.kepala-keluarga.bayar-iuranwajib.index'))->withToastSuccess('Data tersimpan', ['warga' => $warga]);
    }

    public function status($id)
    {
        // $warga = Keluarga::where('id', $id)->first();
        // $status_sekarang = $warga->status;

        // if ($status_sekarang == 1) {
        //     Keluarga::where('id', $id)->update(['status' => 0]);
        // } else {
        //     Keluarga::where('id', $id)->update(['status' => 1]);
        // }
        // //   Session::flash('sukses','status berhasil di ubah');
        // return redirect(route('user.kepala-keluarga.bayar-iuranwajib.index'));

        $warga = Keluarga::find($id);
        $warga->status = !$warga->status;
        $warga->save();
        return redirect()->back();
        // return redirect(route('user.kepala-keluarga.bayar-iuranwajib.index'));
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
