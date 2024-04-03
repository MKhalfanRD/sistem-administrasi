@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Sumberdaya</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Edit Data Sumberdaya</p>
        </div>

        <form id="form" action="{{route('sumberdaya.update', $sumberdaya->id)}}" method="POST" class="mx-auto mt-16 max-w-5xl grid grid-cols-1 gap-4 md:grid-cols-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                            <option value="{{$namaPerusahaan}}" @if($namaPerusahaan == $sumberdaya->namaPerusahaan) selected @endif>{{$namaPerusahaan}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('namaPerusahaan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="komoditas">
                    <label for="komoditas" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                    <div class="mt-1.5 mb-3">
                        <select name="komoditas" id="komoditas" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if ($komoditas->isEmpty())
                                <option value="">Belum Ada Komoditas</option>
                            @else
                                <option value="" disabled selected>Pilih</option>
                            @foreach ($komoditas as $komoditas)
                                <option value="{{$komoditas}}" @if($komoditas == $sumberdaya->komoditas) selected @endif>{{$komoditas}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('komoditas')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="luas">
                    <label for="luas" class="block text-sm font-semibold leading-6 text-gray-900">Luas</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="luas" id="luas"value="{{$sumberdaya->luas}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                        <input type="text" name="cp" id="cp"value="{{$sumberdaya->cp}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('cp')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="jenisSdm">
                    <label for="jenisSdm" class="block text-sm font-semibold leading-6 text-gray-900">Jenis SDM</label>
                    <div class="mt-1.5 mb-3">
                        <select name="jenisSdm" id="jenisSdm" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($jenisSdm as $key => $value)
                            <option value="{{$key}}" @if($key == $jenisSdmSelected) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                        @error('jenisSdm')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-row gap-3">
                <a href="{{route('sumberdaya.index')}}">
                    <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                </a>
                <button type="submit" class=" block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
            <div id="modal" class="fixed mt-10 top-72 right-32 bg-gray-200 rounded-md shadow-lg overflow-hidden mx-auto max-w-64 z-50" style="display: none;">
                <input type="hidden" name="fromModal" value="true">
            </div>
        </form>
    </div>



    <script>
        document.getElementById('jenisSdm').addEventListener('change', function() {
            var selectedValue = this.value;
            var modalContent = '';

            if (selectedValue === 'Tereka') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-10 max-w-xs mx-auto">
                <div class="volumeTereka">
                    <label for="volumeTereka" id="volumeTereka" class="block text-sm font-semibold leading-6 text-gray-900">Volume</label>
                    <div class="">
                        <input type="text" id="volumeTereka" name="volumeTereka" value="{{$sumberdaya->volumeTereka}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="tonaseTereka">
                    <label for="tonaseTereka" id="tonaseTereka" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                    <div class="">
                        <input type="text" id="tonaseTereka" name="tonaseTereka" value="{{$sumberdaya->tonaseTereka}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600">Simpan</button>
                </div>
                </div>
                `;
            } else if (selectedValue === 'Tertunjuk') {
                modalContent = `
                <div class="mt-1.5 mb-3 px-10 max-w-xs mx-auto">
                <div class="volumeTertunjuk">
                    <label for="volumeTertunjuk" id="volumeTertunjuk" class="block text-sm font-semibold leading-6 text-gray-900">Volume</label>
                    <div class="">
                        <input type="text" id="volumeTertunjuk" name="volumeTertunjuk" value="{{$sumberdaya->volumeTertunjuk}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="tonaseTertunjuk">
                    <label for="tonaseTertunjuk" id="tonaseTertunjuk" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                    <div class="">
                        <input type="text" id="tonaseTertunjuk" name="tonaseTertunjuk" value="{{$sumberdaya->tonaseTertunjuk}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                        <input type="text" id="volumeTerukur" name="volumeTerukur" value="{{$sumberdaya->volumeTerukur}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="tonaseTerukur">
                    <label for="tonaseTerukur" id="tonaseTerukur" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                    <div class="">
                        <input type="text" id="tonaseTerukur" name="tonaseTerukur" value="{{$sumberdaya->tonaseTerukur}}" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
            var selectedValue = document.getElementById('jenisSdm').value;

            if(selectedValue = 'Tereka'){
                formData.volume = document.getElementById('volumeTereka').value;
                formData.tonase = document.getElementById('tonaseTereka').value;
            }
            else if(selectedValue = 'Tertunjuk'){
                formData.volume = document.getElementById('volumeTertunjuk').value;
                formData.tonase = document.getElementById('tonaseTertunjuk').value;
            }
            else if(selectedValue = 'Terukur'){
                formData.volume = document.getElementById('volumeTerukur').value;
                formData.tonase = document.getElementById('tonaseTerukur').value;
            }

            axios.post('/sumberdaya/store-from-modal', formData)
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
