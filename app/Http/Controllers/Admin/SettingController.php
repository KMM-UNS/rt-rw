<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SettingDataTable;
use App\Http\Requests\SettingForm;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SettingController extends Controller
{
    public function index(SettingDataTable $settingDataTable)
    {
        return $settingDataTable->render('pages.admin.setting.index');
    }

    public function create()
    {
        return view('pages.admin.setting.add-edit');
    }

    public function store(SettingForm $request)
    {
        try {
            Setting::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Error saving data');
        }
        return redirect(route('admin.settings.index'))->withInput()->withToastSuccess('success saving data');
    }

    public function edit($id)
    {
        $data = Setting::findOrFail($id);
        return view('pages.admin.setting.add-edit', [
            'data' => $data
        ]);
    }

    public function update($id, SettingForm $request)
    {
        $data = Setting::findOrFail($id);
        try {
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Error saving data');
        }
        return redirect(route('admin.settings.index'))->withInput()->withToastSuccess('success saving data');
    }

    public function destroy($id)
    {
        return Setting::findOrFail($id)->delete();
    }
}
