<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendidikan;
use App\Datatables\Admin\Master\PendidikanDataTable;

class PendidikanController extends Controller
{
    public function index(PendidikanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.pendidikan.index');
    }

    public function create()
    {
        return view('pages.admin.master.pendidikan.add-edit');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|min:2'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            Pendidikan::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.pendidikan.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = Pendidikan::findOrFail($id);
        return view('pages.admin.master.pendidikan.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|min:2'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = Pendidikan::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.pendidikan.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Pendidikan::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
