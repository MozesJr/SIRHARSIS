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
            max-width: 250px;
            max-height: 100px;
        }

        .signature table {
            border-collapse: separate;
            border-spacing: 0;
            border: none;
            /* Menghapus garis luar tabel */
        }

        .signature td,
        .signature th {
            border: none;
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
    <h2 style="text-align: center;">Data Export Aplikasi {{ $nameServer->Server->nameServer }}</h2>
    @foreach ($server as $data)
        <h3>Data report tanggal {{ $data->tanggal }}</h3>
        <table>
            <tr>
                <th>Koneksi</th>
                <td>{{ $data->koneksi }}</td>
            </tr>
            <tr>
                <th>Gambar Koneksi</th>
                <td>
                    <img src="{{ public_path('storage/' . $data->image1) }}" alt="Gambar Koneksi"
                        style="width: 100px; height: 100px">
                </td>
            </tr>
            <tr>
                <th>Web Service</th>
                <td>{{ $data->service }}</td>
            </tr>
            <tr>
                <th>Gambar Web Service</th>
                <td>
                    <img src="{{ public_path('storage/' . $data->image2) }}" alt="Gambar Web Service"
                        style="width: 100px; height: 100px">
                </td>
            </tr>
            <br>
            <tr>
                <th>Tampilan</th>
                <td>{{ $data->tampilan }}</td>
            </tr>
            <tr>
                <th>Gambar Tampilan</th>
                <td>
                    <img src="{{ public_path('storage/' . $data->image3) }}" alt="Gambar Tampilan"
                        style="width: 100px; height: 100px">
                </td>
            </tr>
            <br>
            <tr>
                <th>Free Memory</th>
                <td>{{ $data->ram }} GB</td>
            </tr>
            <tr>
                <th>Gambar Free Memory</th>
                <td>
                    <img src="{{ public_path('storage/' . $data->image4) }}" alt="Gambar Free Memory"
                        style="width: 100px; height: 100px">
                </td>
            </tr>
            <br>
            <tr>
                <th>Free HDD</th>
                <td>{{ $data->hardisk }} GB</td>
            </tr>
            <tr>
                <th>Gambar HDD Terpakai</th>
                <td>
                    <img src="{{ public_path('storage/' . $data->image5) }}" alt="Gambar HDD Terpakai"
                        style="width: 100px; height: 100px">
                </td>
            </tr>
            <br>
            <tr>
                <th>Pengunjung</th>
                <td>{{ $data->pengunjung }} Orang</td>
            </tr>
            <tr>
                <th>Gambar Pengunjung</th>
                <td>
                    <img src="{{ public_path('storage/' . $data->image6) }}" alt="Gambar Pengunjung"
                        style="width: 100px; height: 100px">
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
                <td colspan="2" style="width: 300px;">&nbsp;</td>
            </tr>
            <tr>
                <td class="bold" colspan="2" style="text-align: center; width: 300px;">Disetujui Oleh:</td>
            </tr>
            <tr>
                <td class="bold" style="text-align: center;">Kepala Seksi Pemeliharaan Sistem TI</td>
                <td class="bold" style="text-align: center;">Kepala Departemen Operasional TI</td>
            </tr>
            <tr>
                <td style="width: 300px;">&nbsp;</td>
                <td style="width: 300px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 300px;">&nbsp;</td>
                <td style="width: 300px;">&nbsp;</td>
            </tr>
            <tr>
                <td class="bold" style="text-align: center;">Tedi Hermawan</td>
                <td class="bold" style="text-align: center;">Ecep Jenal M.</td>
            </tr>
        </table>
    </div>
    <footer>
        HARSIS - Departemen Operasional TI - Divisi TI
    </footer>
</body>

</html>
