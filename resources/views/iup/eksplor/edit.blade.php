@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Eksplorasi</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Edit Data Eksplorasi</p>
        </div>

        <form action="{{route('eksplor.update', $IUP->id)}}" method="POST" class="mx-auto mt-16 max-w-5xl grid grid-cols-1 gap-4 md:grid-cols-3" enctype="multipart/form-data">
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
                            <option value="{{$namaPerusahaan}}" @if($namaPerusahaan == $eksplor->namaPerusahaan) selected @endif>{{$namaPerusahaan}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="alamat">
                    <label for="alamat" class="block text-sm font-semibold leading-6 text-gray-900">Alamat</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="alamat" id="alamat"value="{{$eksplor->alamat}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('alamat')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="npwp">
                    <label for="npwp" class="block text-sm font-semibold leading-6 text-gray-900">NPWP</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="npwp" id="npwp" value="{{$eksplor->npwp}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('npwp')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="nib">
                    <label for="nib" class="block text-sm font-semibold leading-6 text-gray-900">NIB</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="nib" id="nib" value="{{$eksplor->nib}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('nib')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="input-warp-2">
                <div class="kabupaten">
                    <label for="kabupaten" class="block text-sm font-semibold leading-6 text-gray-900">Kabupaten</label>
                    <div class="mt-1.5 mb-3">
                        <select name="kabupaten" id="kabupaten" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if ($kabupaten->isEmpty())
                                <option value="">Belum Ada Kabupaten</option>
                            @else
                                <option value="" disabled selected>Pilih</option>
                            @foreach ($kabupaten as $kabupaten)
                                <option value="{{$kabupaten}}" @if($kabupaten == $eksplor->kabupaten) selected @endif>{{$kabupaten}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="luasWilayah">
                    <label for="luasWilayah" class="block text-sm font-semibold leading-6 text-gray-900">Luas Wilayah</label>
                    <div class="mt-1.5 mb-3">
                        <input type="number" id="luasWilayah" name="luasWilayah" value="{{$eksplor->luasWilayah}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('luasWilayah')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="lokasiIzin">
                    <label for="lokasiIzin" class="block text-sm font-semibold leading-6 text-gray-900">Lokasi Izin</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" id="lokasiIzin" name="lokasiIzin" value="{{$eksplor->lokasiIzin}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('lokasiIzin')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            </div>
            <div class="input-warp-3">
            <div class="tahapanKegiatan">
                <label for="tahapanKegiatan" class="block text-sm font-semibold leading-6 text-gray-900">Tahapan Kegiatan</label>
                <div class="mt-1.5 mb-3">
                    <select name="tahapanKegiatan" id="tahapanKegiatan" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="" disabled selected>Pilih</option>
                        @foreach ($tahapanKegiatan as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    @error('tahapanKegiatan')
                    <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
            </div>
            </div>
            <div class="flex flex-row gap-3">
                <a href="{{route('eksplor.index')}}">
                    <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                </a>
                <button type="submit" class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
            <div id="modal" class="fixed mt-10 top-52 right-32 bg-gray-200 rounded-md shadow-lg overflow-hidden mx-auto max-w-sm z-50" style="display: none;">
                <input type="hidden" name="fromModal" value="true">
            </div>
        </form>
    </div>

    <script>
        document.getElementById('tahapanKegiatan').addEventListener('change', function() {
            var selectedValue = this.value;
            var modalContent = '';

            if (selectedValue === 'WIUP') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-3 grid grid-cols-1 gap-4 md:grid-cols-2 mx-auto">
                <div class="tanggalSK_wiup">
                    <label for="tanggalSK_wiup" id="tanggalSK_wiup" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal SK</label>
                    <div class="">
                        <input type="date" id="tanggalSK_wiup" name="tanggalSK_wiup" value="{{$IUP->tanggalSK_wiup}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="noSK_wiup">
                    <label for="noSK_wiup" id="noSK_wiup" class="block text-sm font-semibold leading-6 text-gray-900">No SK</label>
                    <div class="">
                        <input type="number" id="noSK_wiup" name="noSK_wiup" value="{{$IUP->noSK_wiup}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="golongan_wiup">
                    <label for="golongan" class="block text-sm font-semibold leading-6 text-gray-900">Golongan</label>
                    <div class="mt-1.5 mb-3">
                        <select name="golongan_wiup" id="golongan_wiup" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($golongan_wiup as $key => $value)
                                <option value="{{$key}}" @if($key == $golonganSelectedWiup) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                        @error('golongan_wiup')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="komoditas_wiup">
                    <label for="komoditas_wiup" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                    <div class="mt-1.5 mb-3">
                        <select name="komoditas_wiup" id="komoditas_wiup" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if (is_array($komoditas) || is_object($komoditas))
                                @if ($komoditas->isEmpty())
                                    <option value="">Belum ada komoditas</option>
                                @else
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($komoditas as $item)
                                        <option value="{{$item}}" @if($item == $IUP->komoditas_wiup) selected @endif>{{$item}}</option>
                                    @endforeach
                                @endif
                            @else
                                <option value="{{$komoditas}}">{{$komoditas}}</option>
                            @endif
                        </select>
                        @error('komoditas_wiup')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="scanSK_wiup">
                    <label for="scanSK_wiup" id="scanSK_wiup-label" class="block text-sm font-semibold leading-6 text-gray-900">Scan SK</label>
                    <div class="">
                        <input type="file" id="scanSK_wiup" name="scanSK_wiup" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('scanSK_wiup')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
                </div>
                </div>
                `;
            } else if (selectedValue === 'IUP Tahap Eksplorasi') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-3 grid grid-cols-1 gap-4 md:grid-cols-2 mx-auto">
                <div class="tanggalSK_eksplor">
                    <label for="tanggalSK_eksplor" id="tanggalSK_eksplor" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal SK</label>
                    <div class="">
                        <input type="date" id="tanggalSK_eksplor" name="tanggalSK_eksplor" value="{{$IUP->tanggalSK_eksplor}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="noSK_eksplor">
                    <label for="noSK_eksplor" id="noSK_eksplor" class="block text-sm font-semibold leading-6 text-gray-900">No SK</label>
                    <div class="">
                        <input type="number" id="noSK_eksplor" name="noSK_eksplor" value="{{$IUP->noSK_eksplor}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="masaBerlaku_eksplor">
                    <label for="masaBerlaku_eksplor" id="masaBerlaku_eksplor" class="block text-sm font-semibold leading-6 text-gray-900">Masa Berlaku</label>
                    <div class="">
                        <input type="number" id="masaBerlaku_eksplor" name="masaBerlaku_eksplor" value="{{$IUP->masaBerlaku_eksplor}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="tanggalBerakhir_eksplor">
                    <label for="tanggalBerakhir_eksplor" id="tanggalBerakhir_eksplor" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Berakhir</label>
                    <div class="">
                        <input type="date" id="tanggalBerakhir_eksplor" name="tanggalBerakhir_eksplor" value="{{$IUP->tanggalBerakhir_eksplor}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="golongan_eksplor">
                    <label for="golongan_eksplor" class="block text-sm font-semibold leading-6 text-gray-900">Golongan</label>
                    <div class="mt-1.5 mb-3">
                        <select name="golongan_eksplor" id="golongan_eksplor" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($golongan_eksplor as $key => $value)
                                <option value="{{$key}}" @if($key == $golonganSelectedEksplor) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    @error('golongan_eksplor')
                    <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
                </div>
                <div class="komoditas_eksplor">
                    <label for="komoditas_eksplor" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                    <div class="mt-1.5 mb-3">
                        <select name="komoditas_eksplor" id="komoditas_eksplor" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if (is_array($komoditas) || is_object($komoditas))
                                @if ($komoditas->isEmpty())
                                    <option value="">Belum ada komoditas</option>
                                @else
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($komoditas as $item)
                                        <option value="{{$item}}" @if($item == $IUP->komoditas_eksplor) selected @endif>{{$item}}</option>
                                    @endforeach
                                @endif
                            @else
                                <option value="{{$komoditas}}">{{$komoditas}}</option>
                            @endif
                        </select>
                        @error('komoditas_eksplor')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="scanSK_eksplor">
                    <label for="scanSK_eksplor" id="scanSK_eksplor-label" class="block text-sm font-semibold leading-6 text-gray-900">Scan SK</label>
                    <div class="">
                        <input type="file" id="scanSK_eksplor" name="scanSK_eksplor" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('scanSK_eksplor')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" id="simpanModal" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
                </div>
                </div>
                `;
            } else if (selectedValue === 'IUP Tahap Operasi Produksi') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-3 grid grid-cols-1 gap-4 md:grid-cols-2 mx-auto">
                <div class="tanggalSK_op">
                    <label for="tanggalSK_op" id="tanggalSK_op" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal SK</label>
                    <div class="">
                        <input type="date" id="tanggalSK_op" name="tanggalSK_op" value="{{$IUP->tanggalSK_op}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="noSK_op">
                    <label for="noSK_op" id="noSK_op" class="block text-sm font-semibold leading-6 text-gray-900">No SK</label>
                    <div class="">
                        <input type="number" id="noSK_op" name="noSK_op" value="{{$IUP->noSK_op}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="masaBerlaku_op">
                    <label for="masaBerlaku_op" id="masaBerlaku_op" class="block text-sm font-semibold leading-6 text-gray-900">Masa Berlaku</label>
                    <div class="">
                        <input type="number" id="masaBerlaku_op" name="masaBerlaku_op" value="{{$IUP->masaBerlaku_op}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="tanggalBerakhir_op">
                    <label for="tanggalBerakhir_op" id="tanggalBerakhir_op" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Berakhir</label>
                    <div class="">
                        <input type="date" id="tanggalBerakhir_op" name="tanggalBerakhir_op" value="{{$IUP->tanggalBerakhir_op}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="golongan_op">
                    <label for="golongan_op" class="block text-sm font-semibold leading-6 text-gray-900">Golongan</label>
                    <div class="mt-1.5 mb-3">
                        <select name="golongan_op" id="golongan_op" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($golongan_op as $key => $value)
                                <option value="{{$key}}" @if($key == $golonganSelectedOp) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    @error('golongan_op')
                    <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
                </div>
                <div class="komoditas_op">
                    <label for="komoditas_op" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                    <div class="mt-1.5 mb-3">
                        <select name="komoditas_op" id="komoditas_op" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if (is_array($komoditas) || is_object($komoditas))
                                @if ($komoditas->isEmpty())
                                    <option value="">Belum ada komoditas</option>
                                @else
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($komoditas as $item)
                                        <option value="{{$item}}" @if($item == $IUP->komoditas_op) selected @endif>{{$item}}</option>
                                    @endforeach
                                @endif
                            @else
                                <option value="{{$komoditas}}">{{$komoditas}}</option>
                            @endif
                        </select>
                        @error('komoditas_op')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="scanSK_op">
                    <label for="scanSK_op" id="scanSK_op-label" class="block text-sm font-semibold leading-6 text-gray-900">Scan SK</label>
                    <div class="">
                        <input type="file" id="scanSK_op" name="scanSK_op" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('scanSK_op')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" id="simpanModal" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
                </div>
                </div>
                `;
            } else if (selectedValue === 'Perpanjangan 1 IUP Tahap Operasi Produksi') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-3 grid grid-cols-1 gap-4 md:grid-cols-2 mx-auto">
                <div class="tanggalSK_p1">
                    <label for="tanggalSK_p1" id="tanggalSK_p1" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal SK</label>
                    <div class="">
                        <input type="date" id="tanggalSK_p1" name="tanggalSK_p1" value="{{$IUP->tanggalSK_p1}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="noSK_p1">
                    <label for="noSK_p1" id="noSK_p1" class="block text-sm font-semibold leading-6 text-gray-900">No SK</label>
                    <div class="">
                        <input type="number" id="noSK_p1" name="noSK_p1" value="{{$IUP->noSK_p1}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="masaBerlaku_p1">
                    <label for="masaBerlaku_p1" id="masaBerlaku_p1" class="block text-sm font-semibold leading-6 text-gray-900">Masa Berlaku</label>
                    <div class="">
                        <input type="number" id="masaBerlaku_p1" name="masaBerlaku_p1" value="{{$IUP->masaBerlaku_p1}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="tanggalBerakhir_p1">
                    <label for="tanggalBerakhir_p1" id="tanggalBerakhir_p1" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Berakhir</label>
                    <div class="">
                        <input type="date" id="tanggalBerakhir_p1" name="tanggalBerakhir_p1" value="{{$IUP->tanggalBerakhir_p1}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="golongan_p1">
                    <label for="golongan_p1" class="block text-sm font-semibold leading-6 text-gray-900">Golongan</label>
                    <div class="mt-1.5 mb-3">
                    <select name="golongan_p1" id="golongan_p1" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <select name="golongan_p1" id="golongan_p1" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($golongan_p1 as $key => $value)
                                <option value="{{$key}}" @if($key == $golonganSelectedP1) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </select>
                    @error('golongan_p1')
                    <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
                </div>
                <div class="komoditas_p1">
                    <label for="komoditas_p1" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                    <div class="mt-1.5 mb-3">
                        <select name="komoditas_p1" id="komoditas_p1" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if (is_array($komoditas) || is_object($komoditas))
                                @if ($komoditas->isEmpty())
                                    <option value="">Belum ada komoditas</option>
                                @else
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($komoditas as $item)
                                        <option value="{{$item}}" @if($item == $IUP->komoditas_p1) selected @endif>{{$item}}</option>
                                    @endforeach
                                @endif
                            @else
                                <option value="{{$komoditas}}">{{$komoditas}}</option>
                            @endif
                        </select>
                        @error('komoditas_p1')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="scanSK_p1">
                    <label for="scanSK_p1" id="scanSK_p1-label" class="block text-sm font-semibold leading-6 text-gray-900">Scan SK</label>
                    <div class="">
                        <input type="file" id="scanSK_p1" name="scanSK_p1" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('scanSK_p1')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" id="simpanModal" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
                </div>
                </div>
                `;
            } else if (selectedValue === 'Perpanjangan 2 IUP Tahap Operasi Produksi') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-3 grid grid-cols-1 gap-4 md:grid-cols-2 mx-auto">
                <div class="tanggalSK_p2">
                    <label for="tanggalSK_p2" id="tanggalSK_p2" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal SK</label>
                    <div class="">
                        <input type="date" id="tanggalSK_p2" name="tanggalSK_p2" value="{{$IUP->tanggalSK_p2}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="noSK_p2">
                    <label for="noSK_p2" id="noSK_p2" class="block text-sm font-semibold leading-6 text-gray-900">No SK</label>
                    <div class="">
                        <input type="number" id="noSK_p2" name="noSK_p2" value="{{$IUP->noSK_p2}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="masaBerlaku_p2">
                    <label for="masaBerlaku_p2" id="masaBerlaku_p2" class="block text-sm font-semibold leading-6 text-gray-900">Masa Berlaku</label>
                    <div class="">
                        <input type="number" id="masaBerlaku_p2" name="masaBerlaku_p2" value="{{$IUP->masaBerlaku_p2}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="tanggalBerakhir_p2">
                    <label for="tanggalBerakhir_p2" id="tanggalBerakhir_p2" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Berakhir</label>
                    <div class="">
                        <input type="date" id="tanggalBerakhir_p2" name="tanggalBerakhir_p2" value="{{$IUP->tanggalBerakhir_p2}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="golongan_p2">
                    <label for="golongan_p2" class="block text-sm font-semibold leading-6 text-gray-900">Golongan</label>
                    <div class="mt-1.5 mb-3">
                        <select name="golongan_p2" id="golongan_p2" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($golongan_p2 as $key => $value)
                                <option value="{{$key}}" @if($key == $golonganSelectedP2) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    @error('golongan_p2')
                    <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
                </div>
                <div class="komoditas_p2">
                    <label for="komoditas_p2" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                    <div class="mt-1.5 mb-3">
                        <select name="komoditas_p2" id="komoditas_p2" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if (is_array($komoditas) || is_object($komoditas))
                                @if ($komoditas->isEmpty())
                                    <option value="">Belum ada komoditas</option>
                                @else
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($komoditas as $item)
                                        <option value="{{$item}}" @if($item == $IUP->komoditas_p2) selected @endif>{{$item}}</option>
                                    @endforeach
                                @endif
                            @else
                                <option value="{{$komoditas}}">{{$komoditas}}</option>
                            @endif
                        </select>
                        @error('komoditas_p2')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="scanSK_p2">
                    <label for="scanSK_p2" id="scanSK_p2-label" class="block text-sm font-semibold leading-6 text-gray-900">Scan SK</label>
                    <div class="">
                        <input type="file" id="scanSK_p2" name="scanSK_p2" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('scanSK_p2')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" id="simpanModal" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
                </div>
                </div>
                `;
            }

            document.getElementById('modal').innerHTML = modalContent;
            showModal();
        });

        function showModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';

        document.getElementById('simpanModal').addEventListener('click', function(){
            var formData = {};
            var selectedValue = document.getElementById('tahapanKegiatan').value;

            if(selectedValue = 'WIUP'){
                formData.tanggalSK = document.getElementById('tanggalSK_wiup').value;
                formData.noSK = document.getElementById('noSK_wiup').value;
                formData.scanSK_wiup = document.getElementById('scanSK_wiup').value;
            }
            else if(selectedValue = 'IUP Tahap Eksplorasi'){
                formData.tanggalSK = document.getElementById('tanggalSK_eksplor').value;
                formData.noSK = document.getElementById('noSK_eksplor').value;
                formData.masaBerlaku = document.getElementById('masaBerlaku_eksplor').value;
                formData.tanggalBerakhir = document.getElementById('tanggalBerakhir_eksplor').value;
                formData.scanSK_eksplor = document.getElementById('scanSK_eksplor').value;
            }
            else if(selectedValue = 'IUP Tahap Operasi Produksi'){
                formData.tanggalSK = document.getElementById('tanggalSK_op').value;
                formData.noSK = document.getElementById('noSK_op').value;
                formData.masaBerlaku = document.getElementById('masaBerlaku_op').value;
                formData.tanggalBerakhir = document.getElementById('tanggalBerakhir_op').value;
                formData.scanSK_op = document.getElementById('scanSK_op').value;
            }
            else if(selectedValue = 'Perpanjangan 1 IUP Tahap Operasi Produksi'){
                formData.tanggalSK = document.getElementById('tanggalSK_p1').value;
                formData.noSK = document.getElementById('noSK_p1').value;
                formData.masaBerlaku = document.getElementById('masaBerlaku_p1').value;
                formData.tanggalBerakhir = document.getElementById('tanggalBerakhir_p1').value;
                formData.scanSK_p1 = document.getElementById('scanSK_p1').value;
            }
            else if(selectedValue = 'Perpanjangan 2 IUP Tahap Operasi Produksi'){
                formData.tanggalSK = document.getElementById('tanggalSK_p2').value;
                formData.noSK = document.getElementById('noSK_p2').value;
                formData.masaBerlaku = document.getElementById('masaBerlaku_p2').value;
                formData.tanggalBerakhir = document.getElementById('tanggalBerakhir_p2').value;
                formData.scanSK_p2 = document.getElementById('scanSK_p2').value;
            }

            axios.post('/iup/store-from-modal', formData)
            .then(function(response){
                console.log(response.data);
            })
            .catch(function(error){
                console.error(error);
            });
        });
    }
    </script>

@endsection
