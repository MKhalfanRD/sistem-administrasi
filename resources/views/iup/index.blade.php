@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Izin Usaha Pertambangan</h2>
        </div>
        <a href="{{route('iup.create')}}">
            <button type="submit" class="mt-5 mb-5 block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Data</button>
        </a>
        {{-- <a href="{{route('export.all')}}">
            <button class="mt-5 mb-5 block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Print All</button>
        </a> --}}

        <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                            Komoditas
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Lokasi Izin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status Izin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Scan SK
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
                    @foreach ($IUP as $iup)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 expandable-row cursor-pointer">
                        <th class="px-6 py-4">
                            @php
                                $counter++;
                            @endphp
                            {{$counter}}
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$iup->namaPerusahaan}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$iup->alamat}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$iup->npwp}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$iup->nib}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$iup->kabupaten}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$iup->luasWilayah}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$iup->komoditas}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$iup->lokasiIzin}}
                        </td>
                        <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($iup->statusIzin == 'Aktif')
                                <span class="bg-green-300 px-3 py-2 text-green-700 rounded-md">Aktif</span>
                            @else
                                <span class="bg-red-300 px-2 py-2 text-red-700 rounded-md">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($iup->scanSK)
                                <a href="{{asset('storage/' .$iup->scanSK)}}" target="_blank">
                                    <img src="{{ asset('icon/ikon-pdf.png') }}" class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto" alt="PDF Icon">
                                </a>
                            @else
                                <p>Tidak Ada</p>
                            @endif
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="btn-wrap flex flex-row gap-3">
                                <a href="{{route('iup.edit', $iup->id)}}">
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                </a>
                                <form action="{{route('iup.destroy', $iup->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-white hover:bg-gray-700 px-5 py-2.5 rounded-lg border border-gray-300">Delete</button>
                                </form>
                            </div>
                        </th>
                    </tr>
                    <tr class="expandable-content hidden">
                        <td colspan="12">
                            <div class="details-content">
                                <table class="table-auto w-full">
                                    <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr class="text-center">
                                            <th colspan="2" class="border-r-2 border-white">WIUP</th>
                                            <th colspan="4" class="border-r-2 border-white">IUP Eksplorasi</th>
                                            <th colspan="4" class="border-r-2 border-white">IUP Operasi Produksi</th>
                                            <th colspan="4" class="border-r-2 border-white">Perpanjangan 1</th>
                                            <th colspan="4">Perpanjangan 2</th>
                                        </tr>
                                        <tr>
                                            <div class="wiup">
                                                <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                <th class="px-6 py-3 text-center border-r-2 border-white">No SK</th>
                                            </div>
                                            <div class="eksplorasi">
                                                <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                <th class="px-6 py-3 text-center">No SK</th>
                                                <th class="px-6 py-3 text-center">Masa Berlaku</th>
                                                <th class="px-6 py-3 text-center border-r-2 border-white">Tanggal Berakhir</th>
                                            </div>
                                            <div class="operasiProduksi">
                                                <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                <th class="px-6 py-3 text-center">No SK</th>
                                                <th class="px-6 py-3 text-center">Masa Berlaku</th>
                                                <th class="px-6 py-3 text-center border-r-2 border-white">Tanggal Berakhir</th>
                                            </div>
                                            <div class="perpanjangan1">
                                                <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                <th class="px-6 py-3 text-center">No SK</th>
                                                <th class="px-6 py-3 text-center">Masa Berlaku</th>
                                                <th class="px-6 py-3 text-center border-r-2 border-white">Tanggal Berakhir</th>
                                            </div>
                                            <div class="perpanjangan2">
                                                <th class="px-6 py-3 text-center">Tanggal SK</th>
                                                <th class="px-6 py-3 text-center">No SK</th>
                                                <th class="px-6 py-3 text-center">Masa Berlaku</th>
                                                <th class="px-6 py-3 text-center">Tanggal Berakhir</th>
                                            </div>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white dark:bg-gray-800  hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <div class="wiup">
                                                <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">
                                                    {{$iup->tanggalSK_wiup}}
                                                </td>
                                                <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white border-r-2 border-white">
                                                    {{$iup->noSK_wiup}}
                                                </td>
                                            </div>
                                            <div class="eksplorasi">
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
                                            </div>
                                            <div class="operasiProduksi">
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
                                            </div>
                                            <div class="perpanjangan1">
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
                                            </div>
                                            <div class="perpanjangan2">
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
        document.addEventListener('DOMContentLoaded', function(){
            const rows = document.querySelectorAll('tr.expandable-row');
            rows.forEach(row => {
                row.addEventListener('click', function(){
                    console.log('Row clicked:', this);
                    const detailsContent = this.nextElementSibling;
                    if(detailsContent && detailsContent.classList.contains('expandable-content')){
                        detailsContent.classList.toggle('hidden');
                    }else{
                        console.error('No expandable-content found after expandable-row.')
                    }
                });
            });
        });
    </script>
@endsection
