@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Izin Usaha Pertambangan</h2>
        </div>
        <a href="{{ route('admin.iup.create') }}">
            <button type="submit"
                class="mt-5 mb-5 rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah
                Data</button>
        </a>
    <div class="button-wrap flex justify-between">
        <a href="{{route('admin.iup.export')}}">
            <button class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Print</button>
        </a>

        <form action="{{ route('iup.search') }}" method="GET" class="mb-3">
            <div class="input-group flex flex-row gap-2 justify-end">
                <input type="search" name="search" placeholder="Cari..."
                    class="block w-60 rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <button type="submit" class="block rounded-md bg-indigo-600 px-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cari</button>
            </div>
        </form>
    </div>

    <div class="flex flex-row justify-end gap-3 mb-2">
        <a href="{{route('admin.wiup.index')}}">
            <button class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">WIUP</button>
        </a>
        <a href="{{route('admin.eksplor.index')}}">
            <button class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Eksplorasi</button>
        </a>
        <a href="{{route('admin.op.index')}}">
            <button class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Produksi</button>
        </a>
        <a href="{{route('admin.p1.index')}}">
            <button class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Perpanjangan 1</button>
        </a>
        <a href="{{route('admin.p2.index')}}">
            <button class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Perpanjangan 2</button>
        </a>
    </div>

        {{-- @if ($request->has('search'))
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->namaPerusahaan }}</td>
                    <td>{{ $result->npwp }}</td>
                    ...
                </tr>
            @endforeach
        @endif --}}

        <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                <thead class="text-base bg-gray-700 text-gray-400">
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
                            Kabupaten
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Luas Wilayah
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Lokasi Izin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status Izin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status Terakhir
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($iup as $iup)
                        <tr
                            class=" bg-gray-800 hover:bg-gray-600 expandable-row cursor-pointer">
                            <th class="px-6 py-4">
                                @php
                                    $counter++;
                                @endphp
                                {{ $counter }}
                            </th>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                {{ $iup->namaPerusahaan }}
                            </td>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                {{ $iup->alamat }}
                            </td>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                {{ $iup->npwp }}
                            </td>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                {{ $iup->nib }}
                            </td>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                {{ $iup->kabupaten }}
                            </td>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                {{ $iup->luasWilayah }}
                            </td>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                {{ $iup->lokasiIzin }}
                            </td>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                @if ($iup->statusIzin == 'Aktif')
                                    <span class="bg-green-300 px-3 py-2 text-green-700 rounded-md">Aktif</span>
                                @else
                                    <span class="bg-red-300 px-2 py-2 text-red-700 rounded-md">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="text-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                {{ $iup->jenisKegiatan }}
                            </td>
                            <th scope="row" class="flex justify-center px-6 py-4 font-medium  whitespace-nowrap text-white">
                                <div class="btn-wrap flex flex-row gap-3">
                                    <a href="{{ route('admin.iup.edit', $iup->id) }}">
                                        <button type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                    </a>
                                    <form action="{{ route('admin.iup.destroy', $iup->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="text-white hover:bg-gray-700 px-5 py-2.5 rounded-lg border border-gray-300">Delete</button>
                                    </form>
                                </div>
                            </th>
                        </tr>
                        <tr class="expandable-content hidden">
                            <td colspan="12">
                                <div class="details-content">
                                    <table class="table-auto w-full">
                                        <thead
                                            class="text-base bg-gray-700 text-gray-400">
                                            <tr class="text-center">
                                                <th colspan="5" class="border-r-2 border-white">WIUP</th>
                                                <th colspan="7" class="border-r-2 border-white">IUP Eksplorasi</th>
                                                <th colspan="7" class="border-r-2 border-white">IUP Operasi Produksi</th>
                                                <th colspan="7" class="border-r-2 border-white">Perpanjangan 1</th>
                                                <th colspan="7">Perpanjangan 2</th>
                                            </tr>
                                            <tr>
                                                <div class="wiup">
                                                    <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                    <th class="px-6 py-3 text-center">No SK</th>
                                                    <th class="px-6 py-3 text-center">Golongan</th>
                                                    <th class="px-6 py-3 text-center">Komoditas</th>
                                                    <th class="px-6 py-3 text-center border-r-2 border-white">Scan SK</th>
                                                </div>
                                                <div class="eksplorasi">
                                                    <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                    <th class="px-6 py-3 text-center">No SK</th>
                                                    <th class="px-6 py-3 text-center">Masa Berlaku</th>
                                                    <th class="px-6 py-3 text-cente">Tanggal Berakhir</th>
                                                    <th class="px-6 py-3 text-center">Golongan</th>
                                                    <th class="px-6 py-3 text-center">Komoditas</th>
                                                    <th class="px-6 py-3 text-center border-r-2 border-white">Scan SK</th>
                                                </div>
                                                <div class="operasiProduksi">
                                                    <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                    <th class="px-6 py-3 text-center">No SK</th>
                                                    <th class="px-6 py-3 text-center">Masa Berlaku</th>
                                                    <th class="px-6 py-3 text-center">Tanggal Berakhir</th>
                                                    <th class="px-6 py-3 text-center">Golongan</th>
                                                    <th class="px-6 py-3 text-center">Komoditas</th>
                                                    <th class="px-6 py-3 text-center border-r-2 border-white">Scan SK</th>
                                                </div>
                                                <div class="perpanjangan1">
                                                    <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                    <th class="px-6 py-3 text-center">No SK</th>
                                                    <th class="px-6 py-3 text-center">Masa Berlaku</th>
                                                    <th class="px-6 py-3 text-center">Tanggal Berakhir</th>
                                                    <th class="px-6 py-3 text-center">Golongan</th>
                                                    <th class="px-6 py-3 text-center">Komoditas</th>
                                                    <th class="px-6 py-3 text-center border-r-2 border-white">Scan SK</th>
                                                </div>
                                                <div class="perpanjangan2">
                                                    <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                    <th class="px-6 py-3 text-center">No SK</th>
                                                    <th class="px-6 py-3 text-center">Masa Berlaku</th>
                                                    <th class="px-6 py-3 text-center">Tanggal Berakhir</th>
                                                    <th class="px-6 py-3 text-center">Golongan</th>
                                                    <th class="px-6 py-3 text-center">Komoditas</th>
                                                    <th class="px-6 py-3 text-center">Scan SK</th>
                                                </div>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class=" bg-gray-800  hover:bg-gray-600">
                                                <div class="wiup">
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white py-2">
                                                        {{ $iup->tanggalSK_wiup }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->noSK_wiup }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->golongan_wiup }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->komoditas_wiup }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white border-r-2 border-white">
                                                        @if ($iup->scanSK_wiup)
                                                        <a href="{{ asset('storage/' . $iup->scanSK_wiup) }}" target="_blank">
                                                            <img src="{{ asset('icon/ikon-pdf.png') }}"
                                                                class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                                                alt="PDF Icon">
                                                        </a>
                                                        @else
                                                            <p>Tidak Ada</p>
                                                        @endif
                                                    </td>
                                                </div>
                                                <div class="eksplorasi">
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->tanggalSK_eksplor }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->noSK_eksplor }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->masaBerlaku_eksplor }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->tanggalBerakhir_eksplor }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->golongan_eksplor }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->komoditas_eksplor }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white border-r-2 border-white">
                                                        @if ($iup->scanSK_eksplor)
                                                        <a href="{{ asset('storage/' . $iup->scanSK_eksplor) }}" target="_blank">
                                                            <img src="{{ asset('icon/ikon-pdf.png') }}"
                                                                class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                                                alt="PDF Icon">
                                                        </a>
                                                        @else
                                                            <p>Tidak Ada</p>
                                                        @endif
                                                    </td>
                                                </div>
                                                <div class="operasiProduksi">
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->tanggalSK_op }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->noSK_op }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->masaBerlaku_op }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->tanggalBerakhir_op }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->golongan_op }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->komoditas_op }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white border-r-2 border-white">
                                                        @if ($iup->scanSK_op)
                                                        <a href="{{ asset('storage/' . $iup->scanSK_op) }}" target="_blank">
                                                            <img src="{{ asset('icon/ikon-pdf.png') }}"
                                                                class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                                                alt="PDF Icon">
                                                        </a>
                                                        @else
                                                            <p>Tidak Ada</p>
                                                        @endif
                                                    </td>
                                                </div>
                                                <div class="perpanjangan1">
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->tanggalSK_p1 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->noSK_p1 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->masaBerlaku_p1 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->tanggalBerakhir_p1 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->golongan_p1 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->komoditas_p1 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white border-r-2 border-white">
                                                        @if ($iup->scanSK_p1)
                                                        <a href="{{ asset('storage/' . $iup->scanSK_p1) }}" target="_blank">
                                                            <img src="{{ asset('icon/ikon-pdf.png') }}"
                                                                class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                                                alt="PDF Icon">
                                                        </a>
                                                        @else
                                                            <p>Tidak Ada</p>
                                                        @endif
                                                    </td>
                                                </div>
                                                <div class="perpanjangan2">
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->tanggalSK_p2 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->noSK_p2 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->masaBerlaku_p2 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->tanggalBerakhir_p2 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->golongan_p2 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        {{ $iup->komoditas_p2 }}
                                                    </td>
                                                    <td
                                                        class="text-center font-medium  whitespace-nowrap text-white">
                                                        @if ($iup->scanSK_p2)
                                                        <a href="{{ asset('storage/' . $iup->scanSK_p2) }}" target="_blank">
                                                            <img src="{{ asset('icon/ikon-pdf.png') }}"
                                                                class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                                                alt="PDF Icon">
                                                        </a>
                                                        @else
                                                            <p>Tidak Ada</p>
                                                        @endif
                                                    </td>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tr.expandable-row');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    console.log('Row clicked:', this);
                    const detailsContent = this.nextElementSibling;
                    if (detailsContent && detailsContent.classList.contains('expandable-content')) {
                        detailsContent.classList.toggle('hidden');
                    } else {
                        console.error('No expandable-content found after expandable-row.')
                    }
                });
            });
        });
    </script>
@endsection
