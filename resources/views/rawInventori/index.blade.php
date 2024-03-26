@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Raw Inventory</h2>
        </div>
        <a href="{{route('rawInventori.create')}}">
            <button type="submit"
                class="mt-5 mb-5 rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah
                Data</button>
        </a>

            <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th rowspan="2" class="p-4 text-center">No</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Nama Perusahaan</th>
                            <th colspan="2" class="px-6 py-3 text-center">Stok Raw</th>
                            <th rowspan="2" colspan="2" class="px-6 py-3 text-center">Date</th>
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
                        @foreach ($rawInventori as $r)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">
                                @php
                                    $counter++;
                                @endphp
                                {{$counter}}
                            </td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$r->namaPerusahaan}}</td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$r->volumeRawInventori}}</td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$r->tonaseRawInventori}}</td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white p-0">{{$r->bulan}}</td>
                            <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$r->tahun}}</td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="btn-wrap flex flex-row gap-3">
                                    <a href="{{route('rawInventori.edit', $r->id)}}">
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                    </a>
                                    <form action="{{route('rawInventori.destroy', $r->id)}}" method="POST">
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
