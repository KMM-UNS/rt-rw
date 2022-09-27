<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\PosDataTable;
use App\Http\Controllers\Controller;
use App\Models\Pos;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(PosDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.pos.index');
    }

    public function create()
    {
        return view('pages.admin.master.pos.add-edit');
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
            Pos::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.pos.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = Pos::findOrFail($id);
        return view('pages.admin.master.pos.add-edit', ['data' => $data]);
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
            $data = Pos::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.pos.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Pos::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
