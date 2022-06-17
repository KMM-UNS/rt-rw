<?php

namespace App\Http\Controllers\Admin\ManajemenKeuangan;

use App\DataTables\Admin\ManajemenKeuangan\ManajemenPemasukanDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManajemenPengeluaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ManajemenPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pengeluarann = ManajemenPengeluaran::all();
        $pengeluarannn = ManajemenPengeluaran::sum('nominal');
        return view('pages.admin.manajemen-keuangan.manajemen-pengeluaran.index', ['pengeluarann' => $pengeluarann, 'pengeluarannn' => $pengeluarannn]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.manajemen-keuangan.manajemen-pengeluaran.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'keterangan' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            ManajemenPengeluaran::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.manajemen-keuangan.manajemen-pengeluaran.index'))->withToastSuccess('Data tersimpan');
    }

    public function cetak_pdf()
    {
        // return 'berhasil';

        $pengeluarann = ManajemenPengeluaran::all();
        $pengeluarannn = ManajemenPengeluaran::sum('nominal');
        $pdf = PDF::loadView('pages.admin.manajemen-keuangan.manajemen-pengeluaran.pengeluaran_pdf', ['pengeluarann' => $pengeluarann, 'pengeluarannn' => $pengeluarannn]);
        return $pdf->download('laporan-pengeluaran.pdf');
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
        $data = ManajemenPengeluaran::findOrFail($id);
        $pengeluarannn = ManajemenPengeluaran::sum('nominal');

        return view('pages.admin.manajemen-keuangan.manajemen-pengeluaran.add-edit', [
            'data' => $data,
            'pengeluarannn' => $pengeluarannn,
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
        try {
            $request->validate([
                'keterangan' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = ManajemenPengeluaran::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.manajemen-keuangan.manajemen-pengeluaran.index'))->withToastSuccess('Data tersimpan');
    }

    public function changeMemberStatus(Request $request)
    {
        $data = ManajemenPengeluaran::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json(['success' => 'User status change successfully.']);
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
            DB::table('manajemen_pengeluarans')->where('id', $id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
        return redirect(route('admin.manajemen-keuangan.manajemen-pengeluaran.index'))->withToastSuccess('Data terhapus');
    }
}
