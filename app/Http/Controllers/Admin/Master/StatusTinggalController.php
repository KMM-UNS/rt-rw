<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\StatusTinggal;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterForm;
use App\DataTables\Admin\Master\StatusTinggalDataTable;

class StatusTinggalController extends Controller
{

    public function index(StatusTinggalDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.status-tinggal.index');
    }

    public function create()
    {
        return view('pages.admin.master.status-tinggal.add-edit');
    }

    public function store(MasterForm $request)
    {
        try {
            StatusTinggal::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.status-tinggal.index'))->withToastSuccess('Data tersimpan');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = StatusTinggal::findOrFail($id);
        return view('pages.admin.master.status-tinggal.add-edit', ['data' => $data]);
    }

    public function update(MasterForm $request, $id)
    {
        try {
            $data = StatusTinggal::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.status-tinggal.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            StatusTinggal::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
