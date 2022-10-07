<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use App\Models\SpekServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SpekServerController extends Controller
{
    public function show($id)
    {
        $title = 'Data Spesifikasi Server';
        $data = SpekServer::find($id);
        $dataSpek = Hardware::where('nameH', 'Spek Server')->where('id_ketServers', $id)->first();
        return view('spekServer.read', [
            'title' => $title,
            'data' => $data,
            'dataSpek' => $dataSpek,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'osSpek' => ['required', 'string'],
            'cpuSpek' => ['required', 'string'],
            'memorySpek' => ['required', 'string'],
            'hddSpek' => ['required', 'string'],
            'hddTSpek' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
            return back()->withErrors($validator)->withInput();
        }

        $cari = Hardware::where('nameH', 'Spek Server')->where('id_ketServers', $id)->first();

        if ($cari == NULL) {
            $nameS = "Spek Server";
            $ketS = serialize($request->osSpek . '-' . $request->cpuSpek . '-' . $request->memorySpek . '-' . $request->hddSpek . '-' . $request->hddTSpek);
            Hardware::create([
                'nameH' => $nameS,
                'ketH' => $ketS,
                'id_ketServers' => $id,
            ]);
        } else {
            $ketS = serialize($request->osSpek . '-' . $request->cpuSpek . '-' . $request->memorySpek . '-' . $request->hddSpek . '-' . $request->hddTSpek);
            $data = [
                'ketH' => $ketS,
            ];
            Hardware::where('id', $cari->id)->update($data);
        }

        Alert::success('Berhasil', 'Data Spesifikasi Server telah ditambahkan');
        return redirect()->route('spekServer.show', $id);
    }
}
