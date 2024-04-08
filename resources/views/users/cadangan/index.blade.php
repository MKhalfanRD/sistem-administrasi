@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Cadangan</h2>
        </div>

            <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-base text-gray-400 bg-gray-700">
                        <tr>
                            <th rowspan="2" class="p-4 text-center">No</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Nama Perusahaan</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Komoditas</th>
                            <th colspan="2" class="px-6 py-3 text-center">Terkira</th>
                            <th colspan="2" class="px-6 py-3 text-center">Terbukti</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Luas</th>
                            <th rowspan="2" class="px-6 py-3 text-center">CP</th>
                        </tr>
                        <tr>
                            <th class="px-6 text-center">Volume (m3)</th>
                            <th class="px-6 text-center">Tonase</th>
                            <th class="px-6 text-center">Volume (m3)</th>
                            <th class="px-6 text-center">Tonase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($cadangan as $c)
                        <tr class="bg-gray-800 hover:bg-gray-600">
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">
                                @php
                                    $counter++;
                                @endphp
                                {{$counter}}
                            </td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$c->namaPerusahaan}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$c->komoditas}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$c->volumeTerkira}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$c->tonaseTerkira}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$c->volumeTerbukti}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$c->tonaseTerbukti}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$c->luas}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$c->cp}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection
