@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left mb-6">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table KTT</h2>
        </div>

        <div class="w-fit mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-base text-gray-400 bg-gray-700">
                    <tr>
                        <th scope="col" class="p-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Perusahaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama KTT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status KTT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No SK
                        </th>
                        <th colspan="2" class="px-6 py-3 text-center">
                            Tanggal SK
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File Upload
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($ktt as $ktt)
                    <tr class="bg-gray-800 hover:bg-gray-600">
                        <th class="px-6 py-4 text-white">
                            @php
                                $counter++;
                            @endphp
                            {{$counter}}
                        </th>
                        <th class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            {{$ktt->namaPerusahaan}}
                        </th>
                        <th class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            {{$ktt->namaKtt}}
                        </th>
                        <th class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            @if ($ktt->statusKTT == 'Aktif')
                                    <span class="bg-green-300 px-3 py-2 text-green-700 rounded-md">Aktif</span>
                                @else
                                    <span class="bg-red-300 px-2 py-2 text-red-700 rounded-md">Tidak Aktif</span>
                                @endif
                        </th>
                        <th class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            {{$ktt->noSK}}
                        </th>
                        <th class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            {{$ktt->bulan}}
                        </th>
                        <th class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            {{$ktt->tahun}}
                        </th>
                        <th class="px-6 py-4 text-center font-medium text-white whitespace-nowrap">
                            @if ($ktt->fileUpload)
                            <a href="{{ asset('storage/' . $ktt->fileUpload) }}" target="_blank">
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
