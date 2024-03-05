@extends('index')
@section('content')
    <div class="px-6 py-10">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Produksi</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Masukkan Jumlah Produksi Satuan Per Bulan</p>
        </div>

        <form action="#" method="POST" class="mx-auto mt-16 max-w-xs">
            <div class="input-wrap">
                <div class="namaPerusahaan">
                    <label for="namaPerusahaan" class="block text-sm font-semibold leading-6 text-gray-900">Nama Perusahaan</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="namaPerusahaan" id="namaPerusahaan" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="volume">
                    <label for="volume" class="block text-sm font-semibold leading-6 text-gray-900">Volume</label>
                    <div class="mt-1.5 mb-3">
                        <input type="number" name="volume" id="volume" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="tonase flex flex-row gap-3 mb-3">
                    <div class="relative flex-1">
                        <label for="tonase" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                        <input type="number" name="tonase" id="tonase" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <div class="relative flex-1">
                        <label for="satuan" class="block text-sm font-semibold leading-6 text-gray-900">Satuan</label>
                        <select id="satuan" name="satuan" autocomplete="satuan" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="kg">Kg</option>
                            <option value="kwintal">Kwintal</option>
                            <option value="ton">Ton</option>
                        </select>
                    </div>
                </div>
                <div class="date">
                    <label for="tanggal" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal</label>
                    <div class="mt-1.5 mb-3">
                        <input type="date" id="tanggal" name="tanggal" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="flex flex-row mt-10 gap-3">
                    <button type="button" onclick="window.history.back()" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                    <button type="submit" class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
