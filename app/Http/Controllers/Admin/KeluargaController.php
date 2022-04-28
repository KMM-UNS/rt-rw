<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DetailKeluargaDataTable;
use App\Models\Rumah;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\KeluargaDataTable;
use App\Http\Requests\Admin\KeluargaForm;
use App\Models\Keluarga;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KeluargaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.keluarga.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rumah = Rumah::pluck('nomor_rumah', 'id');
        return view('pages.admin.keluarga.add-edit', [
            'rumah' => $rumah
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeluargaForm $request)
    {
        DB::transaction(function () use ($request) {
            try {
                $keluarga = Keluarga::createFromRequest($request);
                $keluarga->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DetailKeluargaDataTable $dataTable, $id)
    {
        $data = Keluarga::findorFail($id);
        return $dataTable->render('pages.admin.keluarga.show', [
            'data' => $data
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Keluarga::findorFail($id);
        $rumah = Rumah::pluck('nomor_rumah', 'id');
        return view('pages.admin.keluarga.add-edit', [
            'data' => $data,
            'rumah' => $rumah
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
        $keluarga = Keluarga::findorFail($id);
        DB::transaction(function () use ($request, $keluarga) {
            try {
                $keluarga->updateFromRequest($request);
                $keluarga->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Keluarga::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
