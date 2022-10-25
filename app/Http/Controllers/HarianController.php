<?php

namespace App\Http\Controllers;

use App\Models\Harian;
use App\Models\Server;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class HarianController extends Controller
{
    public function index()
    {
        $title = "Tugas Harian";
        $dataServer = Server::all();
        $dataHarian = Harian::all();
        $tanggal = Carbon::now()->isoFormat('D MMMM Y');

        return view('harian.index', [
            'title' => $title,
            'dataServer' => $dataServer,
            'dataHarian' => $dataHarian,
            'tanggal' => $tanggal,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string'],
            'koneksi' => ['required', 'string'],
            'service' => ['required', 'string'],
            'tampilan' => ['required', 'string'],
            'ram' => ['required', 'string'],
            'hardisk' => ['required', 'string'],
            'pengunjung' => ['required', 'string'],
            'image' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024', 'required'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        if ($request->file('image')) {
            $gambar = $request->file('image')->store('harian-images');
        }

        $tanggal = Carbon::now()->isoFormat('D MMMM Y');
        $waktu = now()->format('H:i:s');
        $id_user = Auth::user()->id;

        Harian::create([
            'koneksi' => $request->koneksi,
            'service' => $request->service,
            'tampilan' => $request->tampilan,
            'ram' => $request->ram,
            'hardisk' => $request->hardisk,
            'pengunjung' => $request->pengunjung,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'gambar' => $gambar,
            'id_server' => $request->id,
            'id_users' => $id_user,
        ]);

        Alert::success('Berhasil', 'Data Tugas Harian telah ditambahkan');
        return redirect()->route('harian.show', $request->id);
    }

    public function show($id)
    {
        $title = "Pencatatan Tugas Harian";
        $server = Server::find($id);
        $dataHarian = Harian::where('id_server', $id)->orderBy('tanggal', 'desc')->get();

        return view('harian.create', [
            'title' => $title,
            'server' => $server,
            'dataHarian' => $dataHarian,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $dataHarian = Harian::find($id);
        if ($request->image == NULL) {
            $rule = [
                'id' => ['required', 'string'],
                'koneksi' => ['required', 'string'],
                'service' => ['required', 'string'],
                'tampilan' => ['required', 'string'],
                'ram' => ['required', 'string'],
                'hardisk' => ['required', 'string'],
                'pengunjung' => ['required', 'string'],
            ];
        }

        if ($request->oldImage == $request->image) {
            $rule = [
                'id' => ['required', 'string'],
                'koneksi' => ['required', 'string'],
                'service' => ['required', 'string'],
                'tampilan' => ['required', 'string'],
                'ram' => ['required', 'string'],
                'hardisk' => ['required', 'string'],
                'pengunjung' => ['required', 'string'],
            ];
        } else {
            $rule = [
                'id' => ['required', 'string'],
                'koneksi' => ['required', 'string'],
                'service' => ['required', 'string'],
                'tampilan' => ['required', 'string'],
                'ram' => ['required', 'string'],
                'hardisk' => ['required', 'string'],
                'pengunjung' => ['required', 'string'],
                'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            ];
        }

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        if ($request->image != NULL) {
            if ($request->file('image')) {
                $gambar = $request->file('image')->store('pencatatan-images');
            }
        } else {
            $gambar = NULL;
        }

        if ($request->oldImage != $request->image) {
            Storage::delete($request->oldImage);
            $gambar = $request->file('image')->store('pencatatan-images');
        } else {
            $gambar = $request->oldImage;
        }

        $tanggal = $dataHarian->tanggal;
        $waktu = $dataHarian->waktu;
        $id_user = $dataHarian->id_users;

        $data = [
            'koneksi' => $request->koneksi,
            'service' => $request->service,
            'tampilan' => $request->tampilan,
            'ram' => $request->ram,
            'hardisk' => $request->hardisk,
            'pengunjung' => $request->pengunjung,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'gambar' => $gambar,
            'id_server' => $request->id,
            'id_users' => $id_user,
        ];

        Harian::where('id', $id)->update($data);

        Alert::success('Berhasil', 'Data Tugas Harian telah diubah');
        return redirect()->route('harian.show', $request->id);
    }

    public function destroy($id)
    {
        Harian::findOrFail($id)->delete();
        Alert::success('Data Harian berhasil dihapus', 'success');
        return redirect()->route('harian.show', $id);
    }

    public function exportHarianId($id)
    {
        $dataHarian = Harian::where('id_server', $id)->get();
        $server = Harian::where('id_server', $id)->first();
        return view('harian.export', [
            'dataHarian' => $dataHarian,
            'server' => $server,
        ]);
    }
}
