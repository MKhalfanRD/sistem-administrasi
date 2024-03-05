@extends('index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left mb-5">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Jaminan Pasca</h2>
        </div>

        <input type="text" id="filter" onkeyup="filterTable()" placeholder="Cari" class="block w-1/3 rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

        <div class="flex flex-1">
            <div class="w-full">
                <table id="tableJamPas" class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Perusahaan</th>
                            <th class="py-2 px-4 border-b text-left">Besaran Ditetapkan</th>
                            <th class="py-2 px-4 border-b text-left">Tanggal</th>
                            <th class="py-2 px-4 border-b text-left">File Penempatan</th>
                            <th class="py-2 px-4 border-b text-left">Besaran Ditempatkan</th>
                            <th class="py-2 px-4 border-b text-left">Tanggal Penempatan</th>
                            <th class="py-2 px-4 border-b text-left">Jatuh Tempo</th>
                            <th class="py-2 px-4 border-b text-left">Nama Bank</th>
                            <th class="py-2 px-4 border-b text-left">Bentuk Penempatan</th>
                            <th class="py-2 px-4 border-b text-left">No Seri</th>
                            <th class="py-2 px-4 border-b text-left">No Rekening</th>
                            <th class="py-2 px-4 border-b text-left">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">Waja Niaga</td>
                            <td class="py-2 px-4 border-b">Besaran Tetap</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                            <td class="py-2 px-4 border-b">Besaran Tempat</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">Mandiri</td>
                            <td class="py-2 px-4 border-b">Bentuk Tempat</td>
                            <td class="py-2 px-4 border-b">No Seri</td>
                            <td class="py-2 px-4 border-b">No Rekening</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">Jumbotron</td>
                            <td class="py-2 px-4 border-b">Besaran Tetap</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                            <td class="py-2 px-4 border-b">Besaran Tempat</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">Mandiri</td>
                            <td class="py-2 px-4 border-b">Bentuk Tempat</td>
                            <td class="py-2 px-4 border-b">No Seri</td>
                            <td class="py-2 px-4 border-b">No Rekening</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">Persuda</td>
                            <td class="py-2 px-4 border-b">Besaran Tetap</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                            <td class="py-2 px-4 border-b">Besaran Tempat</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">Mandiri</td>
                            <td class="py-2 px-4 border-b">Bentuk Tempat</td>
                            <td class="py-2 px-4 border-b">No Seri</td>
                            <td class="py-2 px-4 border-b">No Rekening</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">Biro</td>
                            <td class="py-2 px-4 border-b">Besaran Tetap</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                            <td class="py-2 px-4 border-b">Besaran Tempat</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">Mandiri</td>
                            <td class="py-2 px-4 border-b">Bentuk Tempat</td>
                            <td class="py-2 px-4 border-b">No Seri</td>
                            <td class="py-2 px-4 border-b">No Rekening</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">Waja Niaga</td>
                            <td class="py-2 px-4 border-b">Besaran Tetap</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                            <td class="py-2 px-4 border-b">Besaran Tempat</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">12/02/25</td>
                            <td class="py-2 px-4 border-b">Mandiri</td>
                            <td class="py-2 px-4 border-b">Bentuk Tempat</td>
                            <td class="py-2 px-4 border-b">No Seri</td>
                            <td class="py-2 px-4 border-b">No Rekening</td>
                            <td class="py-2 px-4 border-b">file.png</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("filter");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableJamPas");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Kolom kedua adalah nama perusahaan, sesuaikan indeksnya jika kolom berbeda
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
