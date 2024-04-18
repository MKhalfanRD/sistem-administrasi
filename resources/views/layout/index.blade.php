<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="">

    <meta name="description" content="">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <title>Sistem Administrasi</title>

    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased flex h-screen">

    <!-- Sidebar -->
    @include('layout.sidebar')

    <!-- Main Content Area -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto w-full px-4 py-4">
            @yield('content')
        </div>
    </main>

</body>



</html>
