<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data WIUP</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data IUP Tahapan {{ $tahapanKegiatan }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                <th>Alamat</th>
                <th>NPWP</th>
                <th>NIB</th>
                <th>Kabupaten</th>
                <th>Luas Wilayah</th>
                <th>Komoditas</th>
                <th>Lokasi Izin</th>
                <th>Status Izin</th>
                <th>Scan SK</th>
                <th>WIUP</th>
                <th>Tanggal SK</th>
                <th>No SK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->namaPerusahaan }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->npwp }}</td>
                    <td>{{ $item->nib }}</td>
                    <td>{{ $item->kabupaten }}</td>
                    <td>{{ $item->luasWilayah }}</td>
                    <td>{{ $item->komoditas }}</td>
                    <td>{{ $item->lokasiIzin }}</td>
                    <td>{{ $item->statusIzin }}</td>
                    <td>{{ $item->scanSK }}</td>
                    <td>{{ $item->wiup }}</td>
                    <td>{{ $item->tanggalSK }}</td>
                    <td>{{ $item->noSK }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
