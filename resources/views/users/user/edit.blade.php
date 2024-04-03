@extends('layout.index')
@section('content')
    <div class="Title">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">User</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Edit User</p>
        </div>

        <form action="{{route('user.update', $userData->id)}}" method="POST" class="mx-auto mt-16 max-w-xs" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-wrap">
                <div class="namaUser">
                    <label for="namaUser" class="block text-sm font-semibold leading-6 text-gray-900">Nama User</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="namaUser" id="namaUser" autocomplete="given-name" value="{{$userData->namaUser}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('namaUser')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="namaPerusahaan">
                    <label for="namaPerusahaan" class="block text-sm font-semibold leading-6 text-gray-900">Nama Perusahaan</label>
                    <div class="mt-1.5 mb-3">
                        <input type="text" name="namaPerusahaan" id="namaPerusahaan" autocomplete="given-name" value="{{$userData->namaPerusahaan}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('namaPerusahaan')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="email">
                    <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                    <div class="mt-1.5 mb-3">
                        <input type="email" name="email" id="email" autocomplete="email" value="{{$userData->email}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('email')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="password">
                    <label for="password" class="block text-sm font-semibold leading-6 text-gray-900">Password</label>
                    <div class="mt-1.5 mb-3">
                        <input type="password" name="password" id="password" autocomplete="password" value="{{$userData->password}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('password')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="logo">
                    <label for="logo" class="block text-sm font-semibold leading-6 text-gray-900">Logo</label>
                    <div class="mt-1.5 mb-3">
                        <input type="file" id="logo" name="logo" class="bg-white block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$userData->logo}}">
                        @error('logo')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-row mt-10 gap-3">
                    <a href="{{route('user.index')}}">
                        <button type="button" class="bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-md">Kembali</button>
                    </a>
                    <button type="submit" class="block  rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
