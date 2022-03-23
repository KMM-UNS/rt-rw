<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminForm;
use App\Models\Admin;
use App\Models\AdminDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(AdminDataTable $AdminDataTable)
    {
        return $AdminDataTable->render('pages.admin.admin.index');
    }

    public function create()
    {
        $department = AdminDepartment::pluck('nama', 'id');
        return view('pages.admin.admin.add-edit', [
            'department' => $department
        ]);
    }

    public function store(AdminForm $request)
    {
        try {
            $request->request->set('password', Hash::make($request->password));
            Admin::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Error saving data');
        }
        return redirect(route('admin.admin.index'))->withInput()->withToastSuccess('success saving data');
    }

    public function edit($id)
    {
        $data = Admin::findOrFail($id);
        $department = AdminDepartment::pluck('nama', 'id');
        return view('pages.admin.admin.add-edit', [
            'department' => $department,
            'data' => $data
        ]);
    }

    public function update($id, AdminForm $request)
    {
        $data = Admin::findOrFail($id);
        if (empty($request->password)) {
            $request->request->remove('password');
        } else {
            $request->request->set('password', Hash::make($request->password));
        }
        try {
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Error saving data');
        }
        return redirect(route('admin.admin.index'))->withInput()->withToastSuccess('success saving data');
    }

    public function destroy($id)
    {
        return Admin::findOrFail($id)->delete();
    }
}
