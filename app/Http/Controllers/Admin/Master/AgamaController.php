<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\AgamaDataTable;
use App\Http\Controllers\Controller;
use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    public function index(AgamaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.agama.index');
    }

    public function create()
    {
        return view('pages.admin.master.agama.add-edit');
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
            Agama::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.agama.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = Agama::findOrFail($id);
        return view('pages.admin.master.agama.add-edit', ['data' => $data]);
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
            $data = Agama::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.agama.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Agama::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
