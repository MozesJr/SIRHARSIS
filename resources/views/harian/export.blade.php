@php
    header('Content-type: application/vnd-ms-excel');
    header('content-Disposition: attachment; filename = Data Harian.xls');
@endphp
<!DOCTYPE html>
<html lang="en">

<table border="1">
    <thead>
        <tr>
            <th colspan="8">Tabel Pencatanan Server {{ $server->Server->nameServer }} |
                {{ $server->Server->ketServer }}</th>
        </tr>
        <tr>
            <th>Koneksi</th>
            <th>Web Service</th>
            <th>Tampilan</th>
            <th>Free Memory</th>
            <th>HDD Terpaki</th>
            <th>Pengunjung</th>
            <th>Tanggal/waktu</th>
            <th>PIC</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataHarian as $hari)
            <tr>
                <td>{{ $hari->koneksi }}</td>
                <td>{{ $hari->service }}</td>
                <td>{{ $hari->tampilan }}</td>
                <td>{{ $hari->ram }} GB</td>
                <td>{{ $hari->hardisk }} %</td>
                <td>{{ $hari->pengunjung }} Orang</td>
                <td>{{ $hari->tanggal }} | {{ $hari->waktu }}</td>
                <td>{{ $hari->User->name }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>

</html>
