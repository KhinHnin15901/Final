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
    <body>
        <div class="min-h-screen bg-white flex flex-col items-center justify-center font-[Arial] px-4 py-10">

            <!-- Heading -->
            <h1 class="text-2xl md:text-4xl font-bold mb-12 text-[#000120] tracking-wide">
                Please Choose an Option Below
            </h1>

            <!-- Cards Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-3xl">

                <!-- Journal Card -->
                <a href="{{ route('guest.home') }}"
                class="block rounded-xl border border-gray-200 shadow-sm shadow-[#027c7d] hover:shadow-lg hover:shadow-[#027c7d] bg-white text-[#000120] p-8 transition duration-300 hover:-translate-y-1">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full bg-[#d6dd42] flex items-center justify-center mb-4">
                            <span class="text-[#000120] font-bold text-xl">J</span>
                        </div>
                        <h2 class="text-xl font-semibold mb-2">Journal</h2>
                        <p class="text-gray-500 text-center text-sm">Explore our journals and events</p>
                    </div>
                </a>

                <!-- Conference Card -->
                <a href="#"
                class="block rounded-xl border border-gray-200 shadow-sm shadow-[#027c7d] hover:shadow-lg hover:shadow-[#027c7d] bg-white text-[#000120] p-8 transition duration-300 hover:-translate-y-1">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full bg-[#027c7d] flex items-center justify-center mb-4">
                            <span class="text-white font-bold text-xl">C</span>
                        </div>
                        <h2 class="text-xl font-semibold mb-2">Conference</h2>
                        <p class="text-gray-500 text-center text-sm">Explore our conferences and events</p>
                    </div>
                </a>

            </div>

        </div>
    </body>
</html>
