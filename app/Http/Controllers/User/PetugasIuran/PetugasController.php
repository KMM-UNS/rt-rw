<?php

namespace App\Http\Controllers\User\PetugasIuran;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\PetugasTagihan;
use App\Models\Pos;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PetugasTagihanForm;
use App\Helpers\DataHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\TrashHelper;
use App\Models\Dokumen;
use App\Helpers\FileUploaderHelper;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PetugasTagihan::with(['poss'])->where('user_id', auth()->user()->id)->first();
        // $data1 = PetugasTagihan::where('id', $data)->with('poss')->get();
        $data3 = Dokumen::where('nama', 'foto_petugas')->first();
        $data4 = Dokumen::where('nama', 'foto_ttd_petugas')->first();
        $data2 = Keluarga::where('id', auth()->user()->id)->first();
        return view('pages.user.petugas.index', [
            'data' => $data,
            // 'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pos = Pos::pluck('nama', 'id');
        return view('pages.user.petugas.add-edit', ['pos' => $pos]);
    }
    // return view('pages.user.petugas.add-edit');

    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'nama' => 'required|min:3'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
    //     }
    //     // dd($request->all());
    //     try {
    //         PetugasTagihan::create($request->all());
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         return back()->withInput()->withToastError('Something went wrong');
    //     }

    //     return redirect(route('user.petugas-iuran.data-petugas.index'))->withToastSuccess('Data tersimpan');
    // }

    public function store(PetugasTagihanForm $request, FileUploaderHelper $fileUploaderHelper)
    {
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                // dd($request->all());
                $petugas = PetugasTagihan::createFromRequest($request);
                $petugas->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'petugas/foto');
                        $petugas->dokumen()->create([
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
        return redirect(route('user.petugas-iuran.data-petugas.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        // $data = PetugasTagihan::findOrFail($id);
        // $petugasnn = Manajemenpetugas::sum('nominal');
        $data = PetugasTagihan::where('id', auth()->user()->id)->first();
        $data1 = PetugasTagihan::where('id', $data)->with('poss')->get();
        $data2 = PetugasTagihan::findOrFail($id);
        $pos = Pos::pluck('nama', 'id');
        return view('pages.user.petugas.add-edit', [
            'data1' => $data1,
            'data2' => $data2,
            'pos' => $pos
        ]);
        // return ('berhasil');
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $request->validate([
    //             'nama' => 'required|min:3'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
    //     }

    //     try {
    //         $data2 = PetugasTagihan::findOrFail($id);
    //         $data2->update($request->all());
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError('Something went wrong');
    //     }

    //     return redirect(route('user.petugas-iuran.data-petugas.index'))->withToastSuccess('Data tersimpan');
    // }

    public function update(PetugasTagihanForm $request, FileUploaderHelper $fileUploaderHelper, $id)
    {
        $petugas = PetugasTagihan::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $petugas) {
            try {
                $petugas->updateFromRequest($request);
                $petugas->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $petugas->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        // TrashHelper::moveToTrash($old->public_url);
                        // $upload = $fileUploaderHelper->store($file, 'petugas/lampiran');
                        // $old->update([
                        //     'public_url' => $upload['public_path']
                        // ]);

                        if ($old != null) {
                            TrashHelper::moveToTrash($old->public_url);
                            $upload = $fileUploaderHelper->store($file, 'petugas/dokumen');
                            $old->update([
                                'public_url' => $upload['public_path']
                            ]);
                        } else {
                            $upload = $fileUploaderHelper->store($file, 'petugas/dokumen');
                            $petugas->dokumen()->create([
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
        return redirect(route('user.petugas-iuran.data-petugas.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        //
    }
}
