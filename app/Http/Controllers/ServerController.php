<?php

namespace App\Http\Controllers;

use App\Exports\ServerExport;
use App\Models\BhsPrg;
use App\Models\Engine;
use App\Models\EngineDB;
use App\Models\Ext;
use App\Models\IpAddress;
use App\Models\KetServer;
use App\Models\Level;
use App\Models\Path;
use App\Models\PathApp;
use App\Models\PathDB;
use App\Models\Server;
use App\Models\Software;
use App\Models\SpekServer;
use App\Models\Status;
use App\Models\TglGo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ServerController extends Controller
{
    public function index()
    {
        $title = 'Server';
        $dataStatus = Status::where('id_ext', 2)->get();
        $dataLevel = Level::where('id_ext', 2)->get();
        // $server = Server::where()->groupBy('nameServer');
        $server = Server::all();
        // dd($server);

        return view('server.index', [
            'title' => $title,
            'status' => $dataStatus,
            'server' => $server,
            'level' => $dataLevel,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->reqS == "no1") {
            $validator = Validator::make($request->all(), [
                'nameServer' => ['required', 'string', 'unique:servers', 'max:255'],
                'ket' => ['required', 'string',],
                'status' => ['required', 'string',],
                'level' => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            $excrept = Str::limit(strip_tags($request->ket), 30);
            Server::create([
                'nameServer' => $request->nameServer,
                'ket' => $request->ket,
                'excerpt' => $excrept,
                'id_levels' => $request->level,
                'id_statuses' => $request->status
            ]);
            Alert::success('Berhasil', 'Data Server telah ditambahkan');
            return redirect()->route('servers.index');
        } else if ($request->reqS == "no2") {
            $server = Server::find($request->id);
            if ($server->ketServer == null) {
                $validator = Validator::make($request->all(), [
                    'ketServer' => ['required', 'string', 'max:255'],
                    'ipAddress' => ['required', 'string',],
                    'engineDB' => ['required', 'string',],
                    'engineApp' => ['required', 'string',],
                    'pathDB' => ['required', 'string',],
                    'pathApp' => ['required', 'string',],
                ]);
                if ($validator->fails()) {
                    Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                    return back()->withErrors($validator)->withInput();
                }
                $ip = IpAddress::create([
                    'ipAddress' => $request->ipAddress
                ]);
                $pathApp = PathApp::create([
                    'path' => $request->pathApp
                ]);
                $pathDB = PathDB::create([
                    'path' => $request->pathDB
                ]);
                $data = [
                    'ketServer' => $request->ketServer,
                    'id_ipAddress' => $ip->id,
                    'id_pathDB' => $pathDB->id,
                    'id_pathApp' => $pathApp->id,
                    'id_enDB' => $request->engineDB,
                    'id_enApp' => $request->engineApp,
                ];
                Server::where('id', $server->id)->update($data);
                Alert::success('Berhasil', 'Data Server telah ditambahkan');
                return redirect()->route('servers.show', $server->id);
            } else {
                $server = Server::find($request->id);
                $validator = Validator::make($request->all(), [
                    'ketServer' => ['required', 'string', 'max:255'],
                    'ipAddress' => ['required', 'string',],
                    'engineDB' => ['required', 'string',],
                    'engineApp' => ['required', 'string',],
                    'pathDB' => ['required', 'string',],
                    'pathApp' => ['required', 'string',],
                ]);
                if ($validator->fails()) {
                    Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                    return back()->withErrors($validator)->withInput();
                }
                // dd($server);

                $ip = IpAddress::create([
                    'ipAddress' => $request->ipAddress
                ]);

                $pathApp = PathApp::create([
                    'path' => $request->pathApp
                ]);

                $pathDB = PathDB::create([
                    'path' => $request->pathDB
                ]);
                $nameServer = $server->nameServer;
                $ket = $server->ket;
                $excrept1 = $server->excerpt;
                $status = $server->id_statuses;
                $level = $server->id_levels;

                $data = [
                    'nameServer' => $nameServer,
                    'ket' => $ket,
                    'ketServer' => $request->ketServer,
                    'excerpt' => $excrept1,
                    'id_statuses' => $status,
                    'id_levels' => $level,
                    'id_ipAddress' => $ip->id,
                    'id_pathDB' => $pathDB->id,
                    'id_pathApp' => $pathApp->id,
                    'id_enDB' => $request->engineDB,
                    'id_enApp' => $request->engineApp,
                ];
                Server::create($data);
                Alert::success('Berhasil', 'Data Server telah ditambahkan');
                return redirect()->route('servers.show', $server->id);
            }
        }
    }

    public function show($id)
    {
        $data = Server::find($id);
        $title = $data->nameServer;
        $engineDB = EngineDB::all();
        $engineApp = Engine::all();
        $dataServer = Server::where('nameServer', $data->nameServer)->get();

        return view('server.read', [
            'server' => $data,
            'title' => $title,
            'engineApp' => $engineApp,
            'engineDB' => $engineDB,
            'dataServer' => $dataServer,
        ]);
    }

    public function destroy($id)
    {
    }


    public function exportExcel()
    {
        $nama_file = 'laporan_Server_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new ServerExport, $nama_file);
    }

    public function showServer($id)
    {
        $title = "Show Server";
        $dataServer = Server::find($id);
        $user = User::all();
        $dataBase = EngineDB::all();
        $app = Engine::all();
        // dd($user);
        return view('server.showServer', [
            'title' => $title,
            'dataServer' => $dataServer,
            'dataUser' => $user,
            'engineDB' => $dataBase,
            'engineApp' => $app,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->reqS == 'no3') {
            $server = Server::find($id);
            $validator = Validator::make($request->all(), [
                'ketApp' => ['required', 'string', 'max:255'],
                'dnsApp' => ['required', 'string',],
                'pathAkses' => ['required', 'string',],
                'tglGo' => ['required', 'string',],
                'bpo' => ['required', 'string',],
                'intgs' => ['required', 'string',],
                'pic' => ['required', 'string',],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            if ($server->id_pathAkses == NULL) {
                $pathAkses = Path::create([
                    'path' => $request->pathAkses
                ]);
                $pathAkses = $pathAkses->id;
            } else {
                $dataPathAkses = [
                    'path' => $request->pathAkses
                ];
                Path::where('id', $server->id_pathAkses)->update($dataPathAkses);
                $pathAkses = $server->id_pathAkses;
            }

            if ($server->id_tglGo == NULL) {
                $tglGo = TglGo::create([
                    'tglGo' => $request->tglGo
                ]);
                $tglGo = $tglGo->id;
            } else {
                $dataTglGo = [
                    'tglGo' => $request->tglGo
                ];
                TglGo::where('id', $server->id_tglGo)->update($dataTglGo);
                $tglGo = $server->id_tglGo;
            }

            $dataIp = [
                'ipAddress' => $request->dnsApp
            ];

            IpAddress::where('id', $server->DNS->id)->update($dataIp);

            $data = [
                'ketServer' => $request->ketApp,
                'id_ipAddress' => $server->DNS->id,
                'id_pathAkses' => $pathAkses,
                'id_tglGo' => $tglGo,
                'bpo' => $request->bpo,
                'intgs' => $request->intgs,
                'id_pic_idUsers' => $request->pic,
            ];
            Server::where('id', $server->id)->update($data);
            Alert::success('Berhasil', 'Data Server telah ditambahkan');
            return redirect()->route('showServer', $server->id);
        } else if ($request->reqS == 'no4') {
            // dd($request->all());
            $server = Server::find($id);
            $validator = Validator::make($request->all(), [
                'enDB' => ['required', 'string', 'max:255'],
                'nDB' => ['required', 'string',],
                'pathDB' => ['required', 'string',],
                'usDB' => ['required', 'string',],
                'psDB' => ['required', 'string',],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $pathDB = [
                'path' => $request->pathDB,
            ];

            $db = PathDB::where('id', $server->id_pathDB)->update($pathDB);

            $data = [
                'id_enDB' => $request->enDB,
                'nDB' => $request->nDB,
                'id_pathDB' => $server->id_pathDB,
                'usDB' => $request->usDB,
                'psDB' => $request->psDB,
            ];
            Server::where('id', $server->id)->update($data);
            Alert::success('Berhasil', 'Data Server telah ditambahkan');
            return redirect()->route('showServer', $server->id);
        } else if ($request->reqS == 'no5') {
            // dd($request->all());
            $server = Server::find($id);
            $validator = Validator::make($request->all(), [
                'bhsKetPrg' => ['required', 'string', 'max:255'],
                'enApp' => ['required', 'string',],
                'pathKetPrg' => ['required', 'string',],
                'usApp' => ['required', 'string',],
                'psApp' => ['required', 'string',],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            if ($server->id_bhsApp == NULL) {
                $bhsApp = BhsPrg::create([
                    'bhs_prg' => $request->bhsKetPrg
                ]);
                $bhsApp = $bhsApp->id;
            } else {
                $bhsApp = [
                    'bhs_prg' => $request->bhsKetPrg
                ];
                TglGo::where('id', $server->id_bhsApp)->update($bhsApp);
                $bhsApp = $server->id_bhsApp;
            }

            $pathApp = [
                'path' => $request->pathKetPrg,
            ];

            $app = PathApp::where('id', $server->id_pathApp)->update($pathApp);

            $data = [
                'id_bhsApp' => $bhsApp,
                'id_enApp' => $request->enApp,
                'id_pathApp' => $server->id_pathApp,
                'usApp' => $request->usApp,
                'psApp' => $request->psApp,
            ];
            Server::where('id', $server->id)->update($data);
            Alert::success('Berhasil', 'Data Server telah ditambahkan');
            return redirect()->route('showServer', $server->id);
        } else if ($request->reqS == 'no6') {
            // dd($request->all());
            $server = Server::find($id);
            $validator = Validator::make($request->all(), [
                'hostname' => ['required', 'string', 'max:255'],
                'lokasi' => ['required', 'string', 'max:255'],
                'os' => ['required', 'string', 'max:255'],
                'cpu' => ['required', 'string', 'max:255'],
                'memory' => ['required', 'string', 'max:255'],
                'hdd' => ['required', 'string', 'max:255'],
                'terpakai' => ['required', 'string', 'max:255'],
                'usServer' => ['required', 'string', 'max:255'],
                'psServer' => ['required', 'string', 'max:255'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $data = [
                'hostName' => $request->hostname,
                'lokasi' => $request->lokasi,
                'os' => $request->os,
                'cpu' => $request->cpu,
                'memory' => $request->memory,
                'hdd' => $request->hdd,
                'terpakai' => $request->terpakai,
                'usServer' => $request->usServer,
                'psServer' => $request->psServer,
            ];
            Server::where('id', $server->id)->update($data);
            Alert::success('Berhasil', 'Data Server telah ditambahkan');
            return redirect()->route('showServer', $server->id);
        } else {
            abort(404);
        }
    }
}
