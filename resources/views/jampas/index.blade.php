@extends('layout.index')
@section('content')
<div class="container mx-auto">
    <div class="mx-auto text-left">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Jaminan Pasca</h2>
    </div>
    <a href="{{route('jampas.create')}}">
        <button type="submit" class="mt-5 mb-5 block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Data</button>
    </a>

    <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                    <th scope="col" class="px-10 py-3 text-center">
                        File
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 0;
                @endphp
                @foreach ($jampas as $jp)
                {{-- @if (isset($filepath))
                    <a href="{{asset($filepath)}}" download="{{$jr->scanSK}}.pdf"></a>
                @endif --}}
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        @php
                            $counter++;
                        @endphp
                        {{$counter}}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->namaPerusahaan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->besaranDitetapkan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->tanggal}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($jp->filePenempatan)
                        <a href="{{ asset('storage/' . $jp->filePenempatan) }}" target="_blank">
                            <img src="{{ asset('icon/ikon-pdf.png') }}"
                                class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                alt="PDF Icon">
                        </a>
                    @else
                        <p>Tidak Ada</p>
                    @endif                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->besaranDitempatkan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->tanggalPenempatan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->jatuhTempo}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->namaBank}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->bentukPenempatan}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->noSeri}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$jp->noRekening}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($jp->filePasca)
                                    <a href="{{ asset('storage/' . $jp->filePasca) }}" target="_blank">
                                        <img src="{{ asset('icon/ikon-pdf.png') }}"
                                            class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto"
                                            alt="PDF Icon">
                                    </a>
                                @else
                                    <p>Tidak Ada</p>
                                @endif
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="btn-wrap flex flex-row gap-3">
                            <a href="{{route('jampas.edit', $jp->id)}}">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                            </a>
                            <form action="{{route('jampas.destroy', $jp->id)}}" method="POST">
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
