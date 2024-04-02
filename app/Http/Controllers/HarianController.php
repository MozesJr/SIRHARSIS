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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Exports\HarianExport;
use App\Exports\ExcelPdfExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;

class HarianController extends Controller
{

    public function index()
    {
        $title = "Tugas Harian";
        // $dataServer = Server::all();
        $dataServer = Server::where('id_pic_idUsers', Auth::user()->id)->get();
        $dataServerAdmin = Server::all();
        $dataHarian = Harian::all();
        // dd($dataServer);
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
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string'],
            'koneksi' => ['required', 'string'],
            'tampilan' => ['required', 'string'],
            'ram' => ['required', 'string'],
            'hardisk' => ['required', 'string'],
            'backup' => ['required', 'string'],
            'dbService' => ['required', 'string'],
            'image1' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2024'],
            'image2' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2024'],
            'image3' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2024'],
            'image4' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2024'],
            'image5' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2024'],
            'image6' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2024'],
            'image7' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2024'],
            'image8' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2024'],
        ], [
            'koneksi.required' => 'Data Koneksi Harus dimasukan',
            'tampilan.required' => 'Data tampilan Harus dimasukan',
            'ram.required' => 'Data ram Harus dimasukan',
            'hardisk.required' => 'Data hardisk Harus dimasukan',
            'backup.required' => 'Data backup Harus dimasukan',
            'dbService.required' => 'Data dbService Harus dimasukan',
            'image1.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image1.file' => 'Maximal File Koneksi 2mb',
            'image2.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image2.file' => 'Maximal File Web Service 2mb',
            'image3.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image3.file' => 'Maximal File Tampilan  2mb',
            'image4.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image4.file' => 'Maximal File Ram 2mb',
            'image5.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image5.file' => 'Maximal File Hardisk 2mb',
            'image6.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image6.file' => 'Maximal File Pengunjung 2mb',
            'image7.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image7.file' => 'Maximal File Backup 2mb',
            'image8.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image8.file' => 'Maximal File Service DB 2mb',
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        $tanggal = Carbon::now()->isoFormat('D MMMM Y');

        $waktu = now()->format('H:i:s');
        $id_user = Auth::user()->id;

        if ($request->service == NULL) {
            $service = '-';
        } else {
            $service = $request->service;
        }

        if ($request->pengunjung == NULL) {
            $pengunjung = '-';
        } else {
            $pengunjung = $request->pengunjung;
        }

        $harian = Harian::create([
            'koneksi' => $request->koneksi,
            'service' => $service,
            'tampilan' => $request->tampilan,
            'ram' => $request->ram,
            'hardisk' => $request->hardisk,
            'pengunjung' => $pengunjung,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'dbService' => $request->dbService,
            'id_backup' => $request->backup,
            'id_server' => $request->id,
            'id_users' => $id_user,
        ]);

        // $compressedImage = [];
        // for ($i = 1; $i <= 8; $i++) {

        //     $compressedImage[$i] = $request->file('image' . $i);
        //     if ($compressedImage[$i] == NULL) {
        //         $compressedImage[$i] = 'gambar.jpg';
        //     }
        //     $fileName = time() . rand(1, 99) . '.' . $compressedImage[$i]->extension();
        //     $compressedImage[$i]->move(public_path('storage'), $fileName);
        //     $data = [
        //         'image' . $i => $fileName,
        //     ];

        //     Harian::where('id', $harian->id)->update($data);
        // }

        $compressedImage = [];
        for ($i = 1; $i <= 8; $i++) {
            $compressedImage[$i] = $request->file('image' . $i);
            if ($compressedImage[$i] == NULL) {
                $fileName = 'gambar.jpg';
            } else {
                $fileName = time() . rand(1, 99) . '.' . $compressedImage[$i]->extension();
                $compressedImage[$i]->move(public_path('storage'), $fileName);
            }
            $data = [
                'image' . $i => $fileName,
            ];

            Harian::where('id', $harian->id)->update($data);
        }


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

        Alert::success('Berhasil', 'Data Tugas Harian telah ditambahkan');
        return redirect()->route('harian.show', $request->id);
    }

    private function compressAndStoreImage($image)
    {
        $compressedImage = Image::make($image)
            ->resize(800, 600)
            ->save('public/image/harian', 80);
        $path = Storage::put('public/image/harian/compress', $compressedImage->encode(), 'public');
        return $path;
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
            $dataGfafik = Harian::select('ram', 'hardisk', 'pengunjung', 'tanggal', 'waktu')
                ->where('id_server', $id)
                ->whereYear('created_at', date('Y'))
                ->get();
        }

        if (count($dataGfafik) <= 0) {
            $dataGfafik = NULL;
        }

