<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Penugasan;
use App\Models\Status;
use App\Models\Tugas;
use App\Models\User;
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

        if (Auth::user()->id_role == 5) {
            $penugasan = Penugasan::all();
        } else {
            $penugasan = Penugasan::join('tugas', 'tugas.id_penugasans', '=', 'penugasans.id')->join('users', 'users.id', '=', 'tugas.id_users1')->where('tugas.id_users1', Auth::user()->id)->get();
        }

        // dd($penugasan);

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
        $user = User::where('id_role', 1)->get();
        // dd($user);
        return view('penugasan.create', [
            'title' => $title,
            'level' => $level,
            'status' => $status,
            'user' => $user,
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

        $tujuan = $request->tujuan;

        $ulang = count($tujuan);

        $id = count(Penugasan::all());

        for ($i = 0; $i < $ulang; $i++) {
            Tugas::create([
                'id_penugasans' => $id + 1,
                'id_users1' => $tujuan[$i],
            ]);
        }

        $idStatus = 1;
        $idUser = Auth::user()->id;
        $excrept = Str::limit(strip_tags($request->isi), 50);
        Penugasan::create([
            'judul' => $request->judul,
            'penugasan' => $request->isi,
            'gambar' => $gambar,
            'excerpt' => $excrept,
            'tujuan' => $tujuan,
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

        $penugasanOld = Penugasan::find($id);
        if (Auth::user()->id_role == 1 && $penugasanOld->id_statuses == 1) {
            $idStatus = 2;
            $data = [
                'id_statuses' => $idStatus,
            ];
            Penugasan::where('id', $id)->update($data);
        }

        if (Auth::user()->id_role == 5) {
            $penugasan = Penugasan::find($id);
        } else {
            $penugasan = Penugasan::join('tugas', 'tugas.id_penugasans', '=', 'penugasans.id')->join('users', 'users.id', '=', 'tugas.id_users1')->where('penugasans.id', $id)->where('tugas.id_users1', Auth::user()->id)->first();
        }

        // dd($penugasan);

        $dataUser = Penugasan::join('tugas', 'tugas.id_penugasans', '=', 'penugasans.id')->join('users', 'users.id', '=', 'tugas.id_users1')->where('penugasans.id', $id)->get();

        return view('penugasan.read', [
            'title' => $title,
            'penugasan' => $penugasan,
            'dataUser' => $dataUser
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

        if (Auth::user()->id_role == 1) {
            $idStatus = 3;
            $data = [
                'id_statuses' => $idStatus,
            ];
            Penugasan::where('id', $id)->update($data);
            $penugasan = Penugasan::find($id);
            // dd($penugasan);
            Alert::success('Berhasil', 'Selamat Anda Sudah Menyelesaikan Tugas ' . $penugasan->judul);
            return redirect()->route('penugasan.index');
        }

        $title = 'Penugasan Update';
        $dataPenugasan = Penugasan::find($id);
        $level = Level::all();
        $status = Status::all();
        $user = User::where('id_role', 1)->get();

        // dd($dataPenugasan);
        $dataUser = Tugas::join('penugasans', 'penugasans.id', '=', 'tugas.id_penugasans')->join('users', 'users.id', '=', 'tugas.id_users1')->where('tugas.id_penugasans', $id)->get();

        return view('penugasan.edit', [
            'title' => $title,
            'penugasan' => $dataPenugasan,
            'level' => $level,
            'user' => $user,
            'dataUser' => $dataUser,
            'status' => $status
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

        $ulang1 = Tugas::where('id_penugasans', $id)->get();
        $hapus = count($ulang1);

        for ($i = 0; $i < $hapus; $i++) {
            Tugas::where('id_penugasans', $id)->delete();
        }

        $tujuan = $request->tujuan;
        $ulang = count($tujuan);

        for ($i = 0; $i < $ulang; $i++) {
            Tugas::create([
                'id_penugasans' => $id,
                'id_users1' => $tujuan[$i],
            ]);
        }

        $idUser = Auth::user()->id;
        $excrept = Str::limit(strip_tags($request->isi), 50);

        $idStatus = $request->status;

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
