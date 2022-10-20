<?php

namespace App\Http\Controllers;

use App\Models\Engine;
use App\Models\EngineDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EngineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Engine';
        $db = EngineDB::all();
        $app = Engine::all();

        return view('engine.index', [
            'title' => $title,
            'db' => $db,
            'app' => $app
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->eng == 'DB') {
            $validator = Validator::make($request->all(), [
                'engine' => ['required', 'string', 'unique:engine_d_b_s', 'max:255'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            EngineDB::create([
                'engine' => $request->engine,
            ]);
            Alert::success('Berhasil', 'Data Engine DB telah ditambahkan');
            return redirect()->route('engine.index');
        } else if ($request->eng == 'APP') {
            $validator = Validator::make($request->all(), [
                'engine' => ['required', 'string', 'unique:engines', 'max:255'],
            ]);
            if ($validator->fails()) {
                Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                return back()->withErrors($validator)->withInput();
            }
            Engine::create([
                'engine' => $request->engine,
            ]);
            Alert::success('Berhasil', 'Data Engine APP telah ditambahkan');
            return redirect()->route('engine.index');
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->eng == 'DB') {
            $engine = EngineDB::find($id);
            if ($engine->engine != $request->engine) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'engine' => ['required', 'unique:engine_d_b_s', 'max:255'],
                    ],
                    [
                        'engine.unique' => 'Data ini sudah ada',
                    ],
                );

                if ($validator->fails()) {
                    Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                    return back()->withErrors($validator)->withInput();
                }
                $engine->engine = $request->engine;
            }
            $data = [
                'engine' => $engine->engine,
            ];
            EngineDB::where('id', $id)->update($data);
            Alert::success('Berhasil', 'Data Engine DB berhasil diubah');
            return back();
        } else if ($request->eng == 'APP') {
            $engine = Engine::find($id);
            if ($engine->engine != $request->engine) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'engine' => ['required', 'unique:engines', 'max:255'],
                    ],
                    [
                        'engine.unique' => 'Data ini sudah ada',
                    ],
                );

                if ($validator->fails()) {
                    Alert::toast('Gagal Menyimpan, cek kembali inputan anda', 'error');
                    return back()->withErrors($validator)->withInput();
                }
                $engine->engine = $request->engine;
            }
            $data = [
                'engine' => $engine->engine,
            ];
            Engine::where('id', $id)->update($data);
            Alert::success('Berhasil', 'Data Engine APP berhasil diubah');
            return back();
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
