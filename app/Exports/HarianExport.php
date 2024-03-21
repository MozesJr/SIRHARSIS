<?php

namespace App\Exports;

use App\Models\Harian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Illuminate\Support\Facades\DB;

class HarianExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    private $id;

    public function __construct($id, $awal = null, $akhir = null)
    {
        $this->id = $id;
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function collection()
    {
        $query = Harian::where('id_server', $this->id);

        if ($this->awal && $this->akhir) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$this->awal, $this->akhir]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Koneksi',
            // 'Gambar Koneksi',
            'Web Service',
            // 'Gambar Web Service',
            'Tampilan',
            // 'Gambar Tampilan',
            'Free Memory',
            // 'Gambar Free Memory',
            'Free HDD',
            // 'Gambar HDD Terpakai',
            'Pengunjung',
            // 'Gambar Pengunjung',
            'Tanggal/waktu',
            'PIC',
        ];
    }

    public function map($hari): array
    {
        $id = 1;
        return [
            $id++, // Nomor yang berlanjut dari 1 - n
            $hari->koneksi,

            $hari->service,

            $hari->tampilan,

            $hari->ram . ' GB',

            $hari->hardisk . ' GB',

            $hari->pengunjung . ' Orang',

            $hari->tanggal . ' | ' . $hari->waktu,

            $hari->User->name,
        ];
    }

    // public function drawings()
    // {
    //     $dataHarian = Harian::all();

    //     $drawings = [];

    //     foreach ($dataHarian as $index => $hari) {
    //         $imagePaths = [
    //             'image1' => public_path('storage/' . $hari->image1),
    //             'image2' => public_path('storage/' . $hari->image2),
    //             'image3' => public_path('storage/' . $hari->image3),
    //             'image4' => public_path('storage/' . $hari->image4),
    //             'image5' => public_path('storage/' . $hari->image5),
    //             'image6' => public_path('storage/' . $hari->image6),
    //         ];

    //         foreach ($imagePaths as $key => $imagePath) {
    //             if (file_exists($imagePath)) {
    //                 $image = imagecreatefromstring(file_get_contents($imagePath));
    //                 if ($image !== false) {
    //                     $drawing = new MemoryDrawing();
    //                     $drawing->setName('Gambar ' . ucwords(str_replace('image', '', $key)));
    //                     $drawing->setDescription('Gambar ' . ucwords(str_replace('image', '', $key)));
    //                     $drawing->setImageResource($image);
    //                     $drawing->setRenderingFunction(MemoryDrawing::RENDERING_JPEG);
    //                     $drawing->setMimeType(MemoryDrawing::MIMETYPE_DEFAULT);
    //                     $drawing->setCoordinates($this->getCoordinates($key) . ($index + 2));
    //                     $drawing->setWidth(250); // Set width in pixels
    //                     $drawing->setHeight(150); // Set height in pixels

    //                     $drawings[] = $drawing;
    //                 }
    //             }
    //         }
    //     }

    //     return $drawings;
    // }

    // private function getCoordinates($key)
    // {
    //     $columns = [
    //         'image1' => 'C',
    //         'image2' => 'E',
    //         'image3' => 'G',
    //         'image4' => 'I',
    //         'image5' => 'K',
    //         'image6' => 'M',
    //     ];

    //     return $columns[$key] ?? '';
    // }
}
