<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class StatussController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Status Server';
        $dataStatus = Status::where('id_ext', 2)->get();

        return view('status.index', [
            'title' => $title,
            'status' => $dataStatus,
        ]);
    }

    public function store(Request $request)
    {
        $cek = Status::where('status', $request->status)->where('id_ext', 2)->first();

        if ($cek != NULL) {
            $validator = Validator::make($request->all(), [
                'status' => ['required', 'string', 'unique:statuses', 'max:255'],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'status' => ['required', 'string', 'max:255'],
            ]);
        }

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        Status::create([
            'status' => $request->status,
            'id_ext' => 2,
        ]);

        Alert::success('Berhasil', 'Data Status Server telah ditambahkan');
        return redirect()->route('statuss.index');
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
            'id_ext' => 2,
        ];

        Status::where('id', $id)->update($data);
        Alert::success('Berhasil', 'Data Status Server berhasil diubah');
        return back();
    }
}
