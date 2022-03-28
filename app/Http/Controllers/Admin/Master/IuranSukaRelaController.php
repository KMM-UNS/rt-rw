<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\IuranSukarelaDataTable;
use App\Http\Controllers\Controller;
use App\Models\IuranSukarela;
use Illuminate\Http\Request;

class IuranSukarelaController extends Controller
{
    public function index(IuranSukarelaDataTable $dataTable)
    {
        // return $dataTable->render('pages.admin.master.')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IuranSukarela  $iuranSukarela
     * @return \Illuminate\Http\Response
     */
    public function show(IuranSukarela $iuranSukarela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IuranSukarela  $iuranSukarela
     * @return \Illuminate\Http\Response
     */
    public function edit(IuranSukarela $iuranSukarela)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IuranSukarela  $iuranSukarela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IuranSukarela $iuranSukarela)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IuranSukarela  $iuranSukarela
     * @return \Illuminate\Http\Response
     */
    public function destroy(IuranSukarela $iuranSukarela)
    {
        //
    }
}
