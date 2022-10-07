<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LevelsController extends Controller
{
    public function index()
    {
        $title = 'Level Server';
        $dataLevel = Level::where('id_ext', 2)->get();

        return view('level.index', [
            'title' => $title,
            'level' => $dataLevel,
        ]);
    }

    public function store(Request $request)
    {
        $cek = Level::where('level', $request->status)->where('id_ext', 2)->first();

        if ($cek != NULL) {
            $validator = Validator::make($request->all(), [
                'level' => ['required', 'string', 'unique:levels', 'max:255'],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'level' => ['required', 'string', 'max:255'],
            ]);
        }

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        Level::create([
            'level' => $request->level,
            'id_ext' => 2,
        ]);

        Alert::success('Berhasil', 'Data Level Server telah ditambahkan');
        return redirect()->route('levels.index');
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
            'id_ext' => 2,
        ];

        Level::where('id', $id)->update($data);
        Alert::success('Berhasil', 'Data Level Server berhasil diubah');
        return back();
    }
}
