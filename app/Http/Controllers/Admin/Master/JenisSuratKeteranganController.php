<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisSuratKeterangan;
use App\Http\Requests\Admin\MasterForm;
use App\DataTables\Admin\Master\JenisSuratKeteranganDataTable;

class JenisSuratKeteranganController extends Controller
{
    public function index(JenisSuratKeteranganDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.jenis-surat-keterangan.index');
    }

    public function create()
    {
        return view('pages.admin.master.jenis-surat-keterangan.add-edit');
    }

    public function store(MasterForm $request)
    {
        try {
            JenisSuratKeterangan::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.jenis-surat-keterangan.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = JenisSuratKeterangan::findOrFail($id);
        return view('pages.admin.master.jenis-surat-keterangan.add-edit', ['data' => $data]);
    }

    public function update(MasterForm $request, $id)
    {
        try {
            $data = JenisSuratKeterangan::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.jenis-surat-keterangan.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            JenisSuratKeterangan::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
