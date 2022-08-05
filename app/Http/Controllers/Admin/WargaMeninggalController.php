<?php

namespace App\Http\Controllers\Admin;

use App\Models\Warga;
use Illuminate\Http\Request;
use App\Models\WargaMeninggal;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\WargaMeninggalDataTable;

class WargaMeninggalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WargaMeninggalDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.warga.meninggal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warga = Warga::where('status_warga_id', 1)->pluck('nama', 'id');
        return view('pages.admin.warga.meninggal.add',[
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
        // dd($request->all());
        try {
            $request->validate([
                'warga_meninggal_warga_id' => 'required',
                'warga_meninggal_waktu' => 'required',
                'warga_meninggal_penyebab' => 'required',
                'warga_meninggal_tempat_pemakaman' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        DB::transaction(function () use ($request) {
            try {
                $warga_meninggal = WargaMeninggal::createFromRequest($request);
                $warga_meninggal->save();

                $warga = Warga::findOrFail($warga_meninggal->warga_id);
                $warga->status_warga_id = 3;
                $warga->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Terdapat kesalahan saat menyimpan data');
            }
        });
        return redirect(route('admin.warga.meninggal.index'))->withInput()->withToastSuccess('Data tersimpan');
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
