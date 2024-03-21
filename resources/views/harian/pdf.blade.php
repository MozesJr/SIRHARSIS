<h1>Data Harian</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Koneksi</th>
            <th>Web Service</th>
            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->koneksi }}</td>
                <td>{{ $item->service }}</td>
                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
            </tr>
        @endforeach
    </tbody>
</table>
