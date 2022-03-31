<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\StatusHunianDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterForm;
use App\Models\StatusHunian;
use Illuminate\Http\Request;

class StatusHunianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatusHunianDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.status-hunian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.master.status-hunian.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterForm $request)
    {
        try {
            StatusHunian::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.status-hunian.index'))->withToastSuccess('Data tersimpan');
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
        $data = StatusHunian::findOrFail($id);
        return view('pages.admin.master.status-hunian.add-edit',
        [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterForm $request, $id)
    {
        try {
            $data = StatusHunian::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.status-hunian.index'))->withToastSuccess('Data tersimpan');
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
            StatusHunian::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
