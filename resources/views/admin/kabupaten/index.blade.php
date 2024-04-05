@extends('layout.index')
@section('content')
    <div class="container mx-auto">
        <div class="mx-auto text-left">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Table kabupaten</h2>
        </div>
        <div class="flex justify-between mt-5 mb-5">
            <a href="{{route('admin.kabupaten.create')}}">
                <button type="submit" class=" rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Data</button>
            </a>
            @if(session('success'))
                <div id="alert" class="rounded-md bg-green-600 px-3.5 py-2.5 text-right text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{session('success')}}
                </div>
                <script>
                    @if(session('delay'))
                    window.setTimeout(function(){
                        $('#alert').fadeOut('slow');
                    }, {{session('delay')}});
                    @endif
                </script>
            @endif
        </div>

        <div class="w-fit mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-base text-gray-400 bg-gray-700">
                    <tr>
                        <th scope="col" class="p-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            kabupaten
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
                    @foreach ($kabupaten as $k)
                    <tr class="bg-gray-800 hover:bg-gray-600">
                        <th class="px-6 py-4 text-white">
                            @php
                                $counter++;
                            @endphp
                            {{$counter}}
                        </th>
                        <th class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            {{$k->kabupaten}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            <div class="btn-wrap flex flex-row gap-3">
                                <a href="{{route('admin.kabupaten.edit', $k->id)}}">
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg">Edit</button>
                                </a>
                                <form action="{{route('admin.kabupaten.destroy', $k->id)}}" method="POST">
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
@endsection
