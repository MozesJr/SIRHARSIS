<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Server;
use App\Models\User;
use App\Models\Harian;
use App\Models\Pencatatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Home';
        $user = count(User::all());
        $server = count(Server::all());
        $dataHarian = count(Harian::where('id_users', Auth::user()->id)->get());
        $dataPencatatan = count(Pencatatan::where('id_users', Auth::user()->id)->get());

        //Egine APP
        $Laravel = count(Server::select('id_enApp')->where('id_enApp', 1)->get());
        $CI = count(Server::select('id_enApp')->where('id_enApp', 2)->get());
        $Yii = count(Server::select('id_enApp')->where('id_enApp', 3)->get());

        $engineApp = [$Laravel, $CI, $Yii];

        //Egine DB
        $mysql = count(Server::select('id_enDB')->where('id_enDB', 1)->get());
        $sqlServer = count(Server::select('id_enDB')->where('id_enDB', 2)->get());
        $oracle = count(Server::select('id_enDB')->where('id_enDB', 3)->get());

        $engineDB = [$mysql, $sqlServer, $oracle];

        //Bahasa Pemrograman
        $core = count(Server::select('id_levels')->where('id_levels', 5)->get());
        $noncore = count(Server::select('id_levels')->where('id_levels', 6)->get());
        $levels = [$core, $noncore];

        // dd($engineApp);


        return view('home.index', [
            'title' => $title,
            'dataUser' => $user,
            'dataServer' => $server,
            'dataHarian' => $dataHarian,
            'dataPencatatan' => $dataPencatatan,
            'engineApp' => $engineApp,
            'engineDB' => $engineDB,
            'levels' => $levels,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        //
    }
}