        // dd($dataHarian);

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
        $validator = Validator::make($request->all(), [
            'koneksi' => ['required', 'string'],
            'service' => ['required', 'string'],
            'tampilan' => ['required', 'string'],
            'ram' => ['required', 'string'],
            'hardisk' => ['required', 'string'],
            'backup' => ['required', 'string'],
            'dbService' => ['required', 'string'],
            'image1' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'image2' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'image3' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'image4' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'image5' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'image6' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'image7' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'image8' => ['file', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
        ], [
            'koneksi.required' => 'Data Koneksi Harus dimasukan',
            'service.required' => 'Data service Harus dimasukan',
            'tampilan.required' => 'Data tampilan Harus dimasukan',
            'ram.required' => 'Data ram Harus dimasukan',
            'hardisk.required' => 'Data hardisk Harus dimasukan',
            'backup.required' => 'Data backup Harus dimasukan',
            'dbService.required' => 'Data dbService Harus dimasukan',
            'image1.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image1.file' => 'Maximal File 1mb',
            'image2.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image2.file' => 'Maximal File 1mb',
            'image3.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image3.file' => 'Maximal File 1mb',
            'image4.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image4.file' => 'Maximal File 1mb',
            'image5.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image5.file' => 'Maximal File 1mb',
            'image6.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image6.file' => 'Maximal File 1mb',
            'image7.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image7.file' => 'Maximal File 1mb',
            'image8.file' => 'File Harus berformat jpeg, png, jpg, gif, svg',
            'image8.file' => 'Maximal File 1mb',
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        // Find the record to update
        $harian = Harian::findOrFail($id);

        if ($request->image1 != NULL) {
            $image1 = $request->image1;
            $image1 = $request->file('image1');
            $fileName1 = time() . rand(1, 99) . '.' . $image1->extension();
            $image1->move(public_path('storage'), $fileName1);
        } else {
            $fileName1 = $harian->image1;
        }

        if ($request->image2 != NULL) {
            $image2 = $request->image2;
            $image2 = $request->file('image2');
            $fileName2 = time() . rand(1, 99) . '.' . $image2->extension();
            $image2->move(public_path('storage'), $fileName2);
        } else {
            $fileName2 = $harian->image2;
        }

        if ($request->image3 != NULL) {
            $image3 = $request->image3;
            $image3 = $request->file('image3');
            $fileName3 = time() . rand(1, 99) . '.' . $image3->extension();
            $image3->move(public_path('storage'), $fileName3);
        } else {
            $fileName3 = $harian->image3;
        }

        if ($request->image4 != NULL) {
            $image4 = $request->image4;
            $image4 = $request->file('image4');
            $fileName4 = time() . rand(1, 99) . '.' . $image4->extension();
            $image4->move(public_path('storage'), $fileName4);
        } else {
            $fileName4 = $harian->image4;
        }

        if ($request->image5 != NULL) {
            $image5 = $request->image5;
            $image5 = $request->file('image5');
            $fileName5 = time() . rand(1, 99) . '.' . $image5->extension();
            $image5->move(public_path('storage'), $fileName5);
        } else {
            $fileName5 = $harian->image5;
        }

        if ($request->image6 != NULL) {
            $image6 = $request->image6;
            $image6 = $request->file('image6');
            $fileName6 = time() . rand(1, 99) . '.' . $image6->extension();
            $image6->move(public_path('storage'), $fileName6);
        } else {
            $fileName6 = $harian->image6;
        }
        if ($request->image7 != NULL) {
            $image7 = $request->image7;
            $image7 = $request->file('image7');
            $fileName7 = time() . rand(1, 99) . '.' . $image7->extension();
            $image7->move(public_path('storage'), $fileName7);
        } else {
            $fileName7 = $harian->image7;
        }
        if ($request->image8 != NULL) {
            $image8 = $request->image8;
            $image8 = $request->file('image8');
            $fileName8 = time() . rand(1, 99) . '.' . $image8->extension();
            $image8->move(public_path('storage'), $fileName8);
        } else {
            $fileName8 = $harian->image8;
        }

        $harian->update([
            'koneksi' => $request->koneksi,
            'service' => $request->service,
            'tampilan' => $request->tampilan,
            'ram' => $request->ram,
            'hardisk' => $request->hardisk,
            'pengunjung' => $request->pengunjung,
            'dbService' => $request->dbService,
            'id_backup' => $request->backup,
            'image1' => $fileName1,
            'image2' => $fileName2,
            'image3' => $fileName3,
            'image4' => $fileName4,
            'image5' => $fileName5,
            'image6' => $fileName6,
            'image7' => $fileName7,
            'image8' => $fileName8,
        ]);

        Alert::success('Berhasil', 'Data Tugas Harian telah diperbarui');
        return redirect()->route('harian.show', $harian->id_server);
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
        $server = Harian::where('id_server', $id)->first();
        $date = date('d-m-Y');
        return Excel::download(new HarianExport($id), 'Data Harian ' . $server->Server->nameServer . '-' . $date . '.xlsx');
    }

    public function exportHarianRange(Request $request, $id)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $server = Harian::where('id_server', $id)->first();

        $filename = 'Data Harian ' . $server->Server->nameServer . '-' . $awal . '-' . $akhir . '.xlsx';

        return Excel::download(new HarianExport($id, $awal, $akhir), $filename);
    }

    private function getData($server, $awal, $akhir)
    {
        $query = Harian::where('id_server', $server->id);

        if ($awal && $akhir) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$awal, $akhir]);
        }

        return $query->get();
    }

    public function generatePDF(Request $request, $id)
    {
        return (new ExcelPdfExport())->exportPdf($id);

        // $nameServer = Harian::where('id_server', $id)->first();
        // $date = date('d-m-Y');
        // $server = Harian::where('id_server', $id)->get();

        // return view('pdf.view', [
        //     'server' => $server,
        //     'nameServer' => $nameServer,
        // ]);
    }

    public function generatePDFRange(Request $request)
    {
        $id = $request->input('id_server');
        $start = $request->input('start');
        $end = $request->input('end');
        return (new ExcelPdfExport())->exportPdf($id, $start, $end);
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


        return view('harian.add1', [
            'title' => $title,
            'dataBackup' => $backup,
            'server' => $server,
        ]);
    }

    public function updateHarian($id)
    {
        $title = 'Ubah Data Harian';
        $backup = DataBackup::all();
        $server = Harian::find($id);
        // $gambar = ImageGallery::where('id_harian', $id)->get();

        // dd($server);
        return view('harian.update1', [
            'server' => $server,
            'title' => $title,
            // 'gambar' => $gambar,
            'dataBackup' => $backup
        ]);
    }
}
