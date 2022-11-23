<?php

namespace App\Http\Controllers;

use App\Models\Harian;
use App\Models\ImageGallery;
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
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        $tanggal = Carbon::now()->isoFormat('D MMMM Y');
        $waktu = now()->format('H:i:s');
        $id_user = Auth::user()->id;

        $harian = Harian::create([
            'koneksi' => $request->koneksi,
            'service' => $request->service,
            'tampilan' => $request->tampilan,
            'ram' => $request->ram,
            'hardisk' => $request->hardisk,
            'pengunjung' => $request->pengunjung,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'id_server' => $request->id,
            'id_users' => $id_user,
        ]);

        // dd($harian);

        $files = [];
        foreach ($request->file('image') as $key => $file) {
            $fileName = time() . rand(1, 99) . '.' . $file->extension();
            $file->move(public_path('uploads-harian'), $fileName);
            $files[]['original_filename'] = $fileName;
        }

        foreach ($files as $key => $file) {
            $dataImage = ImageGallery::create($file);

            $data = [
                'id_harian' => $harian->id,
            ];

            ImageGallery::where('id', $dataImage->id)->update($data);
        }

        Alert::success('Berhasil', 'Data Tugas Harian telah ditambahkan');
        return redirect()->route('harian.show', $request->id);
    }

    public function show($id)
    {
        $title = "Pencatatan Tugas Harian";
        $server = Server::find($id);
        $dataHarian = Harian::where('id_server', $id)->orderBy('tanggal', 'desc')->get();
        $gambar = ImageGallery::where('id_harian', $id)->get();
        // dd($gambar);

        return view('harian.create', [
            'title' => $title,
            'server' => $server,
            'dataHarian' => $dataHarian,
            'gambar' => $gambar,
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
            'id_server' => $request->id,
            'id_users' => $id_user,
        ];

        Harian::where('id', $id)->update($data);

        $files = [];
        foreach ($request->file('image') as $key => $file) {
            $fileName = time() . rand(1, 99) . '.' . $file->extension();
            $file->move(public_path('uploads-harian'), $fileName);
            $files[]['original_filename'] = $fileName;
        }

        foreach ($files as $key => $file) {
            $dataImage = ImageGallery::create($file);

            $data = [
                'id_harian' => $id,
            ];

            ImageGallery::where('id', $dataImage->id)->update($data);
        }

        Alert::success('Berhasil', 'Data Tugas Harian telah diubah');
        return redirect()->route('harian.show', $request->id);
    }

    public function destroy($id)
    {
        $harian = Harian::find($id);

        $dataGambar = ImageGallery::where('id_harian', $id)->get();

        foreach ($dataGambar as $data) {
            Storage::delete('uploads-harian/' . $data->original_filename);
        }

        ImageGallery::where('id_harian', $id)->delete();
        Harian::findOrFail($id)->delete();
        Alert::success('Data Harian berhasil dihapus', 'success');
        return redirect()->route('harian.show', $harian->id_server);
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
