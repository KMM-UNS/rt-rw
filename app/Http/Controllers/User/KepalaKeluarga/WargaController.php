<?php

namespace App\Http\Controllers\User\KepalaKeluarga;

use App\Http\Controllers\Controller;
use App\Models\KasIuranAgenda;
use App\Models\KasIuranKondisional;
use App\Models\KasIuranSukaRela;
use App\Models\KasIuranWajib;
use App\Models\Keluarga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wargaa = Keluarga::all();
        $total_wajib = KasIuranWajib::sum('total_biaya');
        $total_agenda = KasIuranAgenda::sum('total_biaya');
        $total_kondisional = KasIuranKondisional::sum('total_biaya');
        $total_sukarela = KasIuranSukaRela::sum('total_biaya');
        return view('pages.user.kepala-keluarga.warga.index', [
            'wargaa' => $wargaa,
            'total_wajib' => $total_wajib,
            'total_agenda' => $total_agenda,
            'total_kondisional' => $total_kondisional,
            'total_sukarela' => $total_sukarela
        ]);
    }

    public function wargah()
    {
        $wargaa = Keluarga::all();
        return view('wargaa', ['wargaa' => $wargaa]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
