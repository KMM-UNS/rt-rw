<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\PekerjaanDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterForm;
use Illuminate\Http\Request;
use App\Models\Pekerjaan;

class PekerjaanController extends Controller
{
    public function index(PekerjaanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.pekerjaan.index');
    }

    public function create()
    {
        return view('pages.admin.master.pekerjaan.add-edit');
    }

    public function store(MasterForm $request)
    {

        try {
            Pekerjaan::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.pekerjaan.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = Pekerjaan::findOrFail($id);
        return view('pages.admin.master.pekerjaan.add-edit', ['data' => $data]);
    }

    public function update(MasterForm $request, $id)
    {

        try {
            $data = Pekerjaan::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.pekerjaan.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Pekerjaan::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
