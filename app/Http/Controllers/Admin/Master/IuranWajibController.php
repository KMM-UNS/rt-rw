<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\IuranWajibDataTable;
use App\Http\Controllers\Controller;
use App\Models\IuranWajib;
use Illuminate\Http\Request;

class IuranWajibController extends Controller
{
    public function index(IuranWajibDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.iuran-wajib.index');
    }

    public function create()
    {
        return view('pages.admin.master.iuran-wajib.add-edit');
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
            IuranWajib::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.iuran-wajib.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = IuranWajib::findOrFail($id);
        return view('pages.admin.master.iuran-wajib.add-edit', ['data' => $data]);
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
            $data = IuranWajib::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.iuran-wajib.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            IuranWajib::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
