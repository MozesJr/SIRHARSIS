<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LevelController extends Controller
{
    public function index()
    {
        $title = 'Level Urgency';
        $dataLevel = Level::all();

        return view('level.index', [
            'title' => $title,
            'level' => $dataLevel,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level' => ['required', 'string', 'unique:levels', 'max:255'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        Level::create([
            'level' => $request->level,
        ]);

        Alert::success('Berhasil', 'Data Level telah ditambahkan');
        return redirect()->route('level.index');
    }

    public function show(Level $level)
    {
        //
    }

    public function edit(Level $level)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $level = Level::find($id);
        if ($level->level != $request->level) {
            $validator = Validator::make(
                $request->all(),
                [
                    'level' => ['required', 'unique:levels', 'max:255'],
                ],
                [
                    'level.unique' => 'Data ini sudah ada',
                ],
            );

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            $level->level = $request->level;
        }

        $data = [
            'level' => $level->level,
        ];

        Level::where('id', $id)->update($data);
        Alert::success('Berhasil', 'Data Level berhasil diubah');
        return back();
    }

    public function destroy(Level $level)
    {
        //
    }
}
