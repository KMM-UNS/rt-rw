<?php

namespace App\Http\Controllers\User\StatusIuranWarga;

use App\Console\Kernel;
use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Pos;
use Illuminate\Http\Request;

class DataWargaController extends Controller
{
    public function index()
    {
        $data = Keluarga::where('user_id', auth()->user()->id)->first();
        return view('pages.user.datadiri-warga.index', ['data' => $data]);
    }

    public function create()
    {
        $poss = Pos::pluck('nama', 'id');
        return view('pages.user.datadiri-warga.add-edit', ['poss' => $poss]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'no_kk' => 'required|min:12'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        // dd($request->all());
        try {
            Keluarga::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            // dd($request->all());
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('user.warga.data-diri.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Keluarga::findOrFail($id);
        $poss = Pos::pluck('nama', 'id');
        return view('pages.user.datadiri-warga.add-edit', [
            'data' => $data,
            'pos' => $poss
        ]);
    }

    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'no_kk' => 'required|min:12'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = Keluarga::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong bro');
        }
        // $data = Keluarga::where('id', auth()->user()->id)->first()->update([
        //     'no_kk' => $request->no_kk,
        //     'telp' => $request->telp,
        // ]);

        return redirect(route('user.warga.data-diri.index', ['data' => $data]))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Keluarga::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
