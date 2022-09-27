<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\IuranAgendaDataTable;
use App\Http\Controllers\Controller;
use App\Models\IuranAgenda;
use App\Models\IuranWajib;
use Illuminate\Http\Request;

class IuranAgendaController extends Controller
{

    public function index(IuranAgendaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.iuran-agenda.index');
    }

    public function create()
    {
        return view('pages.admin.master.iuran-agenda.add-edit');
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
            IuranAgenda::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.iuran-agenda.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = IuranAgenda::findOrFail($id);
        return view('pages.admin.master.iuran-agenda.add-edit', ['data' => $data]);
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
            $data = IuranAgenda::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.iuran-agenda.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            IuranAgenda::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
