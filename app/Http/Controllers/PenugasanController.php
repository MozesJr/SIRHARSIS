<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Penugasan;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PenugasanController extends Controller
{
    public function index()
    {
        $title = 'Penugasan';
        $penugasan = Penugasan::all();

        return view('penugasan.index', [
            'title' => $title,
            'penugasan' => $penugasan,
        ]);
    }

    public function create()
    {
        $title = 'Penugasan Create';
        $level = Level::all();
        $status = Status::all();

        return view('penugasan.create', [
            'title' => $title,
            'level' => $level,
            'status' => $status
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string', 'unique:penugasans', 'max:255'],
            'daterange' => ['required', 'string'],
            'level' => ['required', 'integer'],
            'isi' => ['required', 'string'],
            'image' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        if ($request->file('image')) {
            $gambar = $request->file('image')->store('penugasan-images');
        }

        $idStatus = 1;
        $idUser = Auth::user()->id;
        $excrept = Str::limit(strip_tags($request->isi), 50);
        Penugasan::create([
            'judul' => $request->judul,
            'penugasan' => $request->isi,
            'gambar' => $gambar,
            'excerpt' => $excrept,
            'daterange' => $request->daterange,
            'id_users' => $idUser,
            'id_statuses' => $idStatus,
            'id_levels' => $request->level,
        ]);

        Alert::success('Berhasil', 'Data Penugasan telah ditambahkan');
        return redirect()->route('penugasan.index');
    }

    public function show($id)
    {
        $title = 'Penugasan Show';
        $dataPenugasan = Penugasan::find($id);

        return view('penugasan.read', [
            'title' => $title,
            'penugasan' => $dataPenugasan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penugasan  $penugasan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Penugasan Update';
        $dataPenugasan = Penugasan::find($id);
        $level = Level::all();

        return view('penugasan.edit', [
            'title' => $title,
            'penugasan' => $dataPenugasan,
            'level' => $level,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penugasan  $penugasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $penugasan = Penugasan::find($id);

        if ($request->oldImage == $request->image) {
            $rule = [
                'judul' => ['required', 'string', 'unique:penugasans', 'max:255'],
                'daterange' => ['required', 'string'],
                'level' => ['required', 'integer'],
                'isi' => ['required', 'string'],
            ];
        } else {
            $rule = [
                'judul' => ['required', 'string', 'unique:penugasans', 'max:255'],
                'daterange' => ['required', 'string'],
                'level' => ['required', 'integer'],
                'isi' => ['required', 'string'],
                'image' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            ];
        }
        if ($penugasan->judul != $request->judul) {
            $validator = Validator::make(
                $request->all(),
                $rule,
                [
                    'judul.unique' => 'Judul ini sudah ada',
                ],
            );

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $penugasan->judul = $request->judul;
        }

        if ($request->oldImage != $request->image) {
            Storage::delete($request->oldImage);
            $gambar = $request->file('image')->store('penugasan-images');
        } else {
            $gambar = $request->oldImage;
        }

        $idUser = Auth::user()->id;
        $excrept = Str::limit(strip_tags($request->isi), 50);
        $idStatus = 1;
        $data = [
            'judul' => $penugasan->judul,
            'penugasan' => $request->isi,
            'gambar' => $gambar,
            'excerpt' => $excrept,
            'daterange' => $request->daterange,
            'id_users' => $idUser,
            'id_statuses' => $idStatus,
            'id_levels' => $request->level,
        ];

        Penugasan::where('id', $id)->update($data);
        Alert::success('Berhasil', 'Data Penugasan berhasil diubah');
        return redirect()->route('penugasan.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penugasan  $penugasan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambar = Penugasan::find($id);
        Storage::delete($gambar->gambar);
        Penugasan::findOrFail($id)->delete();
        Alert::success('Data Penugasan berhasil dihapus', 'success');
        return redirect()->route('penugasan.index');
    }
}
