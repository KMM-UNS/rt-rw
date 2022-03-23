<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatusKawin;
use App\Datatables\Admin\Master\StatusKawinDataTable;

class StatusKawinController extends Controller
{
    public function index(StatusKawinDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.status-kawin.index');
    }

    public function create()
    {
        return view('pages.admin.master.status-kawin.add-edit');
    }

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
            StatusKawin::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.status-kawin.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = StatusKawin::findOrFail($id);
        return view('pages.admin.master.status-kawin.add-edit', ['data' => $data]);
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
            $data = StatusKawin::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.status-kawin.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            StatusKawin::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
