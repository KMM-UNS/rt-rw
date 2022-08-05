<?php

namespace App\Http\Controllers\Admin;

use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\WargaPindah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\WargaPindahDataTable;

class WargaPindahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WargaPindahDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.warga.pindah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warga = Warga::where('status_warga_id', 1)->pluck('nama', 'id');
        return view('pages.admin.warga.pindah.add',[
            'warga' => $warga
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'warga_pindah_warga_id' => 'required',
                'warga_pindah_alamat_tujuan' => 'required',
                'warga_pindah_tanggal_pindah' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        DB::transaction(function () use ($request) {
            try {
                $warga_pindah = WargaPindah::createFromRequest($request);
                $warga_pindah->save();

                $warga = Warga::findOrFail($warga_pindah->warga_id);
                $warga->status_warga_id = 2;
                $warga->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Terdapat kesalahan saat menyimpan data');
            }
        });
        return redirect(route('admin.warga.pindah.index'))->withInput()->withToastSuccess('Data tersimpan');
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
