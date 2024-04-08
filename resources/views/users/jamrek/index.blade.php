@extends('layout.index')
@section('content')
<div class="container mx-auto">
    <div class="mx-auto text-left">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Jaminan Reklamasi</h2>
    </div>

    <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-base text-gray-400 bg-gray-700">
                <tr>
                    <th scope="col" class="p-4">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Perusahaan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Besaran Ditetapkan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        File Penempatan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Besaran Ditemppatkan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Penempatan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jatuh Tempo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Bank
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bentuk Penempatan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No Seri
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No Rekening
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-10 py-3 text-center">
                        File
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 0;
                @endphp
                @foreach ($jamrek as $jr)
                {{-- @if (isset($filepath))
                    <a href="{{asset($filepath)}}" download="{{$jr->scanSK}}.pdf"></a>
                @endif --}}
                <tr class="bg-gray-800 hover:bg-gray-600">
                    <td class="px-6 py-4">
                        @php
                            $counter++;
                        @endphp
                        {{$counter}}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->namaPerusahaan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->besaranDitetapkan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->tanggal}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        @if ($jr->filePenempatan)
                        <a href="{{ asset('storage/' . $jr->filePenempatan) }}" target="_blank">
                            <img src="{{ asset('icon/ikon-pdf.png') }}"
                                class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                alt="PDF Icon">
                        </a>
                    @else
                        <p>Tidak Ada</p>
                    @endif                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->besaranDitempatkan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->tanggalPenempatan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->jatuhTempo}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->namaBank}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->bentukPenempatan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->noSeri}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{$jr->noRekening}}
                    </th>
                    <th scope="row" class="text-center px-6 py-4 font-medium text-white whitespace-nowrap">
                        @if ($jr->status == 'Aktif')
                            <span class="bg-green-300 px-3 py-2 text-green-700 rounded-md">Aktif</span>
                        @else
                            <span class="bg-red-300 px-2 py-2 text-red-700 rounded-md">Tidak Aktif</span>
                        @endif
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        @if ($jr->fileReklamasi)
                                    <a href="{{ asset('storage/' . $jr->fileReklamasi) }}" target="_blank">
                                        <img src="{{ asset('icon/ikon-pdf.png') }}"
                                            class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                            alt="PDF Icon">
                                    </a>
                                @else
                                    <p>Tidak Ada</p>
                                @endif
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
