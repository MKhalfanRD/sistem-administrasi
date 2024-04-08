@extends('layout.index')
@section('content')

        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table User</h2>
        </div>
        <div class="">
            <div class="max-w-sm mt-5 mx-auto rounded-md shadow-md overflow-hidden p-4 bg-gray-800">
                <img src="{{asset('storage/'.$userData->logo)}}" alt="" class="object-cover w-24 h-24 rounded-full mx-auto">
                <div class="p-4 text-center">
                  <h3 class="mb-1 text-xl font-medium text-gray-100">{{$userData->namaPerusahaan}}</h3>
                  <span class="text-sm text-white">{{$userData->email}}</span>
                </div>
                <div class="flex mt-2 space-x-3 lg:mt-6 font-medium text-sm justify-center">
                    <a href="{{route('user.edit', $userData->id)}}">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                    </a>
                </div>
            </div>
        </div>

@endsection
