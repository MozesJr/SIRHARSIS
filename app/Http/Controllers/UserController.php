<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Rules\IsValidPassword;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $title = 'User';
        $dataUser = User::all();

        return view('user.index', [
            'title' => $title,
            'dataUser' => $dataUser,
        ]);
    }

    public function create()
    {
        $title = 'User Create';
        $dataRole = Role::all();
        $dataJob = Job::all();

        return view('user.create', [
            'title' => $title,
            'dataRole' => $dataRole,
            'dataJob' => $dataJob,
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'unique:users', 'max:255'],
            'password' => ['required', 'string', new isValidPassword(), 'required_with:current_password', 'same:current_password'],
            'current_password' => ['required', 'string'],
            'role' => ['required', 'integer'],
            'job' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_role' => $request->role,
            'id_job' => $request->job,
        ]);

        Alert::success('Berhasil', 'Data Users telah ditambahkan');
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $title = 'Users Show';
        $dataUser = User::find($id);

        return view('user.show', [
            'title' => $title,
            'dataUser' => $dataUser,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Users Update';
        $dataUser = User::find($id);
        $dataJob = Job::all();
        $dataRole = Role::all();

        return view('user.edit', [
            'title' => $title,
            'dataUser' => $dataUser,
            'dataJob' => $dataJob,
            'dataRole' => $dataRole,
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
        if ($request->password == NULL) {
            $user = User::find($id);

            if ($request->oldImage == NULL) {
                $rule = [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'username' => ['required', 'string', 'unique:users', 'max:255'],
                    'role' => ['required', 'integer'],
                    'job' => ['required', 'integer'],
                ];
            } else if ($request->oldImage == $request->image) {
                $rule = [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'username' => ['required', 'string', 'unique:users', 'max:255'],
                    'role' => ['required', 'integer'],
                    'job' => ['required', 'integer'],
                ];
            } else {
                $rule = [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'username' => ['required', 'string', 'unique:users', 'max:255'],
                    'role' => ['required', 'integer'],
                    'job' => ['required', 'integer'],
                    'image' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
                ];
            }

            if ($user->username != $request->username) {
                $validator = Validator::make(
                    $request->all(),
                    $rule,
                    [
                        'username.unique' => 'User Name ini sudah ada',
                    ],
                );
                if ($validator->fails()) {
                    Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                    return back()->withErrors($validator)->withInput();
                }

                $user->username = $request->username;
            }

            // dd($request->all());

            if ($request->oldImage == NULL) {
                $gambar = $request->file('image')->store('users-images');
            } else if ($request->oldImage != $request->image) {
                Storage::delete($request->oldImage);
                $gambar = $request->file('image')->store('users-images');
            } else {
                $gambar = $request->image;
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'id_role' => $request->role,
                'id_job' => $request->job,
                'gambar' => $gambar
            ];

            User::where('id', $id)->update($data);
            Alert::success('Berhasil', 'Data Users berhasil diubah');
            return redirect()->route('users.show', $id);
        } else {
            $user = User::find($id);

            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', new isValidPassword(), 'required_with:current_password', 'same:current_password'],
                'current_password' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $data = [
                'password' => Hash::make($request->password),
            ];

            User::where('id', $id)->update($data);
            Alert::success('Berhasil', 'Data Users berhasil diubah');
            return redirect()->route('users.show', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambar = User::find($id);
        Storage::delete($gambar->gambar);
        User::findOrFail($id)->delete();
        Alert::success('Data Users berhasil dihapus', 'success');
        return redirect()->route('users.index');
    }
}
