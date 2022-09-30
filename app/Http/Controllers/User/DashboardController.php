<?php

namespace App\Http\Controllers\User;


use App\Models\App;
use App\Models\Warga;
use App\Models\Dokumen;
use App\Models\Keluarga;
use App\Models\JadwalRonda;
use Illuminate\Http\Request;
use App\Models\PetugasTagihan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $app = App::first();
        if(auth()->user()->hasRole('warga')){
            $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->first();
            // jika sudah mengisi data keluarga
            if(isset($keluarga)) {
                // jika sudah mengisi data warga
                $warga = Warga::select('id')->where('keluarga_id', $keluarga->id)->where('status_keluarga_id', '1')->where('status_warga_id', 1)->first();
                if(isset($warga)){
                    $jadwal = JadwalRonda::whereHas('ronda', function ($query){
                        return $query->where('status', 'aktif');
                    })->where('warga_id', $warga->id)->first();

                    return view('pages.user.dashboard.index', [
                        'keluarga' => $keluarga,
                        'jadwal' => $jadwal,
                        'app' => $app
                    ]);
                }
            }
            return view('pages.user.dashboard.index', [
                'app' => $app,
                'keluarga' => $keluarga,
            ]);

        }
        // else if (auth()->user()->hasRole('petugas_iuran')) {
        //     $data = PetugasTagihan::with(['poss'])->where('user_id', auth()->user()->id)->first();
        // // $data1 = PetugasTagihan::where('id', $data)->with('poss')->get();
        // $data3 = Dokumen::where('nama', 'foto_petugas')->first();
        // $data4 = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        // $data2 = Keluarga::where('id', auth()->user()->id)->first();
        // return view('pages.user.petugas.index', [
        //     'data' => $data,
        //     // 'data1' => $data1,
        //     'data2' => $data2,
        //     'data3' => $data3,
        //     'data4' => $data4
        // ]);
        // }
        else {
            return redirect(route('admin.dashboard'));
        }
    }
}
