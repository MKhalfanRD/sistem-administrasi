@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Izin Usaha Pertambangan</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Tambah Data IUP</p>
        </div>

        <form action="{{route('iup.store')}}" method="POST" class="mx-auto mt-16 max-w-5xl grid grid-cols-1 gap-4 md:grid-cols-3" enctype="multipart/form-data">
            @csrf
            <div class="input-wrap">
                <div class="namaPerusahaan">
                    <label for="namaPerusahaan" class="block text-sm font-semibold leading-6 text-gray-900">Nama Perusahaan</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="namaPerusahaan" id="namaPerusahaan" value="{{old('namaPerusahaan') ?? ''}}" class="w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('namaPerusahaan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="alamat">
                    <label for="alamat" class="block text-sm font-semibold leading-6 text-gray-900">Alamat</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="alamat" id="alamat" value="{{old('alamat') ?? ''}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('alamat')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="npwp">
                    <label for="npwp" class="block text-sm font-semibold leading-6 text-gray-900">NPWP</label>
                    <div class="mt-1.5 mb-3">
                        <input type="number" name="npwp" id="npwp" value="{{old('npwp') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('npwp')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="nib">
                    <label for="nib" class="block text-sm font-semibold leading-6 text-gray-900">NIB</label>
                    <div class="mt-1.5 mb-3">
                        <input type="number" name="nib" id="nib" value="{{old('nib') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('nib')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="kabupaten">
                    <label for="kabupaten" class="block text-sm font-semibold leading-6 text-gray-900">Kabupaten</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" id="kabupaten" name="kabupaten" value="{{old('kabupaten') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('kabupaten')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="input-warp-2">
                <div class="noSK">
                    <label for="noSK" class="block text-sm font-semibold leading-6 text-gray-900">No.SK</label>
                    <div class="mt-1.5 mb-3">
                        <input type="number" id="noSK" name="noSK" value="{{old('noSK') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('noSK')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="luasWilayah">
                    <label for="luasWilayah" class="block text-sm font-semibold leading-6 text-gray-900">Luas Wilayah</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" id="luasWilayah" name="luasWilayah" value="{{old('luasWilayah') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('luasWilayah')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="tahapanKegiatan">
                        <label for="tahapanKegiatan" class="block text-sm font-semibold leading-6 text-gray-900">Tahapan Kegiatan</label>
                        <div class="mt-1.5 mb-3">
                            <select name="tahapanKegiatan" id="tahapanKegiatan" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @foreach ($tahapanKegiatan as $tahapan)
                                    <option value="{{$tahapan}}">{{$tahapan}}</option>
                                @endforeach
                            </select>
                            @error('tahapanKegiatan')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                </div>
                <div class="komoditas">
                        <label for="komoditas" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                        <div class="mt-1.5 mb-3">
                            <input type="text" id="komoditas" name="komoditas" value="{{old('komoditas')}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('komoditas')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                </div>
                <div class="tanggalMulai">
                        <label for="tanggalMulai" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Mulai</label>
                        <div class="mt-1.5 mb-3">
                            <input type="date" id="tanggalMulai" name="tanggalMulai" value="{{old('tanggalMulai') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('tanggalMulai')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                </div>
            </div>
            <div class="input-warp-3">
            <div class="tanggalBerakhir">
                    <label for="tanggalBerakhir" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Berakhir</label>
                    <div class="mt-1.5 mb-3">
                        <input type="date" id="tanggalBerakhir" name="tanggalBerakhir" value="{{old('tanggalBerakhir') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('tanggalBerakhir')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            <div class="lokasiIzin">
                    <label for="lokasiIzin" class="block text-sm font-semibold leading-6 text-gray-900">Lokasi Izin</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" id="lokasiIzin" name="lokasiIzin" value="{{old('lokasiIzin') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('lokasiIzin')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>

            <div class="scanSK">
                    <label for="scanSK" class="block text-sm font-semibold leading-6 text-gray-900">Scan SK</label>
                    <div class="mt-1.5 mb-3">
                        <input type="file" id="scanSK" name="scanSK" value="{{old('scanSK') ?? ''}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('scanSK')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            </div>

                <div class="flex flex-row gap-3">
                    <a href="{{route('iup.index')}}">
                        <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                    </a>
                    <button type="submit" class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                </div>
        </form>
    </div>
@endsection
