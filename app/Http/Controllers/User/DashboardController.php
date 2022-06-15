<?php

namespace App\Http\Controllers\User;


use App\Models\App;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\JadwalRonda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $app = App::first();
        if(auth()->user()->hasRole('regular_user')){
            $keluarga = Keluarga::select('id')->where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->first();
            // jika sudah mengisi data keluarga
            if(isset($keluarga)) {
                // jika sudah mengisi data warga
                $warga = Warga::select('id')->where('keluarga_id', $keluarga->id)->where('status_keluarga_id', '1')->first();
                if(isset($warga)){
                    $jadwal = JadwalRonda::where('warga_id', $warga->id)->first();
                    
                    return view('pages.user.dashboard.index', [
                        'jadwal' => $jadwal,
                        'app' => $app
                    ]);
                }
            }
            return view('pages.user.dashboard.index', [
                'app' => $app
            ]);
    
        }
        else {
            return redirect(route('admin.dashboard'));
        }
    }
}
