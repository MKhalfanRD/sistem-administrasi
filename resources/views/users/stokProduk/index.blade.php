@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left mb-6">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Stok Produk</h2>
        </div>

            <div class="w-fit mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-base text-gray-400 bg-gray-700">
                        <tr>
                            <th rowspan="2" class="p-4 text-center">No</th>
                            <th rowspan="2" class="px-6 py-3 text-center">Nama Perusahaan</th>
                            <th colspan="2" class="px-6 py-3 text-center">Stok Produk</th>
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
                        @foreach ($stokProduk as $sp)
                        <tr class="bg-gray-800 hover:bg-gray-600">
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">
                                @php
                                    $counter++;
                                @endphp
                                {{$counter}}
                            </td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$sp->namaPerusahaan}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$sp->volumeStokProduk}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$sp->tonaseStokProduk}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap p-0">{{$sp->bulan}}</td>
                            <td class="text-center font-medium text-white whitespace-nowrap py-2">{{$sp->tahun}}</td>
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                <div class="btn-wrap flex flex-row gap-3">
                                    <a href="{{route('user.stokProduk.edit', $sp->id)}}">
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                    </a>
                                </div>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection
