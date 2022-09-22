<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class StatusController extends Controller
{
    public function index()
    {
        $title = 'Status Penugasan';
        $dataStatus = Status::all();

        return view('status.index', [
            'title' => $title,
            'status' => $dataStatus,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'string', 'unique:statuses', 'max:255'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        Status::create([
            'status' => $request->status,
        ]);

        Alert::success('Berhasil', 'Data status telah ditambahkan');
        return redirect()->route('status.index');
    }

    public function update(Request $request, $id)
    {
        $status = Status::find($id);
        if ($status->status != $request->status) {
            $validator = Validator::make(
                $request->all(),
                [
                    'status' => ['required', 'unique:statuses', 'max:255'],
                ],
                [
                    'status.unique' => 'Data ini sudah ada',
                ],
            );

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            $status->status = $request->status;
        }

        $data = [
            'status' => $status->status,
        ];

        Status::where('id', $id)->update($data);
        Alert::success('Berhasil', 'Data status berhasil diubah');
        return back();
    }
}
