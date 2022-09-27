<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\IuranSukarelaDataTable;
use App\Http\Controllers\Controller;
use App\Models\IuranSukarela;
use Illuminate\Http\Request;


class IuranSukarelaController extends Controller
{
    public function index(IuranSukarelaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.iuran-sukarela.index');
    }

    public function create()
    {
        return view('pages.admin.master.iuran-sukarela.add-edit');
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
            IuranSukarela::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.iuran-sukarela.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = IuranSukarela::findOrFail($id);
        return view('pages.admin.master.iuran-sukarela.add-edit', ['data' => $data]);
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
            $data = IuranSukarela::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.iuran-sukarela.index'))->withToastSuccess('Data Tersimpan');
    }

    public function destroy($id)
    {
        try {
            IuranSukarela::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
