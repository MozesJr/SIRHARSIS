<?php

namespace App\Http\Controllers;

use App\Models\Ext;
use App\Models\KetServer;
use App\Models\Level;
use App\Models\Server;
use App\Models\Software;
use App\Models\SpekServer;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    public function index()
    {
        $title = 'Server';
        $dataStatus = Status::where('id_ext', 2)->get();
        $dataLevel = Level::where('id_ext', 2)->get();
        $server = Server::all();

        return view('server.index', [
            'title' => $title,
            'status' => $dataStatus,
            'server' => $server,
            'level' => $dataLevel,
        ]);
    }

    public function show($id)
    {
        $data = Server::find($id);
        $title = $data->name;
        $ket = KetServer::where('id_servers', $id)->get();
        $spek = SpekServer::where('id_servers', $id)->get();
        $db = Ext::where('id_ext', 1)->get();

        $bahasa = Software::join('ket_servers', 'ket_servers.id', '=', 'software.id_ketServers')->where('nameS', 'Path Ket Teknologi')->first();
        $bahasa = unserialize($bahasa->ketS);
        $bahasa = explode('-', $bahasa);
        $bahasa = $bahasa[1];

        return view('server.read', [
            'server' => $data,
            'title' => $title,
            'ket' => $ket,
            'spek' => $spek,
            'dbs' => $db,
            'bahasa' => $bahasa
        ]);
    }

    public function store(Request $request)
    {
        if ($request->role == 'kete') {
            $validator = Validator::make($request->all(), [
                'ket' => ['required', 'string', 'unique:ket_servers', 'max:255'],
                'dns' => ['required', 'string',],
                'ext' => ['required', 'string'],
                'dbn' => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            $idUsers = Auth::user()->id;
            KetServer::create([
                'ket' => $request->ket,
                'dns' => $request->dns,
                'id_ext' => $request->ext,
                'ndb' => $request->dbn,
                'id_servers' => $request->id,
                'id_userss' => $idUsers,
            ]);
            Alert::success('Berhasil', 'Data Keterangan Server telah ditambahkan');
            return redirect()->route('servers.show', $request->id);
        } else if ($request->role == 'spek') {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:spek_servers', 'max:255'],
                'hostname' => ['required', 'string',],
                'ip' => ['required', 'string'],
                'lokasi' => ['required', 'string'],
                'ket' => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            $idUsers = Auth::user()->id;
            SpekServer::create([
                'name' => $request->name,
                'hostname' => $request->hostname,
                'ip' => $request->ip,
                'ket' => $request->ket,
                'lokasi' => $request->lokasi,
                'id_servers' => $request->id,
                'id_userss' => $idUsers,
            ]);
            Alert::success('Berhasil', 'Data Spesifikasi Server telah ditambahkan');
            return redirect()->route('servers.show', $request->id);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:servers', 'max:255'],
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
                'name' => $request->name,
                'ket' => $request->ket,
                'excerpt' => $excrept,
                'id_levels' => $request->level,
                'id_statuses' => $request->status
            ]);
            Alert::success('Berhasil', 'Data Server telah ditambahkan');
            return redirect()->route('servers.index');
        }
    }

    public function destroy($id)
    {
        $ulang1 = KetServer::where('id_servers', $id)->get();
        $hapus = count($ulang1);

        for ($i = 0; $i < $hapus; $i++) {
            KetServer::where('id_servers', $id)->delete();
        }

        $ulang2 = KetServer::where('id_servers', $id)->get();
        $hapus1 = count($ulang2);

        for ($i = 0; $i < $hapus1; $i++) {
            SpekServer::where('id_servers', $id)->delete();
        }

        Server::findOrFail($id)->delete();
        Alert::success('Data Server berhasil dihapus', 'success');
        return redirect()->route('servers.index');
    }
}
