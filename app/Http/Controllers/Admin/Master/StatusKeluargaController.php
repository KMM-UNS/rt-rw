<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\StatusKeluarga;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Master\StatusKeluargaDataTable;

class StatusKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatusKeluargaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.status-keluarga.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.master.status-keluarga.add-edit');
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
                'nama' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            StatusKeluarga::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.status-keluarga.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusKeluarga  $statusKeluarga
     * @return \Illuminate\Http\Response
     */
    public function show(StatusKeluarga $statusKeluarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusKeluarga  $statusKeluarga
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = StatusKeluarga::findOrFail($id);
        return view('pages.admin.master.status-keluarga.add-edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusKeluarga  $statusKeluarga
     * @return \Illuminate\Http\Response
     */
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
            $data = StatusKeluarga::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.status-keluarga.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusKeluarga  $statusKeluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            StatusKeluarga::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
