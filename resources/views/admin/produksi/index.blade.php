@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Produksi</h2>
        </div>
        <a href="{{route('admin.produksi.create')}}">
            <button type="submit"
                class="mt-5 mb-5 rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah
                Data</button>
        </a>

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
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                <div class="btn-wrap flex flex-row gap-3">
                                    <a href="{{route('admin.produksi.edit', $p->id)}}">
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                    </a>
                                    <form action="{{route('admin.produksi.destroy', $p->id)}}" method="POST">
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
