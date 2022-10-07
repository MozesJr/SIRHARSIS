<?php

namespace App\Http\Controllers;

use App\Models\Ext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ExtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'EXT SERVER';
        $db = Ext::where('id_ext', 1)->get();
        $bh = Ext::where('id_ext', 2)->get();

        return view('ext.index', [
            'title' => $title,
            'db' => $db,
            'bh' => $bh,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->soft == 'dbs') {
            $cek = Ext::where('name', $request->name)->where('id_ext', 1)->first();
            if ($cek != NULL) {
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'unique:exts', 'max:255'],
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                ]);
            }

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $idExt = 1;
            Ext::create([
                'name' => $request->name,
                'id_ext' => $idExt,
            ]);

            Alert::success('Berhasil', 'Data Software telah ditambahkan');
            return redirect()->route('ext.index');
        } else if ($request->soft == 'bhs') {
            $cek = Ext::where('name', $request->name)->where('id_ext', 2)->first();
            if ($cek != NULL) {
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'unique:exts', 'max:255'],
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                ]);
            }

            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }

            $idExt = 2;
            Ext::create([
                'name' => $request->name,
                'id_ext' => $idExt,
            ]);

            Alert::success('Berhasil', 'Data Software telah ditambahkan');
            return redirect()->route('ext.index');
        } else {
            abort('404');
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->soft == 'dbs') {
            $ext = Ext::find($id);
            if ($ext->name != $request->name) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => ['required', 'unique:exts', 'max:255'],
                    ],
                    [
                        'name.unique' => 'Data ini sudah ada',
                    ],
                );

                if ($validator->fails()) {
                    Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                    return back()->withErrors($validator)->withInput();
                }

                $ext->name = $request->name;
            }
            $id_ext = 1;
            $data = [
                'name' => $ext->name,
                'id_ext' => $id_ext,
            ];

            Ext::where('id', $id)->update($data);
            Alert::success('Berhasil', 'Data Software berhasil diubah');
            return back();
        } else if ($request->soft == 'bhs') {
            $ext = Ext::find($id);
            if ($ext->name != $request->name) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => ['required', 'unique:exts', 'max:255'],
                    ],
                    [
                        'name.unique' => 'Data ini sudah ada',
                    ],
                );

                if ($validator->fails()) {
                    Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                    return back()->withErrors($validator)->withInput();
                }
                $ext->name = $request->name;
            }
            $id_ext = 2;
            $data = [
                'name' => $ext->name,
                'id_ext' => $id_ext,
            ];

            Ext::where('id', $id)->update($data);
            Alert::success('Berhasil', 'Data Software berhasil diubah');
            return back();
        } else {
            abort(404);
        }
    }
}
