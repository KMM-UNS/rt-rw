<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\App;
use App\Models\Warga;
use App\Helpers\DataHelper;
use App\Helpers\TrashHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\Cloner\Data;
use App\DataTables\Admin\Master\AppDataTable;

class AppController extends Controller
{
    public function index(AppDataTable $dataTable)
    {
        $data = App::orderBy('id', 'DESC')->first();
        return view('pages.admin.master.app.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('pages.admin.master.app.add-edit');
    }

    public function store(Request $request, FileUploaderHelper $fileUploaderHelper)
    {
        // dd($request->all());
        DB::transaction(function () use ($request, $fileUploaderHelper) {
            try {
                // dd($request->all());
                $app = App::createFromRequest($request);
                $app->save();
                if ($request->file()) {

                    foreach ($request->file() as $key => $file) {
                        $upload = $fileUploaderHelper->store($file, 'app/ttd');
                        $app->dokumen()->create([
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
        return redirect(route('admin.master-data.aplikasi.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = App::findOrFail($id);
        return view('pages.admin.master.app.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id, FileUploaderHelper $fileUploaderHelper)
    {
        $app = App::findOrFail($id);
        DB::transaction(function () use ($request, $fileUploaderHelper, $app) {
            try {
                $app->updateFromRequest($request);
                $app->save();

                if ($request->file()) {
                    foreach ($request->file() as $key => $file) {
                        $existingFile = $app->dokumen;
                        $old = DataHelper::filterDokumenData($existingFile, 'nama', $key)->first();

                        TrashHelper::moveToTrash($old->public_url);

                        $upload = $fileUploaderHelper->store($file, 'app/lampiran');
                        $old->update([
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

        return redirect(route('admin.master-data.aplikasi.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            App::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
