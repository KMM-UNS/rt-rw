<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RiwayatDataTable;
use App\Models\Rumah;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use App\Models\StatusHunian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use App\Models\StatusPenggunaanRumah;
use App\Http\Requests\Admin\RumahForm;
use App\DataTables\Admin\RumahDataTable;
use App\Models\RiwayatRumah;

class RumahController extends Controller
{
    function __construct()
    {
    $this->middleware('role:admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RumahDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.rumah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status_penggunaan_rumah = StatusPenggunaanRumah::pluck('nama', 'id');
        $status_hunian = StatusHunian::pluck('nama', 'id');

        return view('pages.admin.rumah.add-edit', [
            'status_penggunaan_rumah' => $status_penggunaan_rumah,
            'status_hunian' => $status_hunian
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RumahForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                // dd($request->all());
                $rumah = Rumah::createFromRequest($request);
                $rumah->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'rumah/foto');
                        $rumah->dokumen()->create([
                            'nama' => $key,
                            'public_url' => $upload['public_path']
                        ]);
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.rumah.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, RiwayatDataTable $dataTable)
    {
       $data = Rumah::with('dokumen')->findOrFail($id);
       return $dataTable->render('pages.admin.rumah.show', [
        'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, DataHelper $dataHelper)
    {
        $data = Rumah::with('dokumen')->findOrFail($id);
        $status_penggunaan_rumah = StatusPenggunaanRumah::pluck('nama', 'id');
        $status_hunian = StatusHunian::pluck('nama', 'id');
        return view('pages.admin.rumah.add-edit', [
            'data' => $data,
            'status_penggunaan_rumah' => $status_penggunaan_rumah,
            'status_hunian' => $status_hunian,
            'dataHelper' => $dataHelper
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RumahForm $request, FileUploaderHelper $fileUploaderHelper, $id)
    {
        $rumah = Rumah::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $rumah) {
            try {
                $rumah->updateFromRequest($request);
                $rumah->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $rumah->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        if ($old != null){
                            TrashHelper::moveToTrash($old->public_url);
                            $upload = $fileUploaderHelper->store($file, 'rumah/foto');
                            $old->update([
                                'public_url' => $upload['public_path']
                            ]);
                        } else {
                            $upload = $fileUploaderHelper->store($file, 'rumah/foto');
                            $rumah->dokumen()->create([
                                'nama' => $key,
                                'public_url' => $upload['public_path']
                            ]);
                        }

                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.rumah.index'))->withInput()->withToastSuccess('Data tersimpan');
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
            Rumah::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
