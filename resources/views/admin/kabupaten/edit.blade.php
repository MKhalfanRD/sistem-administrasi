@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Kabupaten</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Edit Data Kabupaten</p>
        </div>

        <form id="form" action="{{route('admin.kabupaten.update', $kabupaten->id)}}" method="POST" class="mx-auto mt-16 max-w-xl" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-wrap-2">
                <div class="kabupaten">
                    <label for="kabupaten" class="block text-sm font-semibold leading-6 text-gray-900">Nama Kabupaten</label>
                    <div class="mt-1.5 mb-3">
                        <div class="dynamic-item flex mb-3 gap-4">
                            <input type="text" name="kabupaten" id="kabupaten" value="{{$kabupaten->kabupaten}}" class="w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('kabupaten')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="input-wrap-1">
                <div class="flex flex-row mt-3 gap-3">
                    <a href="{{route('admin.kabupaten.index')}}">
                        <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                    </a>
                    <button type="submit" class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                </div>
            </div>
        </form>
    </div>

@endsection
