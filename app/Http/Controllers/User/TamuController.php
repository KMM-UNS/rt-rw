<?php

namespace App\Http\Controllers\User;

use App\Models\Tamu;
use App\Models\Surat;
use App\Models\Warga;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TamuForm;

class TamuController extends Controller
{
    function __construct()
    {
        $this->middleware('warga')->except('index');
    }

    public function index()
    {

        // mengambil data keluarga yang login
        $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->with('rumah')->first();
        if ($keluarga == null)
        {
            return view('pages.user.tamu.index', [
                'keluarga' => $keluarga,
            ]);
        }
        else {
            $warga = Warga::where('keluarga_id', $keluarga->id)->get();
            // dd($warga);
            $data = Tamu::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->get();
            return view('pages.user.tamu.index', [
                'keluarga' => $keluarga,
                'warga' => $warga,
                'data' => $data,
            ]);
        }
    }

    public function create()
    {
        $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->with('rumah')->first()->id;
        return view('pages.user.tamu.add', [
            'keluarga' => $keluarga
        ]);
    }

    public function store(TamuForm $request)
    {
        DB::transaction(function () use ($request) {
            try {
                $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('createable_type', 'App\Models\User')->first()->id;
                // dd($keluarga);

                $tamu = Tamu::createFromRequest($request);
                $tamu->createable()->associate($request->user());
                $tamu->keluarga_id = $keluarga;
                $tamu->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('user.tamu.index'))->withInput()->withToastSuccess('Data tersimpan');
    }
}
