<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="">

    <meta name="description" content="">

    <title>skripsi</title>

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
