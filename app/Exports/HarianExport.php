<?php

namespace App\Exports;

use App\Models\Harian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HarianExport implements FromView
{
    public function view(): View
    {
        $dataServer = Harian::all();
        return view('exports.server', [
            "server" => $dataServer,
        ]);
    }
}
