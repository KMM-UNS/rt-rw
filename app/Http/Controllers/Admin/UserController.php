<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\UserDataTable;
use App\Models\AdminRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserDataTable $datatable)
    {
        return $datatable->render('pages.admin.user.index');
    }

    public function create()
    {
        $role = AdminRole::pluck('nama', 'id');
        return view('pages.admin.user.add-edit', ['role' => $role]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3'
                // 'email' => 'required|min:7|max:15',
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                // 'isAdmin' => $request->isAdmin
            ]);
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Error saving data');
        }

        return redirect(route('admin.user.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        // return ('berhasil');
        $role = AdminRole::pluck('nama', 'id');
        $data = User::findOrFail($id);
        return view('pages.admin.user.add-edit', ['data' => $data, 'role' => $role]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|min:7|max:20',
            ]);

            if (!empty($request->password)) :
                $request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
            endif;
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = User::findOrFail($id);
            $data->name = $request->name;
            $data->email = $request->email;
            // $data->isAdmin = $request->isAdmin;
            // $data->fullname = $request->fullname;

            if (!empty($request->password)) :
                $data->password = Hash::make($request->password);
            endif;

            $data->save();
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Error saving data');
        }

        return redirect(route('admin.user.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
