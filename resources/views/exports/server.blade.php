<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th colspan="36" bgcolor="#00ff80">Daftar Aplikasi dan Server</th>
            </tr>
            <tr>
                <th rowspan="2">Nomor</th>
                <th rowspan="2">Nama Aplikasi</th>
                <th rowspan="2">Deskripsi Aplikasi</th>
                <th rowspan="2">Status Aplikasi</th>
                <th rowspan="2">Level Aplikasi</th>
                <th rowspan="2">IP Address</th>
                <th rowspan="2">Path DB</th>
                <th rowspan="2">Path Aplikasi</th>
                <th rowspan="2">Path Akses</th>
                <th colspan="2">Teknologi Database</th>
                <th colspan="2">Teknologi Aplikasi</th>
                <th colspan="7">Spesifikasi Server</th>
                <th colspan="6">User dan Password</th>
            </tr>
            <tr>
                <th>Engine</th>
                <th>Nama</th>
                <th>Engine</th>
                <th>Bahasa</th>
                <th>Hostname</th>
                <th>Lokasi</th>
                <th>OS</th>
                <th>CPU</th>
                <th>Memory</th>
                <th>HDD</th>
                <th>Terpakai</th>
                <th>Username DB</th>
                <th>Password DB</th>
                <th>Username Aplikasi</th>
                <th>Password Aplikasi</th>
                <th>Username Server</th>
                <th>Password Server</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($server as $svr)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $svr->nameServer }}</td>
                    <td>{{ $svr->ketServer }}</td>
                    <td>{{ $svr->Status->status }}</td>
                    <td>{{ $svr->Level->level }}</td>
                    <td>{{ $svr->DNS->ipAddress }}</td>
                    <td>{{ $svr->PathDB->path }}</td>
                    <td>{{ $svr->PathApp->path }}</td>
                    <td>{{ $svr->Path->path }}</td>
                    <td>{{ $svr->ENDB->engine }}</td>
                    <td>{{ $svr->nDB }}</td>
                    <td>{{ $svr->ENApp->engine }}</td>
                    <td>{{ $svr->BHS->bhs_prg }}</td>
                    <td>{{ $svr->hostName }}</td>
                    <td>{{ $svr->lokasi }}</td>
                    <td>{{ $svr->os }}</td>
                    <td>{{ $svr->cpu }}</td>
                    <td>{{ $svr->memory }}</td>
                    <td>{{ $svr->hdd }}</td>
                    <td>{{ $svr->terpakai }}</td>
                    <td>{{ $svr->usDB }}</td>
                    <td>{{ $svr->psDB }}</td>
                    <td>{{ $svr->usApp }}</td>
                    <td>{{ $svr->psApp }}</td>
                    <td>{{ $svr->usServer }}</td>
                    <td>{{ $svr->psServer }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
