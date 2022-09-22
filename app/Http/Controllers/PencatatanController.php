<?php

namespace App\Http\Controllers;

use App\Models\Pencatatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PencatatanController extends Controller
{
    public function index()
    {
        $title = 'Pencatatan';
        $pencatatan = Pencatatan::all();

        return view('pencatatan.index', [
            'title' => $title,
            'pencatatan' => $pencatatan,
        ]);
    }

    public function create()
    {
        $title = 'Pencatatan Create';

        return view('pencatatan.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string', 'unique:pencatatans', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required'],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        if ($request->file('image')) {
            $gambar = $request->file('image')->store('pencatatan-images');
        }

        $idUser = Auth::user()->id;
        $excrept = Str::limit(strip_tags($request->isi), 50);
        Pencatatan::create([
            'judul' => $request->judul,
            'catatan' => $request->isi,
            'gambar' => $gambar,
            'excerpt' => $excrept,
            'tanggal' => $request->tanggal,
            'id_users' => $idUser,
        ]);

        Alert::success('Berhasil', 'Data Pencatatan telah ditambahkan');
        return redirect()->route('pencatatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pencatatan  $pencatatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Pencatatan Show';
        $dataPencatatan = Pencatatan::find($id);

        return view('pencatatan.read', [
            'title' => $title,
            'pencatatan' => $dataPencatatan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pencatatan  $pencatatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Pencatatan Edit';
        $dataPencatatan = Pencatatan::find($id);

        return view('pencatatan.edit', [
            'title' => $title,
            'pencatatan' => $dataPencatatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pencatatan  $pencatatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pencatatan = Pencatatan::find($id);

        if ($request->oldImage == $request->image) {
            $rule = [
                'judul' => ['required', 'string', 'unique:pencatatans', 'max:255'],
                'isi' => ['required', 'string'],
                'tanggal' => ['required'],
            ];
        } else {
            $rule = [
                'judul' => ['required', 'string', 'unique:pencatatans', 'max:255'],
                'isi' => ['required', 'string'],
                'tanggal' => ['required'],
                'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            ];
        }
        if ($pencatatan->judul != $request->judul) {
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

            $pencatatan->judul = $request->judul;
        }

        if ($request->oldImage != $request->image) {
            Storage::delete($request->oldImage);
            $gambar = $request->file('image')->store('pencatatan-images');
        } else {
            $gambar = $request->oldImage;
        }

        $idUser = Auth::user()->id;
        $excrept = Str::limit(strip_tags($request->isi), 50);

        $data = [
            'judul' => $pencatatan->judul,
            'catatan' => $request->isi,
            'gambar' => $gambar,
            'excerpt' => $excrept,
            'tanggal' => $request->tanggal,
            'id_users' => $idUser,
        ];

        Pencatatan::where('id', $id)->update($data);
        Alert::success('Berhasil', 'Data Pencatatan berhasil diubah');
        return redirect()->route('pencatatan.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pencatatan  $pencatatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambar = Pencatatan::find($id);
        Storage::delete($gambar->gambar);
        Pencatatan::findOrFail($id)->delete();
        Alert::success('Data Pencatatan berhasil dihapus', 'success');
        return redirect()->route('pencatatan.index');
    }
}
