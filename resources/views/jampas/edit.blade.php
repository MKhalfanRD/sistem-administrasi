@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Jaminan Pasca</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Edit Data Jaminan Pasca</p>
        </div>

        <form action="{{route('jampas.update', $jampas->id)}}" method="POST" class="mx-auto mt-16 max-w-5xl grid grid-cols-1 gap-4 md:grid-cols-3" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-wrap">
                <div class="namaPerusahaan mt-1.5 mb-3">
                    <label for="namaPerusahaan" class="block text-sm font-semibold leading-6 text-gray-900">Nama Perusahaan</label>
                    <select name="namaPerusahaan" id="namaPerusahaan" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @if ($perusahaanUser->isEmpty())
                            <option value="">Belum Ada Perusahaan</option>
                        @else
                            <option value="" disabled selected>Pilih</option>
                        @foreach ($perusahaanUser as $namaPerusahaan)
                        <option value="{{$namaPerusahaan}}" @if($namaPerusahaan == $jampas->namaPerusahaan) selected @endif>{{$namaPerusahaan}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="besaranDitetapkan">
                    <label for="besaranDitetapkan" class="block text-sm font-semibold leading-6 text-gray-900">Besaran Ditetapkan</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="besaranDitetapkan" id="besaranDitetapkan" value="{{$jampas->besaranDitetapkan}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('besaranDitetapkan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="tanggal">
                    <label for="tanggal" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal</label>
                    <div class="mt-1.5 mb-3">
                        <input type="date" name="tanggal" id="tanggal" value="{{$jampas->tanggal}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('tanggal')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="filePenempatan">
                    <label for="filePenempatan" class="block text-sm font-semibold leading-6 text-gray-900">File Penempatan</label>
                    <div class="mt-1.5 mb-3">
                        <input type="file" name="filePenempatan" id="filePenempatan" value="{{$jampas->filePenempatan}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('filePenempatan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="input-warp-2">
                <div class="besaranDitempatkan">
                    <label for="besaranDitempatkan" class="block text-sm font-semibold leading-6 text-gray-900">Besaran Ditempatkan</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" id="besaranDitempatkan" name="besaranDitempatkan" value="{{$jampas->besaranDitempatkan}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('besaranditempatkan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="tanggalPenempatan">
                    <label for="tanggalPenempatan" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Penempatan</label>
                    <div class="mt-1.5 mb-3">
                        <input type="date" id="tanggalPenempatan" name="tanggalPenempatan" value="{{$jampas->tanggalPenempatan}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('tanggalPenempatan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="jatuhTempo">
                    <label for="jatuhTempo" class="block text-sm font-semibold leading-6 text-gray-900">Jatuh Tempo</label>
                    <div class="mt-1.5 mb-3">
                        <input type="date" id="jatuhTempo" name="jatuhTempo" value="{{$jampas->jatuhTempo}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('jatuhTempo')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="namaBank">
                        <label for="namaBank" class="block text-sm font-semibold leading-6 text-gray-900">Nama Bank</label>
                        <div class="mt-1.5 mb-3">
                            <input type="text" id="namaBank" name="namaBank" value="{{$jampas->namaBank}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('namaBank')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                </div>
            </div>
            <div class="input-warp-3">
                <div class="bentukPenempatan">
                    <label for="bentukPenempatan" class="block text-sm font-semibold leading-6 text-gray-900">Bentuk Penempatan</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" id="bentukPenempatan" name="bentukPenempatan" value="{{$jampas->bentukPenempatan}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('bentukPenempatan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            <div class="noSeri">
                    <label for="noSeri" class="block text-sm font-semibold leading-6 text-gray-900">No Seri</label>
                    <div class="mt-1.5 mb-3">
                        <input type="number" id="noSeri" name="noSeri" value="{{$jampas->noSeri}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('noSeri')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            <div class="noRekening">
                    <label for="noRekening" class="block text-sm font-semibold leading-6 text-gray-900">No Rekening</label>
                    <div class="mt-1.5 mb-3">
                        <input type="number" id="noRekening" name="noRekening" value="{{$jampas->noRekening}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('noRekening')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            <div class="filePasca">
                    <label for="filePasca" class="block text-sm font-semibold leading-6 text-gray-900">File</label>
                    <div class="mt-1.5 mb-3">
                        <input type="file" id="filePasca" name="filePasca" value="{{$jampas->filePasca}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('filePasca')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            </div>
            <div class="flex flex-row gap-3">
                <a href="{{route('jampas.index')}}">
                    <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                </a>
                <button type="submit" class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
        </form>
    </div>
@endsection
