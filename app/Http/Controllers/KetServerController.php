<?php

namespace App\Http\Controllers;

use App\Models\Ext;
use App\Models\KetServer;
use App\Models\Software;
use App\Models\UserServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KetServerController extends Controller
{
    public function index()
    {
    }

    public function show($id)
    {
        $title = 'Data Keterangan Server';
        $data = KetServer::find($id);
        $db = Ext::where('id_ext', 1)->get();
        $dataSoftKet = Software::where('nameS', 'Path Keterangan')->where('id_ketServers', $id)->first();
        $dataDBKet = Software::where('nameS', 'Path Ket Database')->where('id_ketServers', $id)->first();
        $dataPrgKet = Software::where('nameS', 'Path Ket Teknologi')->where('id_ketServers', $id)->first();
        $dataAkses = UserServer::where('id_ket_servers', $id)->get();
        $dataH = count($dataAkses);
        return view('ketServer.read', [
            'title' => $title,
            'dataKet' => $data,
            'dbs' => $db,
            'dataSoftKet' => $dataSoftKet,
            'dataDBKet' => $dataDBKet,
            'dataPrgKet' => $dataPrgKet,
            'dataAkses' => $dataAkses,
            'dataH' => $dataH,
        ]);
    }

    public function update(Request $request, $id)
    {
        //Keterangan App
        if ($request->keterangan == "ketApp") {
            $validator = Validator::make($request->all(), [
                'ketApp' => ['required', 'string'],
                'dnsApp' => ['required', 'string',],
                'ketDB' => ['required', 'string'],
                'nameDbs' => ['required', 'string'],
                'pathApp' => ['required', 'string'],
                'pathDB' => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $data = [
                'ket' => $request->ketApp,
                'dns' => $request->dnsApp,
                'id_ext' => $request->ketDB,
                'ndb' => $request->nameDbs,
            ];

            KetServer::where('id', $id)->update($data);

            $cari = Software::where('nameS', 'Path Keterangan')->where('id_ketServers', $id)->first();

            if ($cari == NULL) {
                $nameS = "Path Keterangan";
                $ketS = serialize($request->pathApp . '-' . $request->pathDB);
                Software::create([
                    'nameS' => $nameS,
                    'ketS' => $ketS,
                    'id_ketServers' => $id,
                ]);
            } else {
                $ketS = serialize($request->pathApp . '-' . $request->pathDB);
                $data = [
                    'ketS' => $ketS,
                ];
                Software::where('id', $cari->id)->update($data);
            }

            Alert::success('Berhasil', 'Data Keterangan Server telah ditambahkan');
            return redirect()->route('ketServer.show', $id);
        } //DB APP
        else if ($request->keterangan == "dbApp") {
            $validator = Validator::make($request->all(), [
                'usDBKet' => ['required', 'string'],
                'psDBKet' => ['required', 'string'],
                'pathDBKet' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $cari = Software::where('nameS', 'Path Ket Database')->where('id_ketServers', $id)->first();

            if ($cari == NULL) {
                $nameS = "Path Ket Database";
                $ketS = serialize($request->usDBKet . '-' . $request->psDBKet . '-' . $request->pathDBKet);
                Software::create([
                    'nameS' => $nameS,
                    'ketS' => $ketS,
                    'id_ketServers' => $id,
                ]);
            } else {
                $ketS = serialize($request->usDBKet . '-' . $request->psDBKet . '-' . $request->pathDBKet);
                $data = [
                    'ketS' => $ketS,
                ];
                Software::where('id', $cari->id)->update($data);
            }

            Alert::success('Berhasil', 'Data Keterangan DB Server telah ditambahkan');
            return redirect()->route('ketServer.show', $id);
        } //Program APP
        else if ($request->keterangan == "prgApp") {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'bhsKetPrg' => ['required', 'string'],
                'fmKetPrg' => ['required', 'string'],
                'pathKetPrg' => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            $cari = Software::where('nameS', 'Path Ket Teknologi')->where('id_ketServers', $id)->first();
            if ($cari == NULL) {
                $nameS = "Path Ket Teknologi";
                $ketS = serialize($request->bhsKetPrg . '-' . $request->fmKetPrg . '-' . $request->pathKetPrg);
                Software::create([
                    'nameS' => $nameS,
                    'ketS' => $ketS,
                    'id_ketServers' => $id,
                ]);
            } else {
                $ketS = serialize($request->bhsKetPrg . '-' . $request->fmKetPrg . '-' . $request->pathKetPrg);
                $data = [
                    'ketS' => $ketS,
                ];
                Software::where('id', $cari->id)->update($data);
            }

            Alert::success('Berhasil', 'Data Keterangan Teknologi Server telah ditambahkan');
            return redirect()->route('ketServer.show', $id);
        } //Akses APP
        else if ($request->keterangan == "aksesApp") {
            $validator = Validator::make($request->all(), [
                'aksesAks' => ['required'],
                'usAks' => ['required'],
                'psAks' => ['required'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $cari = UserServer::where('akses', $request->aksesAks)->where('id_ket_servers', $id)->first();
            if ($cari == NULL) {
                $idUser = Auth::user()->id;
                $ulang = count($request->aksesAks);
                for ($i = 0; $i < $ulang; $i++) {
                    UserServer::create([
                        'akses' => $request->aksesAks[$i],
                        'username' => $request->usAks[$i],
                        'password' => $request->psAks[$i],
                        'id_ket_servers' => $id,
                        'id_users' => $idUser,
                    ]);
                }
            } else {
                $dataUserServer = UserServer::where('id_ket_servers', $id)->get();
                $ulang1 = count($dataUserServer);
                for ($i = 0; $i < $ulang1; $i++) {
                    $dataUser = [
                        'akses' => $request->aksesAks[$i],
                        'username' => $request->usAks[$i],
                        'password' => $request->psAks[$i],
                    ];
                    UserServer::where('id', $request->idUserServer[$i])->update($dataUser);
                }
            }
            Alert::success('Berhasil', 'Data Keterangan Akses Server telah ditambahkan');
            return redirect()->route('ketServer.show', $id);
        } else {
            abort(404);
        }
    }
}
