@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Sumberdaya</h2>
        </div>
        <a href="{{route('sumberdaya.create')}}">
            <button type="submit"
                class="mt-5 mb-5 block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah
                Data</button>
        </a>

        <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                    <tr>
                        <th class="p-4" rowspan="2">No</th>
                        <th rowspan="2" class="px-6 py-3 text-center ">Nama Perusahaan</th>
                        <th colspan="2" class="px-6 py-3 text-center">Tereka</th>
                        <th colspan="2" class="px-6 py-3 text-center">Tertunjuk</th>
                        <th colspan="2" class="px-6 py-3 text-center">Terukur</th>
                        <th rowspan="2" class="px-6 py-3 text-center">Luas</th>
                        <th rowspan="2" class="px-6 py-3 text-center">CP</th>
                        <th rowspan="2" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center">Volume (m3)</th>
                        <th class="px-6 py-3 text-center">Tonase</th>
                        <th class="px-6 py-3 text-center">Volume (m3)</th>
                        <th class="px-6 py-3 text-center">Tonase</th>
                        <th class="px-6 py-3 text-center">Volume (m3)</th>
                        <th class="px-6 py-3 text-center">Tonase</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($sumberdaya as $s)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">
                            @php
                                $counter++;
                            @endphp
                            {{$counter}}
                        </td>
                        <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->namaPerusahaan}}</td>
                        <td class="text-center border-l-2 border-white font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->volumeTereka}}</td>
                        <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->tonaseTereka}}</td>
                        <td class="text-center border-l-2 border-white font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->volumeTertunjuk}}</td>
                        <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->tonaseTertunjuk}}</td>
                        <td class="text-center border-l-2 border-white font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->volumeTerukur}}</td>
                        <td class="text-center border-r-2 border-white font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->tonaseTerukur}}</td>
                        <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->luas}}</td>
                        <td class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white py-2">{{$s->cp}}</td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="btn-wrap flex flex-row gap-3">
                                <a href="{{route('sumberdaya.edit', $s->id)}}">
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                </a>
                                <form action="{{route('sumberdaya.destroy', $s->id)}}" method="POST">
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
