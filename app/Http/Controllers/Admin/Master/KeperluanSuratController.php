<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\KeperluanSurat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterForm;
use App\DataTables\Admin\Master\KeperluanSuratDataTable;

class KeperluanSuratController extends Controller
{
    public function index(KeperluanSuratDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.keperluan-surat.index');
    }

    public function create()
    {
        return view('pages.admin.master.keperluan-surat.add-edit');
    }

    public function store(MasterForm $request)
    {
        try {
            KeperluanSurat::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.keperluan-surat.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = KeperluanSurat::findOrFail($id);
        return view('pages.admin.master.keperluan-surat.add-edit', ['data' => $data]);
    }

    public function update(MasterForm $request, $id)
    {
        try {
            $data = KeperluanSurat::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.keperluan-surat.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KeperluanSurat::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
