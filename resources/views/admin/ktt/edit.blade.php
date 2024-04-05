@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">KTT</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Edit Data KTT</p>
        </div>

        <form action="{{route('admin.ktt.update', $ktt->id)}}" method="POST" class="mx-auto mt-16 max-w-xs " enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-wrap">
                <div class="namaPerusahaan">
                    <label for="namaPerusahaan" class="block text-sm font-semibold leading-6 text-gray-900">Nama Perusahaan</label>
                    <div class="mt-1.5 mb-3">
                        <select name="namaPerusahaan" id="namaPerusahaan" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if ($perusahaanUser->isEmpty())
                                <option value="">Belum Ada Perusahaan</option>
                            @else
                                <option value="" disabled selected>Pilih</option>
                            @foreach ($perusahaanUser as $namaPerusahaan)
                                <option value="{{$namaPerusahaan}}" @if($namaPerusahaan == $ktt->namaPerusahaan) selected @endif>{{$namaPerusahaan}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('namaPerusahaan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="namaKtt">
                    <label for="namaKtt" class="block text-sm font-semibold leading-6 text-gray-900">Nama KTT</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="namaKtt" id="namaKtt" value="{{$ktt->namaKtt}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('namaKtt')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="noSK">
                    <label for="noSK" class="block text-sm font-semibold leading-6 text-gray-900">No SK</label>
                    <div class="mt-1.5 mb-3">
                        <input type="number" name="noSK" id="noSK" value="{{$ktt->noSK}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('noSK')
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
                                <option value="{{$bulan}}" @if($bulan == $ktt->bulan) selected @endif>{{$bulan}}</option>
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
                                <option value="{{$tahun}}" @if($tahun == $ktt->tahun) selected @endif>{{$tahun}}</option>
                            @endforeach
                        </select>
                        @error('tahun')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="fileUpload">
                    <label for="fileUpload" id="fileUpload-label" class="block text-sm font-semibold leading-6 text-gray-900">File Upload</label>
                    <div class="mt-1.5 mb-3">
                        <input type="file" id="fileUpload" name="fileUpload" value="{{$ktt->fileUpload}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('fileUpload')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-row gap-3">
                <a href="{{route('admin.ktt.index')}}">
                    <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                </a>
                <button type="submit" class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
        </form>
    </div>
@endsection
