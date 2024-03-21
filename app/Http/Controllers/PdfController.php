<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Harian;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends Controller
{
    public function generatePDF(Request $request, $id)
    {
        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Aktifkan jika ingin memuat gambar dari URL

        $dompdf = new Dompdf($options);
        $dompdf->setBasePath(public_path()); // Atur base path ke folder publik

        $server = Harian::where('id_server', $id)
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at secara descending
            ->limit(10) // Batasi hasil query menjadi 10 data terakhir
            ->get();

        $nameServer = Harian::where('id_server', $id)->first();


        // Load HTML content
        $html = view('pdf.view', compact('server', 'nameServer'))->render();

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // Set paper size
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first buffer the output)
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('document.pdf', ['Attachment' => 0]);
    }

    public function generateExcel(Request $request, $id)
    {
        return Excel::download(new ExportExcel(), 'document.xlsx');
    }
}
