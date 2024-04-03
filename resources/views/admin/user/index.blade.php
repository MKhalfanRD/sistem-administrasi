@extends('layout.index')
@section('content')

        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table User</h2>
        </div>
        <a href="{{route('admin.create')}}">
            <button type="submit" class="mt-5 mb-5 ml-1 rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Data</button>
        </a>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            @foreach ($userData as $ud)
            <div class="w-72 max-w-sm mx-auto rounded-md shadow-md overflow-hidden p-4 bg-gray-800">
                <img src="{{asset('storage/'.$ud->logo)}}" alt="" class="object-cover w-24 h-24 rounded-full mx-auto">
                <div class="p-4 text-center">
                  <h3 class="mb-1 text-xl font-medium text-gray-100">{{$ud->namaPerusahaan}}</h3>
                  <span class="text-sm text-white">{{$ud->email}}</span>
                </div>
                <div class="flex mt-2 space-x-3 lg:mt-6 font-medium text-sm justify-center">
                    <a href="{{route('admin.edit', $ud->id)}}">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                    </a>
                    <form action="{{route('admin.destroy', $ud->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-white hover:bg-gray-700 px-5 py-2.5 rounded-lg border border-gray-300">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

@endsection
