<?php

namespace App\Http\Controllers;

use App\Models\DataBackup;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DataBackupController extends Controller
{
    public function index()
    {
        $title = 'Data Kondisi Backup Server';
        $backup = DataBackup::all();
        return view('backup.index', [
            'title' => $title,
            'dataBackup' => $backup,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'backup' => ['required', 'string', 'unique:data_backups', 'max:255'],
        ]);
        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }
        DataBackup::create([
            'backup' => $request->backup,
        ]);
        Alert::success('Berhasil', 'Data backup APP telah ditambahkan');
        return redirect()->route('backup.index');
    }

    public function update(Request $request, $id)
    {
        $backup = DataBackup::find($id);
        if ($backup->backup != $request->backup) {
            $validator = Validator::make(
                $request->all(),
                [
                    'backup' => ['required', 'unique:data_backups', 'max:255'],
                ],
                [
                    'backup.unique' => 'Data ini sudah ada',
                ],
            );

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            $backup->backup = $request->backup;
        }

        $data = [
            'backup' => $backup->backup,
        ];

        DataBackup::where('id', $id)->update($data);
        Alert::success('Berhasil', 'Data backup berhasil diubah');
        return back();
    }
}
