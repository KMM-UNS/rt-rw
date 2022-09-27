<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\IuranKondisionalDataTable;
use App\Http\Controllers\Controller;
use App\Models\IuranKondisional;
use Illuminate\Http\Request;

class IuranKondisionalController extends Controller
{
    public function index(IuranKondisionalDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.iuran-kondisional.index');
    }

    public function create()
    {
        return view('pages.admin.master.iuran-kondisional.add-edit');
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
            IuranKondisional::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.iuran-kondisional.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = IuranKondisional::findOrFail($id);
        return view('pages.admin.master.iuran-kondisional.add-edit', ['data' => $data]);
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
            $data = IuranKondisional::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.iuran-kondisional.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            IuranKondisional::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
