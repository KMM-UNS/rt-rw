<?php

namespace App\Http\Controllers\Admin\KasRT;

use App\Datatables\Admin\KasRT\KasIuranSukaRelaDataTable;
// use App\Models\Iuransukarela;
use App\Http\Controllers\Controller;
use App\Models\KasIuranSukaRela;
use Illuminate\Http\Request;

class KasIuranSukaRelaController extends Controller
{
    public function index(KasIuranSukaRelaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas-rt.kasiuransukarela.index');
    }

    public function create()
    {
        return view('pages.admin.kas-rt.kasiuransukarela.add-edit');
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
            KasIuranSukarela::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas-rt.kas-iuransukarela.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = KasIuranSukaRela::findOrFail($id);
        return view('pages.admin.kas-rt.kasiuransukarela.add-edit', ['data' => $data]);
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
            $data = KasIuranSukaRela::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {

            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas-rt.kas-iuransukarela.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KasIuranSukaRela::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
