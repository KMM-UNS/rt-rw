<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tamu;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TamuForm;
use App\DataTables\Admin\TamuDataTable;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TamuDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.tamu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keluarga = Keluarga::pluck('kepala_keluarga', 'id');
        return view('pages.admin.tamu.add-edit', [
            'keluarga' => $keluarga
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TamuForm $request)
    {
        DB::transaction(function () use ($request) {
            try {
                $tamu = Tamu::createFromRequest($request);
                $tamu->createable()->associate($request->user());
                $tamu->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.tamu.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Tamu::findOrFail($id);
        $keluarga = Keluarga::pluck('kepala_keluarga', 'id');
        return view('pages.admin.tamu.add-edit', [
            'data' => $data,
            'keluarga' => $keluarga
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tamu = Tamu::findOrFail($id);
        DB::transaction(function () use ($request, $tamu) {
            try {
                $tamu->updateFromRequest($request);
                $tamu->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.tamu.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Tamu::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
