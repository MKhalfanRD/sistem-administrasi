@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table Izin Usaha Pertambangan</h2>
        </div>
        <a href="{{route('iup.create')}}">
            <button type="submit" class="mt-5 mb-5 block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Data</button>
        </a>

        <div class="mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nama Perusahaan
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            NPWP
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            NIB
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Kabupaten
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Luas Wilayah
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Komoditas
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Lokasi Izin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status Izin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Scan SK
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
                    @foreach ($IUP as $iup)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <div class="row-content">
                            <th class="px-6 py-4">
                                @php
                                    $counter++;
                                @endphp
                                {{$counter}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$iup->namaPerusahaan}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$iup->alamat}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$iup->npwp}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$iup->nib}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$iup->kabupaten}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$iup->luasWilayah}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$iup->komoditas}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$iup->lokasiIzin}}
                            </th>
                            <th scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($iup->statusIzin == 'Aktif')
                                    <span class="bg-green-300 px-3 py-2 text-green-700 rounded-md">Aktif</span>
                                @else
                                    <span class="bg-red-300 px-2 py-2 text-red-700 rounded-md">Tidak Aktif</span>
                                @endif
                            </th>
                            <th scope="row" class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($iup->scanSK)
                                    <a href="{{asset('storage/' .$iup->scanSK)}}" target="_blank">
                                        <img src="{{ asset('icon/ikon-pdf.png') }}" class="bg-gray-300 hover:bg-gray-200 rounded-md p-1 w-10 h-10 mx-auto" alt="PDF Icon">
                                    </a>
                                @else
                                    <p>Tidak Ada</p>
                                @endif
                            </th>
                        </div>
                        <div class="details-content hidden">
                            <table class="table-auto w-full">
                                <thead>
                                  <tr>
                                    <th class="px-4 py-2 text-center">
                                      WIUP
                                      <div class="flex flex-row space-x-2">
                                        <span class="text-sm">Tanggal SK</span>
                                        <span class="text-sm">No SK</span>
                                      </div>
                                    </th>
                                    <th class="px-4 py-2 text-center">
                                      IUP Eksplorasi
                                      <div class="flex flex-row space-x-2">
                                        <span class="text-sm">Tanggal SK</span>
                                        <span class="text-sm">No SK</span>
                                        <span class="text-sm">Masa Berlaku</span>
                                        <span class="text-sm">Tanggal Berakhir</span>
                                      </div>
                                    </th>
                                    <th class="px-4 py-2 text-center">
                                      IUP Operasi Produksi
                                      <div class="flex flex-row space-x-2">
                                        <span class="text-sm">Tanggal SK</span>
                                        <span class="text-sm">No SK</span>
                                        <span class="text-sm">Masa Berlaku</span>
                                        <span class="text-sm">Tanggal Berakhir</span>
                                      </div>
                                    </th>
                                    <th class="px-4 py-2 text-center">
                                      Perpanjangan 1
                                      <div class="flex flex-row space-x-2">
                                        <span class="text-sm">Tanggal SK</span>
                                        <span class="text-sm">No SK</span>
                                        <span class="text-sm">Masa Berlaku</span>
                                        <span class="text-sm">Tanggal Berakhir</span>
                                      </div>
                                    </th>
                                    <th class="px-4 py-2 text-center">
                                      Perpanjangan 2
                                      <div class="flex flex-row space-x-2">
                                        <span class="text-sm">Tanggal SK</span>
                                        <span class="text-sm">No SK</span>
                                        <span class="text-sm">Masa Berlaku</span>
                                        <span class="text-sm">Tanggal Berakhir</span>
                                      </div>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td class="px-4 py-2 border"></td>
                                    <td class="px-4 py-2 border"></td>
                                  </tr>
                                </tbody>
                              </table>

                        </div>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="btn-wrap flex flex-row gap-3">
                                <a href="{{route('iup.edit', $iup->id)}}">
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                </a>
                                <form action="{{route('iup.destroy', $iup->id)}}" method="POST">
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
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const rows = document.querSelectorAll('tr');
            rows.forEach(row => {
                row.addEventListener('click', function(){
                    const detailsContent = this.querySelector('.details-content');
                    detailsContent.classList.toggle('hidden');
                })
            })
        })
    </script>
@endsection
