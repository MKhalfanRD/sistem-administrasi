@extends('index')
@section('content')
    <div class="container mx-auto">
        <div class="w-min mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-base text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Kegiatan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            1
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Wilayah Izin Usaha Pertambangan (WIUP)
                        </th>
                    </tr>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            2
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Izin Usaha Pertambangan (IUP) Tahap Eksplorasi
                        </th>
                    </tr>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            3
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Izin Usaha Pertambangan (IUP) Tahap Operasi Produksi
                        </th>
                    </tr>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            4
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Perpanjangan Kesatu Izin Usaha Pertambangan (IUP) Tahap Operasi Produksi
                        </th>
                    </tr>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            5
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Perpanjangan Kedua Izin Usaha Pertambangan (IUP) Tahap Operasi Produksi
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
