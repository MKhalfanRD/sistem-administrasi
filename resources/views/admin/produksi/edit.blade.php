@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Produksi</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Edit Data Produksi</p>
        </div>

        <form action="{{route('admin.produksi.update', $produksi->id)}}" method="POST" class="mx-auto mt-16 max-w-xs" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-wrap">
                <div class="namaPerusahaan">
                    <label for="namaPerusahaan" class="block text-sm font-semibold leading-6 text-gray-900">Nama Perusahaan</label>
                    <div class="mt-1.5 mb-3">
                        <select name="namaPerusahaan" id="namaPerusahaan" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if ($perusahaanUser->isEmpty())
                                <option value="">Belum Ada Perusahaan</option>
                            @else
                                <option value="" disabled selected>Pilih</option>
                            @foreach ($perusahaanUser as $namaPerusahaan)
                            <option value="{{$namaPerusahaan}}" @if($namaPerusahaan == $produksi->namaPerusahaan) selected @endif>{{$namaPerusahaan}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('namaPerusahaan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="komoditas">
                    <label for="komoditas" class="block text-sm font-semibold leading-6 text-gray-900">Nama Perusahaan</label>
                    <div class="mt-1.5 mb-3">
                        <select name="komoditas" id="komoditas" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if ($komoditas->isEmpty())
                                <option value="">Belum Ada Komoditas</option>
                            @else
                                <option value="" disabled selected>Pilih</option>
                            @foreach ($komoditas as $komoditas)
                                <option value="{{$komoditas}}" @if($komoditas == $produksi->komoditas) selected @endif>{{$komoditas}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('komoditas')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <label for="date" class="block text-sm font-semibold leading-6 text-gray-900">Date</label>
                <div class="flex flex-row justify-between">
                    <div class="mt-1.5 mb-3">
                        <select name="bulan" id="bulan" class="bg-white block w-48 rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Bulan</option>
                            @foreach ($bulan as $bulan)
                                <option value="{{$bulan}}" @if($bulan == $produksi->bulan) selected @endif>{{$bulan}}</option>
                            @endforeach
                        </select>
                        @error('bulan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-1.5 mb-3">
                        <select name="tahun" id="tahun" class="bg-white block w-28 rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Tahun</option>
                            @foreach ($tahun as $tahun)
                                <option value="{{$tahun}}" @if($tahun == $produksi->tahun) selected @endif>{{$tahun}}</option>
                            @endforeach
                        </select>
                        @error('tahun')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="volumeProduksi">
                    <label for="volumeProduksi" class="block text-sm font-semibold leading-6 text-gray-900">Volume Produksi</label>
                    <div class="mt-1.5 mb-3">
                        <input type="volumeProduksi" name="volumeProduksi" id="volumeProduksi" value="{{$produksi->volumeProduksi}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('volumeProduksi')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="tonaseProduksi">
                    <label for="tonaseProduksi" class="block text-sm font-semibold leading-6 text-gray-900">Tonase Produksi</label>
                    <div class="mt-1.5 mb-3">
                        <input type="tonaseProduksi" name="tonaseProduksi" id="tonaseProduksi" value="{{$produksi->tonaseProduksi}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('tonaseProduksi')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="buktiBayar">
                    <label for="buktiBayar" class="block text-sm font-semibold leading-6 text-gray-900">Scan SK</label>
                    <div class="mt-1.5 mb-3">
                        <input type="file" id="buktiBayar" name="buktiBayar" value="{{$produksi->buktiBayar}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('buktiBayar')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            </div>
            <div class="flex flex-row gap-3">
                <a href="{{route('admin.produksi.index')}}">
                    <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                </a>
                <button type="submit" class=" block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
            <div id="modal" class="fixed mt-10 top-64 right-28 bg-gray-200 rounded-md shadow-lg overflow-hidden mx-auto max-w-64 z-50" style="display: none;">
                <input type="hidden" name="fromModal" value="true">
            </div>
        </form>

    </div>
@endsection
