<div class="golongan_wiup">
    <label for="golongan" class="block text-sm font-semibold leading-6 text-gray-900">Golongan</label>
    <div class="mt-1.5 mb-3">
        <select name="golongan_wiup" id="golongan_wiup" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <option value="" disabled selected>Pilih</option>
            @foreach ($golongan_wiup as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        @error('golongan_wiup')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="komoditas_wiup">
    <label for="komoditas_wiup" class="block text-sm font-semibold leading-6 text-gray-900">Komoditas</label>
    <div class="mt-1.5 mb-3">
        <select name="komoditas_wiup" id="komoditas_wiup" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @if ($komoditas->isEmpty())
            <option value="">Belum ada komoditas</option>
        @else
            <option value="" disabled selected>Pilih</option>
        @foreach ($komoditas as $komoditas_wiup)
            <option value="{{ $komoditas_wiup }}">{{ $komoditas_wiup }}</option>
        @endforeach
        @endif
        </select>
        @error('komoditas_wiup')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
</div>

<script>
    function getKomoditas(golongan) {
            $.ajax({
                url: route('admin.iup.komoditas', golongan)
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    console.log(res);
                    alert(res);
                }
            });
        }
</script>
