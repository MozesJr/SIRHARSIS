<!DOCTYPE html>
<html>

<head>
    <title>Data Export</title>
    <style>
        @page {
            margin-top: 100px;
            margin-bottom: 50px;
        }

        header {
            position: fixed;
            top: -100px;
            left: 0;
            right: 0;
            height: auto;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            line-height: 50px;
        }

        body {
            font-family: Arial, sans-serif;
            margin-top: auto;
            margin-bottom: 100px;
            position: relative;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            text-align: left;
        }

        img {
            max-width: 100%;
            max-height: 100px;
            display: block;
            margin: auto;
            height: auto;
        }

        .signature {
            page-break-inside: avoid;
            /* Mencegah pembagian tabel ke halaman berikutnya */
        }

        .signature table {
            width: 100%;
            /* Menetapkan lebar tabel ke lebar penuh halaman */
            margin-top: 20px;
            /* Memberikan ruang di atas tabel */
            border-collapse: separate;
            border-spacing: 0;
            border: none;
            /* Menghapus garis luar tabel */
        }

        .signature td,
        .signature th {
            border: none;
            text-align: center;
            padding: 8px;
            background-color: white;
        }

        .signature tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .signature tr:hover {
            background-color: #ddd;
        }

        .signature th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

        .signature td.bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('assets/images/peruri.jpg') }}" alt="Logo" height="150px">
    </header>
    <h2 style="text-align: center;">Laporan Monitoring Harian Aplikasi {{ $nameServer->Server->nameServer }}</h2>
    @foreach ($server as $data)
        <h3>Data report tanggal {{ $data->tanggal }}</h3>
        <table>
            <tr>
                <th>Koneksi</th>
                <td>{{ $data->koneksi }}</td>
            </tr>
            <tr>
                <th>Gambar Koneksi</th>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('storage/' . $data->image1) }}" alt="Gambar Koneksi">
                </td>
            </tr>
            <tr>
                <th>Web Service</th>
                <td>{{ $data->service }}</td>
            </tr>
            <tr>
                <th>Gambar Web Service</th>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('storage/' . $data->image2) }}" alt="Gambar Web Service">
                </td>
            </tr>
            <br>
            <tr>
                <th>Tampilan</th>
                <td>{{ $data->tampilan }}</td>
            </tr>
            <tr>
                <th>Gambar Tampilan</th>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('storage/' . $data->image3) }}" alt="Gambar Tampilan">
                </td>
            </tr>
            <br>
            <tr>
                <th>Free Memory</th>
                <td>{{ $data->ram }} GB</td>
            </tr>
            <tr>
                <th>Gambar Free Memory</th>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('storage/' . $data->image4) }}" alt="Gambar RAM">
                </td>
            </tr>
            <br>
            <tr>
                <th>Free HDD</th>
                <td>{{ $data->hardisk }} GB</td>
            </tr>
            <tr>
                <th>Gambar HDD Terpakai</th>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('storage/' . $data->image1) }}" alt="Gambar HDD">
                </td>
            </tr>
            <br>
            <tr>
                <th>Pengunjung</th>
                <td>{{ $data->pengunjung }} Orang</td>
            </tr>
            <tr>
                <th>Gambar Pengunjung</th>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('storage/' . $data->image1) }}" alt="Pengunjung">
                </td>
            </tr>
            <br>
            <tr>
                <th>Tanggal/Waktu</th>
                <td>{{ $data->tanggal }} | {{ $data->waktu }}</td>
            </tr>
            <tr>
                <th>PIC</th>
                <td>{{ $data->User->name }}</td>
            </tr>
        </table>
    @endforeach

    <div class="signature">
        <table>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="bold" colspan="2">Disetujui Oleh:</td>
            </tr>
            <tr>
                <td class="bold">Kepala Seksi Pemeliharaan Sistem TI</td>
                <td class="bold">Kepala Departemen Operasional TI</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="bold">Tedi Hermawan</td>
                <td class="bold">Ecep Jenal M.</td>
            </tr>
        </table>
    </div>

    <footer>
        HARSIS - Departemen Operasional TI - Divisi TI
    </footer>
</body>

</html>
