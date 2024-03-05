@extends('index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table User</h2>
        </div>
        <a href="/inputUser">
            <button type="submit"
                class="mt-5 mb-5 block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah
                Data</button>
        </a>

            <div class="w-min mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="text-center p-4">No</th>
                            <th class="text-center px-6 py-4">Nama Perusahaan</th>
                            <th>
                                <div class="text-center px-6 py-4">Jumlah Produksi</div>
                                <table class="flex justify-center text-gray-500 dark:text-gray-400">
                                    <tr>
                                        <th class="px-8">Volume (m3)</th>
                                        <th class="px-8">Tonase</th>
                                    </tr>
                                </table>
                            </th>
                            <th class="text-center px-6 py-4">Upload Bukti Bayar</th>
                            <th class="text-center px-6 py-4">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="text-center px-6 py-4">1</td>
                            <td class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">PT. ABC</td>
                            <td class="text-center space-x-24 flex-row font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <span class="nilaiVolume">100</span>
                                <span class="nilaiTonase">100</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                                <img src="https://lovelylampung.com/wp-content/uploads/2021/04/Logo-Provinsi-Lampung.png" alt="">
                            </td>
                            <td class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">Date</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection
