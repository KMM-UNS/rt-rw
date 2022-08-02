<?php

namespace App\Http\Controllers\User\StatusIuranWarga;

use App\Http\Controllers\Controller;
use App\Models\IuranAgenda;
use App\Models\IuranKondisional;
use App\Models\IuranSukarela;
use App\Models\IuranWajib;
use App\Models\KasIuranAgenda;
use App\Models\KasIuranKondisional;
use App\Models\KasIuranSukaRela;
use App\Models\KasIuranWajib;
use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class WargaController extends Controller
{

    public function index()
    {
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $data1 = KasIuranWajib::where('warga', $id_keluarga)->get();
        $data2 = KasIuranSukaRela::where('warga', $id_keluarga)->get();
        $data3 = KasIuranKondisional::where('warga', $id_keluarga)->get();
        $data4 = KasIuranAgenda::where('warga', $id_keluarga)->get();

        return view('wargaa', [
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
        ]);
    }

    public function status($id)
    {
        $data = Keluarga::find($id);
        $data->status = !$data->status;
        $data->save();
        return redirect()->back();
    }

    public function create()
    {
        //
    }

    public function cetak_pdf_wajib()
    {
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $warga = KasIuranWajib::with(['iuranwajib', 'petugastagihan', 'postagihanwajib', 'warga_wajib'])->where('warga', $id_keluarga)->get();
        $wargaa = KasIuranWajib::with(['iuranwajib', 'petugastagihan', 'postagihanwajib', 'warga_wajib'])->where('warga', $id_keluarga)->first();
        $pdf = PDF::loadView('warga_pdf_wajib', ['warga' => $warga, 'wargaa' => $wargaa]);
        return $pdf->download('wajib_buktipembayaranwarga.pdf');
    }

    public function cetak_pdf_sukarela()
    {
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $warga = KasIuranSukaRela::with(['iuransukarela', 'petugastagihan', 'postagihansukarela', 'warga_sukarela'])->where('warga', $id_keluarga)->get();
        $wargaa = KasIuranSukaRela::with(['iuransukarela', 'petugastagihan', 'postagihansukarela', 'warga_sukarela'])->where('warga', $id_keluarga)->first();
        $pdf = PDF::loadView('warga_pdf', ['warga' => $warga, 'wargaa' => $wargaa]);
        return $pdf->download('sukarela_buktipembayaranwarga.pdf');
    }

    public function cetak_pdf_kondisional()
    {
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $warga = KasIuranKondisional::with(['iurankondisional', 'petugastagihan', 'postagihankondisional', 'warga_kondisional'])->where('warga', $id_keluarga)->get();
        $wargaa = KasIuranKondisional::with(['iurankondisional', 'petugastagihan', 'postagihankondisional', 'warga_kondisional'])->where('warga', $id_keluarga)->first();
        $pdf = PDF::loadView('warga_pdf_kondisional', ['warga' => $warga, 'wargaa' => $wargaa]);
        return $pdf->download('kondisional_buktipembayaranwarga.pdf');
    }

    public function cetak_pdf_agenda()
    {
        $id_keluarga = Keluarga::where('user_id', auth()->user()->id)->first()->id;
        $warga = KasIuranAgenda::with(['iuranagenda', 'petugastagihan', 'postagihanagenda', 'warga_agenda'])->where('warga', $id_keluarga)->get();
        $wargaa = KasIuranAgenda::with(['iuranagenda', 'petugastagihan', 'postagihanagenda', 'warga_agenda'])->where('warga', $id_keluarga)->first();
        $pdf = PDF::loadView('warga_pdf_agenda', ['warga' => $warga, 'wargaa' => $wargaa]);
        return $pdf->download('agenda_buktipembayaranwarga.pdf');
    }

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
