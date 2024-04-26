@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left mb-6">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Sumberdaya</h2>
        </div>

        <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-base text-gray-400 bg-gray-700">
                    <tr>
                    <tr>
                        <th class="p-4" rowspan="2">No</th>
                        <th rowspan="2" class="px-6 py-1 text-center">Nama Perusahaan</th>
                        <th rowspan="2" class="px-6 py-1 text-center">Komoditas</th>
                        <th colspan="2" class="px-6 py-1 text-center">Tereka</th>
                        <th colspan="2" class="px-6 py-1 text-center">Tertunjuk</th>
                        <th colspan="2" class="px-6 py-1 text-center">Terukur</th>
                        <th rowspan="2" class="px-6 py-1 text-center">Luas</th>
                        <th rowspan="2" class="px-6 py-1 text-center">CP</th>
                    </tr>
                    <tr>
                        <th class="px-6 py-1 text-center">Volume (m3)</th>
                        <th class="px-6 py-1 text-center">Tonase</th>
                        <th class="px-6 py-1 text-center">Volume (m3)</th>
                        <th class="px-6 py-1 text-center">Tonase</th>
                        <th class="px-6 py-1 text-center">Volume (m3)</th>
                        <th class="px-6 py-1 text-center">Tonase</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($sumberdaya as $s)
                    <tr class="bg-gray-800 hover:bg-gray-600">
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">
                            @php
                                $counter++;
                            @endphp
                            {{$counter}}
                        </td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->namaPerusahaan}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->komoditas}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->volumeTereka}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->tonaseTereka}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->volumeTertunjuk}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->tonaseTertunjuk}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->volumeTerukur}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->tonaseTerukur}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->luas}}</td>
                        <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$s->cp}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
