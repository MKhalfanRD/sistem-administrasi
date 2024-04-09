@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left mb-6">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Produksi</h2>
        </div>

            <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-base text-gray-400 bg-gray-700">
                        <tr>
                            <th rowspan="2" class="p-4 text-center">No</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Nama Perusahaan</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Komoditas</th>
                            <th colspan="2" class="px-6 py-3 text-center">Jumlah Produksi</th>
                            <th rowspan="2" colspan="2" class="px-6 py-3 text-center">Date</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Bukti Bayar</th>
                        </tr>
                        <tr>
                            <th class="px-6 text-center">Volume (m3)</th>
                            <th class="px-6 text-center">Tonase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($produksi as $p)
                        <tr class="bg-gray-800 hover:bg-gray-600">
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">
                                @php
                                    $counter++;
                                @endphp
                                {{$counter}}
                            </td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$p->namaPerusahaan}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$p->komoditas}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$p->volumeProduksi}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$p->tonaseProduksi}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap p-0">{{$p->bulan}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$p->tahun}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap p-1">
                                @if ($p->buktiBayar)
                                    <a href="{{ asset('storage/' . $p->buktiBayar) }}" target="_blank">
                                        <img src="{{ asset('icon/ikon-foto.png') }}"
                                            class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                            alt="Foto Icon">
                                    </a>
                                @else
                                    <p>Tidak Ada</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection
