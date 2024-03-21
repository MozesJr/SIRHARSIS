<?php

namespace App\Exports;

use App\Models\Harian;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class ExcelPdfExport implements FromView
{
    public function view(): View
    {
        $id = request()->route('id');
        $server = $this->getDataByDateRange($id);

        $nameServer = Harian::where('id_server', $id)->first();

        return view('pdf.view', [
            'server' => $server,
            'nameServer' => $nameServer,
        ]);
    }

    public function exportPdf($id)
    {
        $nameServer = Harian::where('id_server', $id)->first();
        $date = date('d-m-Y');
        $server = $this->getDataByDateRange($id);

        // Check if start and end dates are provided
        if (request()->has('start') && request()->has('end')) {
            $start = request()->input('start');
            $end = request()->input('end');
            $dateRange = Carbon::parse($start)->format('d-m-Y') . '_' . Carbon::parse($end)->format('d-m-Y');
            $fileName = 'Data Report ' . $nameServer->Server->nameServer . ' ' . $dateRange . '.pdf';
        } else {
            $fileName = 'Data Report ' . $nameServer->Server->nameServer . '-' . $date . '.pdf';
        }

        $pdf = FacadePdf::loadView('pdf.view', [
            'server' => $server,
            'nameServer' => $nameServer,
        ]);

        return $pdf->download($fileName);
    }


    private function getDataByDateRange($id)
    {
        // Check if start and end dates are provided
        if (request()->has('start') && request()->has('end')) {
            $start = request()->input('start');
            $end = request()->input('end');
            return Harian::where('id_server', $id)
                ->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end)
                ->get();
        } else {
            return Harian::where('id_server', $id)->get();
        }
    }
}
