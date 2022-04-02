<?php

namespace App\Http\Controllers\Admin\KasRT;

use App\Datatables\Admin\KasRT\KasIuranKondisionalDataTable;
// use App\Models\IuranKondisional;
use App\Http\Controllers\Controller;
use App\Models\KasIuranKondisional;
use Illuminate\Http\Request;

class KasIuranKondisionalController extends Controller
{
    public function index(KasIuranKondisionalDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas-rt.kasiurankondisional.index');
    }
    public function create()
    {
        return view('pages.admin.kas-rt.kasiurankondisional.add-edit');
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
            KasIuranKondisional::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas-rt.kas-iurankondisional.index'))->withToastSuccess('Data tersimpan');
    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = KasIuranKondisional::findOrFail($id);
        return view('pages.admin.kas-rt.kasiurankondisional.add-edit', ['data' => $data]);
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
            $data = KasIuranKondisional::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas-rt.kas-iurankondisional.index'))->withToastSuccess('Data tersimpan');
    }
    public function destroy($id)
    {
        try {
            KasIuranKondisional::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
