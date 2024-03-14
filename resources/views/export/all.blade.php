<h2>IUP Tahap Operasi Produksi</h2>
<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th rowspan="2" class="p-4">
                No
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
                Nama Perusahaan
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
                Alamat
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
                NPWP
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
                NIB
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
                Kabupaten
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
                Luas Wilayah
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
                Komoditas
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
                Lokasi Izin
            </th>
            <th rowspan="2" class="px-6 py-3 text-center">
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
    </thead>
    <tbody>
        <tr>
            <th class="px-6 py-4">
                @php
                    $counter++;
                @endphp
                {{ $counter }}
            </th>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $iup->namaPerusahaan }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $iup->alamat }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $iup->npwp }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $iup->nib }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $iup->kabupaten }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $iup->luasWilayah }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $iup->komoditas }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $iup->lokasiIzin }}
            </td>
            <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                @if ($iup->statusIzin == 'Aktif')
                    <span class="bg-green-300 px-3 py-2 text-green-700 rounded-md">Aktif</span>
                @else
                    <span class="bg-red-300 px-2 py-2 text-red-700 rounded-md">Tidak Aktif</span>
                @endif
            </td>
            <td>
                {{ $iup->tanggalSK_wiup }}
            </td>
            <td>
                {{ $iup->noSK_wiup }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->tanggalSK_eksplor}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->noSK_eksplor}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->masaBerlaku_eksplor}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white border-r-2 border-white">
                {{$iup->tanggalBerakhir_eksplor}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->tanggalSK_op}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->noSK_op}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->masaBerlaku_op}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white border-r-2 border-white">
                {{$iup->tanggalBerakhir_op}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->tanggalSK_p1}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->noSK_p1}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->masaBerlaku_p1}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white border-r-2 border-white">
                {{$iup->tanggalBerakhir_p1}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->tanggalSK_p2}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->noSK_p2}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->masaBerlaku_p2}}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$iup->tanggalBerakhir_p2}}
            </td>
        </tr>
    </tbody>
</table>
