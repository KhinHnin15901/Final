<header class="bg-white text-[#000120] font-[Arial,sans-serif] shadow-md shadow-[#027c7d] sticky top-0 z-50 mb-10" x-data="{ mobileOpen: false }">
    {{-- #d6dd42 yellow --}}
    {{-- #027c7d green --}}
    {{-- #000120 black --}}
    @php
        $currentSection = request('section') ?? 'home';
        $journalSections = ['journal', 'conference'];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end gap-12 items-center py-4">
            <!-- Logo -->
            <div class="absolute top-0 left-6 p-2 m-2 rounded-md bg-white shadow-[#d6dd42] shadow-sm">
                <a href="/" class="flex items-center gap-2 hover:opacity-90 transition">
                    <img src="{{ asset('assets/img/logo/logo.jpg') }}" alt="Logo" class="w-16 h-auto object-contain">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6 text-sm font-semibold select-none">

                <a href="{{ route('guest.home', ['section' => 'home']) }}"
                    class="relative transition cursor-pointer
                    {{ $currentSection === 'home' ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                    Home
                </a>

                <a href="{{ route('guest.home', ['section' => 'past_issue']) }}"
                    class="relative transition cursor-pointer
                    {{ $currentSection === 'past_issue' ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                    Past Issues
                </a>

                <a href="{{ route('guest.home', ['section' => 'current_issue']) }}"
                    class="relative transition cursor-pointer
                    {{ $currentSection === 'current_issue' ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                    Current Issue
                </a>

                <div class="relative group inline-block cursor-pointer">
                    <button
                        class="flex items-center gap-1 transition
                        {{ in_array($currentSection, ['committee', 'reviewer']) ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                        Committee
                        <svg class="w-3 h-3 stroke-current" fill="none" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </button>
                    <div
                        class="absolute left-0 hidden group-hover:block bg-white text-[#000120] rounded-md shadow-lg min-w-[180px] z-20">
                        <a href="{{ route('guest.home', ['section' => 'committee']) }}"
                            class="block px-4 py-3 transition
                            {{ $currentSection === 'committee' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                            Committee Members
                        </a>
                        <a href="{{ route('guest.home', ['section' => 'reviewer']) }}"
                            class="block px-4 py-3 transition
                            {{ $currentSection === 'reviewer' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                            For Reviewer
                        </a>
                    </div>
                </div>

                <div class="relative group inline-block cursor-pointer">
                    <button
                        class="flex items-center gap-1 transition
                        {{ in_array($currentSection, $journalSections) ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                        Journals & Conferences
                        <svg class="w-3 h-3 stroke-current" fill="none" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </button>
                    <div
                        class="absolute left-0 hidden group-hover:block bg-white text-[#000120] rounded-md shadow-lg min-w-[160px] z-20">
                        <a href="{{ route('guest.home', ['section' => 'journal']) }}"
                            class="block px-4 py-3 transition
                            {{ $currentSection === 'journal' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                            Journal
                        </a>
                        <a href="{{ route('guest.home', ['section' => 'conference']) }}"
                            class="block px-4 py-3 transition
                            {{ $currentSection === 'conference' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                            Conference
                        </a>
                    </div>
                </div>
                @if (Auth::check() && Auth::user()->roles->contains('name', 'author'))
                    <a href="{{ route('guest.home', ['section' => 'events']) }}"
                        class="relative transition cursor-pointer
                        {{ $currentSection === 'events' ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                        Events
                    </a>
                @endif

                @if (Auth::check() && Auth::user()->roles->contains('name', 'reviewer'))
                    @php $review_count = $journalsubmissionsCount + $conferencesubmissionsCount @endphp
                    <div class="relative group inline-block cursor-pointer">
                        <button
                            class="flex items-center gap-1 transition
                            {{ in_array($currentSection, ['journals', 'conferences']) ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                            Review
                            @if ($review_count > 0)
                                <span
                                    class="bg-[#d6dd42] text-[#000120] text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ $review_count }}
                                </span>
                            @else
                                <svg class="w-3 h-3 stroke-current" fill="none" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            @endif
                        </button>
                        <div
                            class="absolute left-0 hidden group-hover:block bg-white text-[#000120] rounded-md shadow-lg min-w-[160px] z-20">
                            <a href="{{ route('guest.home', ['section' => 'journals']) }}"
                                class="block px-4 py-3 transition flex flex-row gap-2 items-center
                                {{ $currentSection === 'journals' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                                <div>Journal</div>
                                @if ($journalsubmissionsCount > 0)
                                    <div class="bg-[#d6dd42] text-[#000120] text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                        {{ $journalsubmissionsCount }}
                                    </div>
                                @endif
                            </a>
                            <a href="{{ route('guest.home', ['section' => 'conferences']) }}"
                                class="block px-4 py-3 transition flex flex-row gap-2 items-center
                                {{ $currentSection === 'conferences' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                                <div>Conference</div>
                                @if ($conferencesubmissionsCount > 0)
                                    <div class="bg-[#d6dd42] text-[#000120] text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                        {{ $conferencesubmissionsCount }}
                                    </div>
                                @endif
                            </a>
                        </div>
                    </div>
                @endif

                <a href="{{ route('guest.home', ['section' => 'about']) }}"
                    class="relative transition cursor-pointer
                    {{ $currentSection === 'about' ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                    About
                </a>

                <a href="{{ route('guest.home', ['section' => 'contact']) }}"
                    class="relative transition cursor-pointer
                    {{ $currentSection === 'contact' ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                    Contact
                </a>

                @auth
                    @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                    @if (Auth::user()->roles->contains('name', 'author'))
                        <a href="{{ route('guest.home', ['section' => 'notification']) }}"
                            class="relative py-2 transition cursor-pointer
                            {{ $currentSection === 'notification' ? 'text-[#027c7d] font-bold' : 'hover:text-[#027c7d] hover:underline' }}">
                            Notifications
                            @if ($unreadCount > 0)
                                <span
                                    class="absolute -top-2 -right-3 bg-[#d6dd42] text-[#000120] text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                    @endif
                @endauth
            </nav>

            <!-- Auth Buttons / Profile -->
            <div class="flex items-center gap-2">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/img/profile.jpg') }}"
                                class="w-9 h-9 rounded-full border-2 border-[#d6dd42] object-cover" alt="Avatar">
                            <div class="text-left text-sm">
                                <span class="block font-bold">{{ Auth::user()->name }}</span>
                                <span class="block text-[#027c7d] text-xs">
                                    {{ optional(Auth::user()->roles->first())->name ?? 'No Role' }}
                                </span>
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white text-[#000120] rounded-md shadow-lg py-2" x-transition>
                            <a href="{{ route('guest.home', ['section' => 'profile']) }}" class="block px-4 py-2 hover:bg-[#d6dd42] hover:text-[#000120]">View Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 hover:bg-[#d6dd42] hover:text-[#000120]">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('guest.home', ['section' => 'register', 'role' => 'author']) }}"
                        class="text-white font-semibold uppercase text-xs bg-[#027c7d] rounded-md hover:bg-[#027c7d]/90 border-2 border-[#d6dd42] transition px-3 py-2">
                        Register
                    </a>
                    <a href="{{ route('guest.home', ['section' => 'login']) }}"
                        class="text-white font-semibold uppercase text-xs bg-[#027c7d] rounded-md hover:bg-[#027c7d]/90 border-2 border-[#d6dd42] transition px-3 py-2">
                        Login
                    </a>
                @endguest

                <!-- Mobile Menu Toggle -->
                <button @click="mobileOpen = !mobileOpen" class="md:hidden hover:text-[#027c7d]">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden bg-white text-[#000120]" x-show="mobileOpen" x-transition>
        <div class="px-4 py-4 space-y-3 text-sm font-semibold">

            <a href="{{ route('guest.home', ['section' => 'home']) }}"
                class="block px-4 py-3 rounded transition cursor-pointer
                {{ $currentSection === 'home' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                Home
            </a>

            @if (Auth::check() && Auth::user()->roles->contains('name', 'author'))
                <a href="{{ route('guest.home', ['section' => 'events']) }}"
                    class="block px-4 py-3 rounded transition cursor-pointer
                    {{ $currentSection === 'events' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                    Events
                </a>
            @endif

            <a href="{{ route('guest.home', ['section' => 'journal']) }}"
                class="block px-4 py-3 rounded transition cursor-pointer
                {{ $currentSection === 'journal' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                Journal
            </a>

            <a href="{{ route('guest.home', ['section' => 'conference']) }}"
                class="block px-4 py-3 rounded transition cursor-pointer
                {{ $currentSection === 'conference' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                Conference
            </a>

            @if (Auth::check() && Auth::user()->roles->contains('name', 'reviewer'))
                <a href="{{ route('guest.home', ['section' => 'journals']) }}"
                    class="block px-4 py-3 rounded transition cursor-pointer
                    {{ $currentSection === 'journals' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                    Review Journal
                </a>
                <a href="{{ route('guest.home', ['section' => 'conferences']) }}"
                    class="block px-4 py-3 rounded transition cursor-pointer
                    {{ $currentSection === 'conferences' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                    Review Conference
                </a>
            @endif

            <a href="{{ route('guest.home', ['section' => 'about']) }}"
                class="block px-4 py-3 rounded transition cursor-pointer
                {{ $currentSection === 'about' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                About
            </a>

            <a href="{{ route('guest.home', ['section' => 'contact']) }}"
                class="block px-4 py-3 rounded transition cursor-pointer
                {{ $currentSection === 'contact' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                Contact
            </a>

            @auth
                @if (Auth::user()->roles->contains('name', 'author'))
                    <a href="{{ route('guest.home', ['section' => 'notification']) }}"
                        class="block px-4 py-3 rounded transition cursor-pointer
                        {{ $currentSection === 'notification' ? 'bg-[#027c7d] text-white' : 'hover:bg-[#027c7d] hover:text-white' }}">
                        Notifications
                        @if ($unreadCount > 0)
                            <span
                                class="absolute -top-2 -right-3 bg-[#d6dd42] text-[#000120] text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                @endif
            @endauth

            @guest
                <a href="{{ route('guest.home', ['section' => 'register','role' => 'author']) }}"
                    class="text-[#027c7d] font-semibold text-sm hover:underline hover:text-[#d6dd42] transition px-2 py-1">
                    Register
                </a>
                <span class="text-gray-400 select-none">|</span>
                <a href="{{ route('guest.home', ['section' => 'login']) }}"
                    class="text-[#027c7d] font-semibold text-sm hover:underline hover:text-[#d6dd42] transition px-2 py-1">
                    Login
                </a>
            @endguest
        </div>
    </div>
</header>
