@php
    header('Content-type: application/vnd-ms-excel');
    header('content-Disposition: attachment; filename = Data Harian.xls');
@endphp
<!DOCTYPE html>
<html lang="en">

<table border="1">
    <thead>
        <tr>
            <th colspan="14">Tabel Pencatanan Server {{ $server->Server->nameServer }} |
                {{ $server->Server->ketServer }}</th>
        </tr>
        <tr>
            <th>Koneksi</th>
            <th>Gambar Koneksi</th>
            <th>Web Service</th>
            <th>Gambar Web Service</th>
            <th>Tampilan</th>
            <th>Gambar Tampilan</th>
            <th>Free Memory</th>
            <th>Gambar Free Memory</th>
            <th>HDD Terpaki</th>
            <th>Gambar HDD Terpakai</th>
            <th>Pengunjung</th>
            <th>Gambar Pengunjung</th>
            <th>Tanggal/waktu</th>
            <th>PIC</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataHarian as $hari)
            <tr>
                <td>{{ $hari->koneksi }}</td>
                <td><img src="{{ asset('storage/' . $hari->image1) }}" alt="Gambar Koneksi"
                        style="width: 250px; height: 150px;"></td>
                <td>{{ $hari->service }}</td>
                <td><img src="{{ asset('storage/' . $hari->image2) }}" alt="Gambar Web Service"
                        style="width: 250px; height: 150px;"></td>
                <td>{{ $hari->tampilan }}</td>
                <td><img src="{{ asset('storage/' . $hari->image3) }}" alt="Gambar Tampilan"
                        style="width: 250px; height: 150px;"></td>
                <td>{{ $hari->ram }} GB</td>
                <td><img src="{{ asset('storage/' . $hari->image4) }}" alt="Gambar Free Memomry"
                        style="width: 250px; height: 150px;"></td>
                <td>{{ $hari->hardisk }} %</td>
                <td><img src="{{ asset('storage/' . $hari->image5) }}" alt="Gambar HDD Terpakai"
                        style="width: 250px; height: 150px;"></td>
                <td>{{ $hari->pengunjung }} Orang</td>
                <td><img src="{{ asset('storage/' . $hari->image6) }}" alt="Gambar Pengunjung"
                        style="width: 250px; height: 150px;"></td>
                <td>{{ $hari->tanggal }} | {{ $hari->waktu }}</td>
                <td>{{ $hari->User->name }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>

</html>
