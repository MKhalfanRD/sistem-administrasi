@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Bukti Bayar</h2>
        </div>
        <a href="{{route('buktiBayar.create')}}">
            <button type="submit"
                class="mt-5 mb-5 block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah
                Data</button>
        </a>

            <div class="w-fit mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="ext-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-base text-gray-700 bg-gray-50">
                        <tr>
                            <th rowspan="2" class="p-4 text-center">No</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Nama Perusahaan</th>
                            <th colspan="2" class="px-6 py-3 text-center">Jumlah buktiBayar</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Bukti Bayar</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Date</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Aksi</th>
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
                        @foreach ($buktiBayar as $bb)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap py-2">
                                @php
                                    $counter++;
                                @endphp
                                {{$counter}}
                            </td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap py-2">{{$bb->namaPerusahaan}}</td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap py-2">{{$bb->volumebuktiBayar}}</td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap py-2">{{$bb->tonasebuktiBayar}}</td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap py-2">{{$bb->buktiBayar}}</td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap py-2">{{$bb->date}}</td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <div class="btn-wrap flex flex-row gap-3">
                                    <a href="{{route('buktiBayar.edit', $bb->id)}}">
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                    </a>
                                    <form action="{{route('buktiBayar.destroy', $bb->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-white hover:bg-gray-700 px-5 py-2.5 rounded-lg border border-gray-300">Delete</button>
                                    </form>
                                </div>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection
