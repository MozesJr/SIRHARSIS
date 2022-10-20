<?php

namespace App\Exports;

use App\Models\Server;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ServerExport implements FromView
{

    public function view(): View
    {
        $dataServer = Server::all();
        return view('exports.server', [
            "server" => $dataServer,
        ]);
    }
}
