<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Ronda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterForm;
use App\DataTables\Admin\Master\RondaDataTable;

class RondaController extends Controller
{
    public function index(RondaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.ronda.index');
    }

    public function create()
    {
        return view('pages.admin.master.ronda.add-edit');
    }

    public function store(MasterForm $request)
    {
        try {
            Ronda::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.ronda.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = Ronda::findOrFail($id);
        return view('pages.admin.master.ronda.add-edit', ['data' => $data]);
    }

    public function update(MasterForm $request, $id)
    {
        try {
            $data = Ronda::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.ronda.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Ronda::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function aktif($id)
    {
        $ronda = Ronda::findOrFail($id);
        DB::transaction(function () use ($ronda) {
            try {
               $ronda->where('status', 'aktif')->update(['status' => 'non-aktif']);
               $ronda->where('id', $ronda->id)->update(['status' => 'aktif']);
                // $ronda->updateFromRequest($request);
                // $ronda->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.master-data.ronda.index'))->withInput()->withToastSuccess('Jadwal Ronda diaktifkan');
    }
}
