<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\JenisSurat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterForm;
use App\DataTables\Admin\Master\JenisSuratDataTable;

class JenisSuratController extends Controller
{
    public function index(JenisSuratDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.jenis-surat.index');
    }

    public function create()
    {
        return view('pages.admin.master.jenis-surat.add-edit');
    }

    public function store(MasterForm $request)
    {
        try {
            JenisSurat::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.jenis-surat.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = JenisSurat::findOrFail($id);
        return view('pages.admin.master.jenis-surat.add-edit', ['data' => $data]);
    }

    public function update(MasterForm $request, $id)
    {
        try {
            $data = JenisSurat::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.jenis-surat.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            JenisSurat::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
