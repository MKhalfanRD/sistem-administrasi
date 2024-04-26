@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Cadangan</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Tambah Data Cadangan</p>
        </div>

        <form action="{{route('admin.cadangan.store')}}" method="POST" class="mx-auto mt-16 max-w-5xl grid grid-cols-1 gap-4 md:grid-cols-2" enctype="multipart/form-data">
            @csrf
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
                                <option value="{{$namaPerusahaan}}">{{$namaPerusahaan}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('namaPerusahaan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="golongan">
                        <label for="golongan" class="block text-sm font-semibold leading-6 text-gray-900">Golongan</label>
                        <div class="mt-1.5 mb-3">
                            <select name="golongan" id="golongan" class="golongan bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" disabled selected>Pilih</option>
                                @foreach ($golongan as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                @endforeach
                            </select>
                            @error('golongan')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="komoditas">
                        <label for="komoditas" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                        <div class="mt-1.5 mb-3">
                            <select name="komoditas" id="komoditas" class="komoditasList bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @if ($komoditas->isEmpty())
                                <option value="">Belum ada komoditas</option>
                            @else

                            @endif
                            </select>
                            @error('komoditas')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- <label for="komoditas" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
                    <div class="mt-1.5 mb-3">
                        <select name="komoditas" id="komoditas" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if ($komoditas->isEmpty())
                                <option value="">Belum Ada Komoditas</option>
                            @else
                                <option value="" disabled selected>Pilih</option>
                            @foreach ($komoditas as $komoditas)
                                <option value="{{$komoditas}}">{{$komoditas}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('komoditas')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div> --}}
                </div>
                <div class="luas">
                    <label for="luas" class="block text-sm font-semibold leading-6 text-gray-900">Luas</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="luas" id="luas"value="{{old('luas') ?? ''}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                        <input type="text" name="cp" id="cp"value="{{old('cp') ?? ''}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                <a href="{{route('admin.cadangan.index')}}">
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
                        <input type="text" id="volumeTerkira" name="volumeTerkira" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="tonaseTerkira">
                    <label for="tonaseTerkira" id="tonaseTerkira" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                    <div class="">
                        <input type="text" id="tonaseTerkira" name="tonaseTerkira" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                        <input type="text" id="volumeTerbukti" name="volumeTerbukti" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                </div>
                <div class="tonaseTerbukti">
                    <label for="tonaseTerbukti" id="tonaseTerbukti" class="block text-sm font-semibold leading-6 text-gray-900">Tonase</label>
                    <div class="">
                        <input type="text" id="tonaseTerbukti" name="tonaseTerbukti" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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

        document.getElementById('golongan').addEventListener('change', function() {
            var selectedGolongan = this.value;
            console.log('changed');
            getKomoditas(selectedGolongan);
        });

        function getKomoditas(golongan) {
            console.log(golongan);
            var csrfToken = $('meta[name=csrf-token]').attr('content');
            console.log(csrfToken);
            $.ajax({
                url: '/getKomoditas/' + golongan,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in the request headers
                },
                success: function(response) {
                    console.log(response);
                    // Clear existing komoditas options
                    $('.komoditasList').empty();

                    // Check if there are any komoditas returned
                    if (response.length > 0) {
                        var komoditasList = response[0].komoditas.split(
                        ', '); // Split komoditas string into an array
                        // Add a "Pilih" option with disabled attribute
                        $('.komoditasList').append($('<option>', {
                            value: '',
                            text: 'Pilih',
                            disabled: true,
                            selected: true
                        }));

                        // Add each komoditas from the array as an option
                        komoditasList.forEach(function(komoditas) {
                            $('.komoditasList').append($('<option>', {
                                value: komoditas,
                                text: komoditas // Assuming 'komoditas' is the field for komoditas name
                            }));
                        });
                    } else {
                        // Add an option indicating no komoditas available
                        $('.komoditasList').append($('<option>', {
                            value: '',
                            text: 'Tidak ada komoditas'
                        }));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

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
