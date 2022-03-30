<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\GolonganDarahDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterForm;
use App\Models\GolonganDarah;
use Illuminate\Http\Request;

class GolonganDarahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GolonganDarahDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.golongan-darah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.master.golongan-darah.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterForm $request)
    {

        try {
            GolonganDarah::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.golongan-darah.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GolonganDarah  $golonganDarah
     * @return \Illuminate\Http\Response
     */
    public function show(GolonganDarah $golonganDarah)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GolonganDarah  $golonganDarah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = GolonganDarah::findOrFail($id);
        return view('pages.admin.master.golongan-darah.add-edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GolonganDarah  $golonganDarah
     * @return \Illuminate\Http\Response
     */
    public function update(MasterForm $request, $id)
    {

        try {
            $data = GolonganDarah::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.golongan-darah.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GolonganDarah  $golonganDarah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            GolonganDarah::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
