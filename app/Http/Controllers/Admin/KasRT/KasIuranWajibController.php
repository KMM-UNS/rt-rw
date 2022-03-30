<?php

namespace App\Http\Controllers\Admin\KasRT;

use App\Datatables\Admin\KasRT\KasIuranWajibDataTable;
use App\Models\IuranWajib;
use App\Http\Controllers\Controller;
use App\Models\KasIuranWajib;
use Illuminate\Http\Request;

class KasIuranWajibController extends Controller
{
    public function index(KasIuranWajibDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas-rt.kasiuranwajib.index');
    }

    public function create()
    {
        $jenis_iuranwajib = IuranWajib::pluck('nama', 'id');
        return view('pages.admin.kas-rt.kasiuranwajib.add-edit', ['jenis_iuranwajib' => $jenis_iuranwajib]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'penerima' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            KasIuranWajib::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas-rt.kas-iuranwajib.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = KasIuranWajib::findOrFail($id);
        $jenis_iuranwajib = IuranWajib::pluck('nama', 'id');
        return view('pages.admin.kas-rt.kasiuranwajib.add-edit', [
            'data' => $data,
            'jenis_iuranwajib' => $jenis_iuranwajib
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'penerima' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = KasIuranWajib::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas-rt.kas-iuranwajib.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KasIuranWajib::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
