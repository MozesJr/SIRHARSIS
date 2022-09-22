<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function index()
    {
        $title = 'Roles';
        $dataRoles = Role::all();

        return view('role.index', [
            'title' => $title,
            'dataRole' => $dataRoles,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => ['required', 'string', 'unique:roles', 'max:255'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        Role::create([
            'role' => $request->role,
        ]);

        Alert::success('Berhasil', 'Data Role telah ditambahkan');
        return redirect()->route('role.index');
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if ($role->role != $request->role) {
            $validator = Validator::make(
                $request->all(),
                [
                    'role' => ['required', 'unique:roles', 'max:255'],
                ],
                [
                    'role.unique' => 'Data ini sudah ada',
                ],
            );

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            $role->role = $request->role;
        }

        $data = [
            'role' => $role->role,
        ];

        Role::where('id', $id)->update($data);
        Alert::success('Berhasil', 'Data Role berhasil diubah');
        return back();
    }
}
