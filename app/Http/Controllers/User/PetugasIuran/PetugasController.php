<?php

namespace App\Http\Controllers\User\PetugasIuran;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\PetugasTagihan;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PetugasTagihan::where('petugas_id', auth()->user()->id)->first()->id;
        $data1 = PetugasTagihan::where('id', $data)->with('poss')->get();
        // $data1 = PetugasTagihan::where('petugas_id', auth()->user()->id)->first()->id;

        // $data1 = KasIuranWajib::where('warga', $id_petugas)->get();
        // return view('pages.user.petugas.index', ['data' => $data, 'data1' => $data1]);
        return view('pages.user.petugas.index', ['data' => $data, 'data1' => $data1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.petugas.add-edit');
    }
    // return view('pages.user.petugas.add-edit');


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data1 = PetugasTagihan::findOrFail($id);
        // $pengeluarannn = ManajemenPengeluaran::sum('nominal');

        return view('pages.user.petugas.add-edit', [
            'data1' => $data1,
        ]);
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
