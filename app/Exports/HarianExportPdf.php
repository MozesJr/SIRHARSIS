<?php

namespace App\Exports;

use App\Models\Harian;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Dompdf\Dompdf;
use Dompdf\Options;

class HarianExportPdf
{
    private $id;
    private $awal;
    private $akhir;

    public function __construct($id, $awal = null, $akhir = null)
    {
        $this->id = $id;
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function generatePdf()
    {
        $query = Harian::where('id_server', $this->id);

        if ($this->awal && $this->akhir) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$this->awal, $this->akhir]);
        }

        $data = $query->get();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('harian.pdf', ['data' => $data]));

        // (Optional) Setup the paper size and orientation
        $pdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF to Browser
        $pdf->stream('Data_Harian.pdf');
    }
}
