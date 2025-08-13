<!doctype html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'E-Journal System')</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Favicon -->
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <link rel="shortcut icon" href="{{ asset('assets/img/logo/logo.jpg') }}">

        <!-- Alpine.js -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <!-- Fonts & Icons -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
            integrity="sha512-yNf5F6UiwXtEMVnQJqZzO2N0PjYx6TRZfVxQK9LuH7/mq5B6iUmri+9rLQZCJDLwJykLJHho3e1ZkBuHJzFg8w=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body class="min-h-screen flex flex-col bg-gray-100 text-gray-800 antialiased font-arial">
        {{-- Header --}}
        @include('guest.layout.header')

        {{-- Main Content --}}
        <main class="px-4 sm:px-6 lg:px-8 flex-grow flex items-center justify-center">
            @yield('main-content')
        </main>

        {{-- Footer --}}
        @include('guest.layout.footer')
    </body>
</html>
