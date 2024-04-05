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
                Golongan
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
        @foreach ($op as $op)
        <tr>
            <th class="px-6 py-4">
                @php
                    $counter++;
                @endphp
                {{ $counter }}
            </th>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->namaPerusahaan }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->alamat }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->npwp }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->nib }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap py-2">
                {{ $op->tanggalSK_op }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap border-r-2 border-white">
                {{ $op->noSK_op }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap border-r-2 border-white">
                {{ $op->masaBerlaku_op }}
            </td>
            <td class="text-center font-medium text-gray-900 whitespace-nowrap border-r-2 border-white">
                {{ $op->tanggalBerakhir_op }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->kabupaten }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->luasWilayah }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->golongan_op }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->komoditas_op }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $op->lokasiIzin }}
            </td>
            <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                @if ($op->statusIzin == 'Aktif')
                    <span class="bg-green-300 px-3 py-2 text-green-700 rounded-md">Aktif</span>
                @else
                    <span class="bg-red-300 px-2 py-2 text-red-700 rounded-md">Tidak Aktif</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
