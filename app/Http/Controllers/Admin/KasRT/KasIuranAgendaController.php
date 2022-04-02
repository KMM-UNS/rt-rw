<?php

namespace App\Http\Controllers\Admin\KasRT;

use App\Datatables\Admin\KasRT\KasIuranAgendaDataTable;
use App\Http\Controllers\Controller;
use App\Models\KasIuranAgenda;
use Illuminate\Http\Request;

class KasIuranAgendaController extends Controller
{
    public function index(KasIuranAgendaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas-rt.kasiuranagenda.index');
    }

    public function create()
    {
        return view('pages.admin.kas-rt.kasiuranagenda.add-edit');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'jenis_iuran' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            KasIuranAgenda::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }
        return redirect(route('admin.kas-rt.kas-iuranagenda.index'))->withToastSuccess('Data tersimpan');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $data = KasIuranAgenda::findOrFail($id);
        return view('pages.admin.kas-rt.kasiuranagenda.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'jenis_iuran' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {

            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }
        try {
            $data = KasIuranAgenda::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas-rt.kas-iuranagenda.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KasIuranAgenda::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
