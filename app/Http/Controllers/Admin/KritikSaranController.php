<?php

namespace App\Http\Controllers\Admin;

use App\Models\KritikSaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterForm;
use App\DataTables\Admin\KritikSaranDataTable;
use App\DataTables\Admin\Master\AgamaDataTable;

class KritikSaranController extends Controller
{
    public function index(KritikSaranDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kritik-saran.index');
    }

    public function create()
    {
        return view('pages.admin.kritik-saran.add-edit');
    }

    public function store(MasterForm $request)
    {
        try {
            KritikSaran::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kritik-saran.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = KritikSaran::findOrFail($id);
        return view('pages.admin.kritik-saran.add-edit', ['data' => $data]);
    }

    public function update(MasterForm $request, $id)
    {
        try {
            $data = KritikSaran::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kritik-saran.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KritikSaran::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
