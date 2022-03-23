<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\UserDataTable;
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
        return view('pages.admin.user.add-edit');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|min:7|max:15',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => $request->isAdmin
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Error saving data');
        }

        return redirect(route('admin.user.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('pages.admin.user.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'fullname' => 'required|min:3',
                'email' => 'required|min:7|max:15',
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
            $data->fullname = $request->fullname;
            $data->email = $request->email;
            $data->isAdmin = $request->isAdmin;
            $data->fullname = $request->fullname;

            if (!empty($request->password)) :
                $data->password = Hash::make($request->password);
            endif;

            $data->save();
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Error saving data');
        }

        return redirect(route('user.index'))->withToastSuccess('Data tersimpan');
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
