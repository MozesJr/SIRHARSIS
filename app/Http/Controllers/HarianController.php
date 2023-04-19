<?php

namespace App\Http\Controllers;

use App\Models\DataBackup;
use Carbon\Carbon;
use App\Models\Harian;
use App\Models\Server;
use App\Models\Pencatatan;
use App\Models\ImageGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class HarianController extends Controller
{

    public function index()
    {
        $title = "Tugas Harian";
        // $dataServer = Server::all();
        $dataServer = Server::where('id_pic_idUsers', Auth::user()->id)->get();
        $dataServerAdmin = Server::all();
        $dataHarian = Harian::all();
        $tanggal = Carbon::now()->isoFormat('D MMMM Y');

        return view('harian.index', [
            'title' => $title,
            'dataServer' => $dataServer,
            'dataServerAdmin' => $dataServerAdmin,
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
            // 'pengunjung' => ['required', 'string'],
            'backup' => ['required', 'string'],
            'dbService' => ['required', 'string'],
            'image*' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
        ], [
            'image.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image.file' => 'Maximal File 1mb',
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
            'dbService' => $request->dbService,
            'id_backup' => $request->backup,
            'id_server' => $request->id,
            'id_users' => $id_user,
        ]);

        $waktu = $harian->waktu;
        $awal = substr($waktu, -8, 2);
        if ($awal >= 00 && $awal <= 12) {
            $waktu = 'Pencatatan ke - 1';
        } elseif ($awal >= 12 && $awal <= 15) {
            $waktu = 'Pencatatan ke - 2';
        } elseif ($awal >= 15 && $awal <= 24) {
            $waktu = 'Pencatatan ke - 3';
        }

        $tanggal = Carbon::now()->format('Y-m-d');

        $pencatatan = Pencatatan::create([
            'judul' => $waktu,
            'catatan' => $waktu,
            'tanggal' => $tanggal,
            'excerpt' => $waktu,
            'id_users' => $id_user,
        ]);

        // dd($harian);

        $files = [];
        foreach ($request->file('image') as $key => $file) {
            $fileName = time() . rand(1, 99) . '.' . $file->extension();
            $file->move(public_path('storage'), $fileName);
            $files[]['original_filename'] = $fileName;
            // $file = $request->file('image')->store('harian-image');
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

    public function show(Request $request, $id)
    {
        $title = "Pencatatan Tugas Harian";
        $server = Server::find($id);
        $dataHarian = Harian::where('id_server', $id)->orderBy('tanggal', 'desc')->get();
        $gambar = ImageGallery::where('id_harian', $id)->get();
        $backup = DataBackup::all();

        if ($request->awal && $request->akhir != NULL) {
            $tanggal_awal = Carbon::parse($request->awal)->isoFormat('D MMMM Y');
            $tanggal_akhir = Carbon::parse($request->akhir)->isoFormat('D MMMM Y');
            $dataGfafik = Harian::select('ram', 'hardisk', 'pengunjung', 'tanggal', 'waktu')->Where('id_server', $id)->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->get();
        } else {
            $dataGfafik = Harian::select('ram', 'hardisk', 'pengunjung', 'tanggal', 'waktu')->Where('id_server', $id)->get();
        }

        if (count($dataGfafik) <= 0) {
            $dataGfafik = NULL;
        }

        // dd($dataGfafik);

        return view('harian.create', [
            'title' => $title,
            'server' => $server,
            'dataHarian' => $dataHarian,
            'gambar' => $gambar,
            'dataBackup' => $backup,
            'dataGrafik' => $dataGfafik,

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
        $dataServer = $dataHarian->id_server;

        $data = [
            'koneksi' => $request->koneksi,
            'service' => $request->service,
            'tampilan' => $request->tampilan,
            'ram' => $request->ram,
            'hardisk' => $request->hardisk,
            'pengunjung' => $request->pengunjung,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'id_server' => $dataServer,
            'id_users' => $id_user,
        ];

        Harian::where('id', $id)->update($data);

        Alert::success('Berhasil', 'Data Tugas Harian telah diubah');
        return redirect()->route('harian.show', $dataHarian->id_server);
    }

    public function destroy($id)
    {
        $harian = Harian::find($id);

        $dataGambar = ImageGallery::where('id_harian', $id)->get();

        if ($dataGambar != NULL) {
            foreach ($dataGambar as $data) {
                Storage::delete($data->original_filename);
            }
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

    public function exportPdfHarian($id)
    {
        $server = Server::find($id);
        $dataGfafik = Harian::select('ram', 'hardisk', 'pengunjung', 'tanggal', 'waktu')->Where('id_server', $id)->get();

        return view('harian.exportPdf', [
            'dataGrafik' => $dataGfafik,
            'server'   => $server,
        ]);
    }

    public function addHarian($id)
    {
        $title = 'Tambah Data Harian';
        $backup = DataBackup::all();
        $server = Server::find($id);

        return view('harian.add', [
            'title' => $title,
            'dataBackup' => $backup,
            'server' => $server,
        ]);
    }

    public function updateHarian($id)
    {
        $title = 'Ubah Data Harian';
        $server = Harian::find($id);
        $gambar = ImageGallery::where('id_harian', $id)->get();

        // dd($gambar);
        return view('harian.update', [
            'server' => $server,
            'title' => $title,
            'gambar' => $gambar,
        ]);
    }
}
