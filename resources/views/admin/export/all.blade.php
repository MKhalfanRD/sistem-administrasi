<table>
    <thead>
        <tr>
            <th rowspan="2">
                No
            </th>
            <th rowspan="2">
                Nama Perusahaan
            </th>
            <th rowspan="2">
                Alamat
            </th>
            <th rowspan="2">
                NPWP
            </th>
            <th rowspan="2">
                NIB
            </th>
            <th rowspan="2">
                Kabupaten
            </th>
            <th rowspan="2">
                Luas Wilayah
            </th>
            <th rowspan="2">
                Komoditas
            </th>
            <th rowspan="2">
                Lokasi Izin
            </th>
            <th rowspan="2">
                Status Izin
            </th>
            <th colspan="2">
                WIUP
            </th>
            <th colspan="4">
                IUP Eksplorasi
            </th>
            <th colspan="4">
                IUP Operasi Produksi
            </th>
            <th colspan="4">
                Perpanjangan 1
            </th>
            <th colspan="4">
                Perpanjangan 2
            </th>
        </tr>
        <tr>
            <div class="wiup">
                <th>Tanggal SK</th>
                <th>No SK</th>
            </div>
            <div class="eksplorasi">
                <th>Tanggal SK</th>
                <th>No SK</th>
                <th>Masa Berlaku</th>
                <th>Tanggal Berakhir</th>
            </div>
            <div class="op">
                <th>Tanggal SK</th>
                <th>No SK</th>
                <th>Masa Berlaku</th>
                <th>Tanggal Berakhir</th>
            </div>
            <div class="p1">
                <th>Tanggal SK</th>
                <th>No SK</th>
                <th>Masa Berlaku</th>
                <th>Tanggal Berakhir</th>
            </div>
            <div class="p2">
                <th>Tanggal SK</th>
                <th>No SK</th>
                <th>Masa Berlaku</th>
                <th>Tanggal Berakhir</th>
            </div>
        </tr>
    </thead>
    <tbody>
        @php
            $counter = 0;
        @endphp
        @foreach ($iup as $iup)
        <tr>
            <th class="px-6 py-4">
                @php
                    $counter++;
                @endphp
                {{ $counter }}
            </th>
            <td>
                {{ $iup->namaPerusahaan }}
            </td>
            <td>
                {{ $iup->alamat }}
            </td>
            <td>
                {{ $iup->npwp }}
            </td>
            <td>
                {{ $iup->nib }}
            </td>
            <td>
                {{ $iup->kabupaten }}
            </td>
            <td>
                {{ $iup->luasWilayah }}
            </td>
            <td>
                {{ $iup->komoditas }}
            </td>
            <td>
                {{ $iup->lokasiIzin }}
            </td>
            <td>
                @if ($iup->statusIzin == 'Aktif')
                    <span>Aktif</span>
                @else
                    <span>Tidak Aktif</span>
                @endif
            </td>
            <td>
                {{ $iup->tanggalSK_wiup }}
            </td>
            <td>
                {{ $iup->noSK_wiup }}
            </td>
            <td>
                {{$iup->tanggalSK_eksplor}}
            </td>
            <td>
                {{$iup->noSK_eksplor}}
            </td>
            <td>
                {{$iup->masaBerlaku_eksplor}}
            </td>
            <td>
                {{$iup->tanggalBerakhir_eksplor}}
            </td>
            <td>
                {{$iup->tanggalSK_op}}
            </td>
            <td>
                {{$iup->noSK_op}}
            </td>
            <td>
                {{$iup->masaBerlaku_op}}
            </td>
            <td>
                {{$iup->tanggalBerakhir_op}}
            </td>
            <td>
                {{$iup->tanggalSK_p1}}
            </td>
            <td>
                {{$iup->noSK_p1}}
            </td>
            <td>
                {{$iup->masaBerlaku_p1}}
            </td>
            <td>
                {{$iup->tanggalBerakhir_p1}}
            </td>
            <td>
                {{$iup->tanggalSK_p2}}
            </td>
            <td>
                {{$iup->noSK_p2}}
            </td>
            <td>
                {{$iup->masaBerlaku_p2}}
            </td>
            <td>
                {{$iup->tanggalBerakhir_p2}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
