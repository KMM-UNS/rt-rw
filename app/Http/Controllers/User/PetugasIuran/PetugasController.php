<?php

namespace App\Http\Controllers\User\PetugasIuran;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\PetugasTagihan;
use App\Models\Pos;
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
        $data = PetugasTagihan::with(['poss'])->where('user_id', auth()->user()->id)->first();
        // $data1 = PetugasTagihan::where('id', $data)->with('poss')->get();
        $data2 = Keluarga::where('id', auth()->user()->id)->first();
        return view('pages.user.petugas.index', [
            'data' => $data,
            // 'data1' => $data1,
            'data2' => $data2
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pos = Pos::pluck('nama', 'id');
        return view('pages.user.petugas.add-edit', ['pos' => $pos]);
    }
    // return view('pages.user.petugas.add-edit');

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }
        // dd($request->all());
        try {
            PetugasTagihan::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('user.petugas-iuran.data-petugas.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        // $data = PetugasTagihan::findOrFail($id);
        // $pengeluarannn = ManajemenPengeluaran::sum('nominal');
        $data = PetugasTagihan::where('id', auth()->user()->id)->first();
        $data1 = PetugasTagihan::where('id', $data)->with('poss')->get();
        $data2 = PetugasTagihan::findOrFail($id);
        $pos = Pos::pluck('nama', 'id');
        return view('pages.user.petugas.add-edit', [
            'data1' => $data1,
            'data2' => $data2,
            'pos' => $pos
        ]);
        // return ('berhasil');
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data2 = PetugasTagihan::findOrFail($id);
            $data2->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('user.petugas-iuran.data-petugas.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        //
    }
}
