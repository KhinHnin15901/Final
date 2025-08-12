<header class="bg-gradient-to-r from-green-100 to-blue-500 text-white shadow-md sticky top-0 z-50"
    x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Bar -->
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 hover:opacity-90 transition">
                <img src="{{ asset('assets/img/logo/logo.jpg') }}" alt="Logo" class="h-12 w-full">


            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-6 text-sm font-semibold">
                <a href="{{ route('guest.home', ['section' => 'home']) }}"
                    class="text-black hover:text-green-200 transition"
                    style="text-shadow: 2px 2px 4px rgba(222, 222, 222, 0.936);">Home</a>

                <a href="{{ route('guest.home', ['section' => 'events']) }}"
                    class="text-black hover:text-green-200 transition"
                    style="text-shadow: 2px 2px 4px rgba(222, 222, 222, 0.936);">Events</a>
                <div class="relative group inline-block">
                    <button class="text-black hover:text-green-200 transition">
                        Journals&Conferences ▼
                    </button>

                    <div
                        class="absolute hidden group-hover:block ... bg-white shadow-md rounded mt-1 z-50 text-sm min-w-[150px]">

                        <a href="{{ route('guest.home', ['section' => 'journal']) }}"
                            class="block px-4 py-2 hover:bg-green-100 text-gray-800">Journal</a>
                        <a href="{{ route('guest.home', ['section' => 'conference']) }}"
                            class="block px-4 py-2 hover:bg-green-100 text-gray-800">Conference</a>
                    </div>
                </div>
                @if (Auth::check() && Auth::user()->roles->contains('name', 'reviewer'))
                    <div class="relative group inline-block">
                        <button class="text-black hover:text-green-200 transition "
                            style="text-shadow: 2px 2px 4px rgba(222, 222, 222, 0.936);">
                            Review ▼
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="absolute hidden group-hover:block ... bg-white shadow-md rounded mt-1 z-50 text-sm min-w-[150px]">
                            <a href="{{ route('guest.home', ['section' => 'journals']) }}"
                                class="block px-4 py-2 hover:bg-green-100 text-gray-800">Journal</a>
                            <a href="{{ route('guest.home', ['section' => 'conferences']) }}"
                                class="block px-4 py-2 hover:bg-green-100 text-gray-800">Conference</a>
                        </div>
                    </div>
                @endif
                <a href="{{ route('guest.home', ['section' => 'about']) }}"
                    class="text-black hover:text-green-200 transition"
                    style="text-shadow: 2px 2px 4px rgba(222, 222, 222, 0.936);">About</a>
                <a href="{{ route('guest.home', ['section' => 'contact']) }}"
                    class="text-black hover:text-green-200 transition"
                    style="text-shadow: 2px 2px 4px rgba(222, 222, 222, 0.936);">Contact</a>



                @auth
                    @php
                        $unreadCount = auth()->user()->unreadNotifications->count();
                    @endphp

                    @if (Auth::user()->roles->contains('name', 'author'))
                        <a href="{{ route('guest.home', ['section' => 'notification']) }}"
                            class="text-black hover:text-green-200 transition "
                            style="text-shadow: 2px 2px 4px rgba(222, 222, 222, 0.936);">
                            Notifications

                            @if ($unreadCount > 0)
                                <span
                                    class="absolute -top-2 -right-3 bg-green-300 text-green-900 text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                    @endif



                @endauth


            </nav>

            <!-- Auth Buttons / Profile -->
            <div class="flex items-center gap-3">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/img/profile.jpg') }}"
                                class="w-9 h-9 rounded-full border border-green-300 shadow object-cover" alt="Avatar">
                            <div class="text-sm sm:text-base font-medium">
                                <span class="block">{{ Auth::user()->name }}</span> {{-- User name --}}

                                @php
                                    $user = Auth::user();
                                    $firstRole = $user->roles->first();
                                @endphp

                                <span class="block text-yellow-500 text-sm">
                                    {{ $firstRole ? ucfirst($firstRole->name) : 'No Role' }}
                                </span> {{-- Role below --}}
                            </div>

                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-green-500 text-white rounded-md shadow-md py-2 z-50"
                            x-transition>
                            <a href="#" class="block px-4 py-2 hover:bg-green-600">View Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 hover:bg-green-600">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('guest.home', ['section' => 'register']) }}"
                        class="bg-green-400 hover:bg-green-500 text-green-900 px-4 py-1.5 rounded-md text-sm font-medium transition">
                        Register
                    </a>
                    <a href="{{ route('guest.home', ['section' => 'login']) }}"
                        class="bg-blue-300 hover:bg-blue-400 text-blue-900 px-4 py-1.5 rounded-md text-sm font-medium transition">
                        Login
                    </a>
                @endguest

                <!-- Mobile Toggle -->
                <button @click="mobileOpen = !mobileOpen"
                    class="md:hidden text-white hover:text-green-200 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileOpen" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden" x-show="mobileOpen" x-transition>
        <div
            class="bg-gradient-to-r from-green-400 to-blue-600 border-t border-green-300 px-4 py-4 space-y-3 text-sm font-medium text-white">
            <a href="{{ route('guest.home', ['section' => 'events']) }}" class="block hover:text-green-200">Events</a>
            <a href="{{ route('guest.home', ['section' => 'about']) }}" class="block hover:text-green-200">About</a>
            <a href="{{ route('guest.home', ['section' => 'contact']) }}"
                class="block hover:text-green-200">Contact</a>

            @auth
                <a href="{{ route('guest.home', ['section' => 'notification']) }}" class="block hover:text-green-200">
                    Notifications ({{ $unreadCount }})
                </a>
            @endauth

            @guest
                <a href="{{ route('guest.home', ['section' => 'register']) }}"
                    class="block hover:text-green-200">Register</a>
                <a href="{{ route('guest.home', ['section' => 'login']) }}" class="block hover:text-green-200">Login</a>
            @endguest
        </div>
    </div>
</header>
