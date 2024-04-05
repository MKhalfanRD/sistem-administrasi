<table class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-base text-gray-700 bg-gray-50">
        <tr>
            <th scope="col" class="p-4">
                No
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Nama Perusahaan
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Alamat
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                NPWP
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                NIB
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Tanggal SK
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                No SK
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Masa Berlaku
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Tanggal Berakhir
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Kabupaten
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Luas Wilayah
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Komoditas
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Lokasi Izin
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Status Izin
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $counter = 0;
        @endphp
        @foreach ($p2 as $p2)
        <tr>
            <th class="px-6 py-4">
                @php
                    $counter++;
                @endphp
                {{ $counter }}
            </th>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $p2->namaPerusahaan }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $p2->alamat }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $p2->npwp }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $p2->nib }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap py-2">
                {{ $p2->tanggalSK_p2 }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap border-r-2 border-white">
                {{ $p2->noSK_p2 }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap border-r-2 border-white">
                {{ $p2->masaBerlaku_p2 }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap border-r-2 border-white">
                {{ $p2->tanggalBerakhir_p2 }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $p2->kabupaten }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $p2->luasWilayah }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $p2->komoditas }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $p2->lokasiIzin }}
            </td>
            <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                @if ($p2->statusIzin == 'Aktif')
                    <span class="bg-green-300 px-3 py-2 text-green-700 rounded-md">Aktif</span>
                @else
                    <span class="bg-red-300 px-2 py-2 text-red-700 rounded-md">Tidak Aktif</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
