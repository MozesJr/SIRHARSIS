<?php

namespace App\Http\Controllers;

use App\Models\Harian;
use App\Models\Server;
use Illuminate\Http\Request;

class HarianController extends Controller
{
    public function index()
    {
        $title = "Tugas Harian";
        $dataServer = Server::all();

        return view('harian.index', [
            'title' => $title,
            'dataServer' => $dataServer,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Harian $harian)
    {
        //
    }

    public function edit(Harian $harian)
    {
        //
    }

    public function update(Request $request, Harian $harian)
    {
        //
    }

    public function destroy(Harian $harian)
    {
        //
    }
}
