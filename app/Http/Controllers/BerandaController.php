<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Rumah;
use App\Models\Surat;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\KritikSaran;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $app = App::first();
        $warga = Warga::count();
        $keluarga = Keluarga::count();
        $surat = Surat::where('status', '!=', '1')->count();
        $rumah = Rumah::count();
        // dd($keluarga);
        return view('home',[
            'app' => $app,
            'warga' => $warga,
            'keluarga' => $keluarga,
            'surat' => $surat,
            'rumah' => $rumah,
            ]);
    }

    public function store(Request $request)
    {
        try {
            KritikSaran::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('beranda.index'))->withToastSuccess('Kritik/saran terkirim');
    }
}
