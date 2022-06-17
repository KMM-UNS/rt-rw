<?php

namespace App\Http\Controllers\User\Warga;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pos_tagihan = Pos::pluck('nama', 'id');
        return view('pages.user.kepala-keluarga.index', ['pos_tagihan' => $pos_tagihan]);
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
        return view('pages.user.home', ['keluarga' => $warga]);
    }

    public function changeMemberStatus(Request $request)
    {
        $warga = Keluarga::find($request->id);
        $warga->status = $request->status;
        $warga->save();
        return response()->json(['success' => 'User status change successfully.']);
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
