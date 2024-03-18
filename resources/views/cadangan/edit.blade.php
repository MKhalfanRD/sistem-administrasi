@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Cadangan</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Edit Data Cadangan</p>
        </div>

        <form action="{{route('cadangan.update', $cadangan->id)}}" method="POST" class="mx-auto mt-16 max-w-5xl grid grid-cols-1 gap-4 md:grid-cols-2" enctype="multipart/form-data">
            @csrf
            @method('PUT ')
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
                            <option value="{{$namaPerusahaan}}" @if($namaPerusahaan == $cadangan->namaPerusahaan) selected @endif>{{$namaPerusahaan}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('namaPerusahaan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="luas">
                    <label for="luas" class="block text-sm font-semibold leading-6 text-gray-900">Luas</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="luas" id="luas" value="{{$cadangan->luas}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('luas')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="input-warp-2">
                <div class="cp">
                    <label for="cp" class="block text-sm font-semibold leading-6 text-gray-900">CP</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="cp" id="cp" value="{{$cadangan->cp}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('cp')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="jenisCadangan">
                    <label for="jenisCadangan" class="block text-sm font-semibold leading-6 text-gray-900">Jenis Cadangan</label>
                    <div class="mt-1.5 mb-3">
                        <select name="jenisCadangan" id="jenisCadangan" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($jenisCadangan as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('jenisCadangan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-row gap-3">
                <a href="{{route('cadangan.index')}}">
                    <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                </a>
                <button type="submit" class=" block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
            <div id="modal" class="fixed mt-10 top-64 right-28 bg-gray-200 rounded-md shadow-lg overflow-hidden mx-auto max-w-64 z-50" style="display: none;">
                <input type="hidden" name="fromModal" value="true">
            </div>
        </form>

    </div>



    <script>
        document.getElementById('jenisCadangan').addEventListener('change', function() {
            var selectedValue = this.value;
            var modalContent = '';

            if (selectedValue === 'Terkira') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-10 max-w-xs mx-auto">
                <div class="volumeTerkira">
                    <label for="volumeTerkira" id="volumeTerkira" class="block text-sm font-semibold leading-6 text-gray-900">Volume</label>
                    <div class="">
                        <input type="text" id="volumeTerkira" name="volumeTerkira" value="{{$cadangan->volumeTerkira}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="tonaseTerkira">
                    <label for="tonaseTerkira" id="tonaseTerkira" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                    <div class="">
                        <input type="text" id="tonaseTerkira" name="tonaseTerkira" value="{{$cadangan->tonaseTerkira}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
                </div>
                </div>
                `;
            } else if (selectedValue === 'Terbukti') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-10 max-w-xs mx-auto">
                <div class="volumeTerbukti">
                    <label for="volumeTerbukti" id="volumeTerbukti" class="block text-sm font-semibold leading-6 text-gray-900">Volume</label>
                    <div class="">
                        <input type="text" id="volumeTerbukti" name="volumeTerbukti" value="{{$cadangan->volumeTerbukti}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="tonaseTerbukti">
                    <label for="tonaseTerbukti" id="tonaseTerbukti" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                    <div class="">
                        <input type="text" id="tonaseTerbukti" name="tonaseTerbukti" value="{{$cadangan->tonaseTerbukti}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
                </div>
                </div>
                `;
            } else if (selectedValue === 'Terukur') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-10 max-w-xs mx-auto">
                <div class="volumeTerukur">
                    <label for="volumeTerukur" id="volumeTerukur" class="block text-sm font-semibold leading-6 text-gray-900">Volume</label>
                    <div class="">
                        <input type="text" id="volumeTerukur" name="volumeTerukur" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="tonaseTerukur">
                    <label for="tonaseTerukur" id="tonaseTerukur" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                    <div class="">
                        <input type="number" id="tonaseTerukur" name="tonaseTerukur" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
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
            var selectedValue = document.getElementById('jenisCadangan').value;

            if(selectedValue = 'Terkira'){
                formData.volume = document.getElementById('volumeTerkira').value;
                formData.tonase = document.getElementById('tonaseTerkira').value;
            }
            else if(selectedValue = 'Terbukti'){
                formData.volume = document.getElementById('volumeTerbukti').value;
                formData.tonase = document.getElementById('tonaseTerbukti').value;
            }

            axios.post('/cadangan/store-from-modal', formData)
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
