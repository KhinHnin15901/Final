<div class="flex items-center justify-center px-4 sm:px-6 lg:px-8 font-[Arial,sans-serif] my-6 max-w-md w-full">
    <div class="w-full bg-white rounded-xl p-8 space-y-6 border-t-4 border-[#027c7d] shadow-md shadow-[#d6dd42]">
        <!-- Title -->
        <div class="flex flex-col items-center gap-2 justify-center">
            <h2 class="text-center text-xl font-bold text-[#000120]">Login to Your Account</h2>
            <p class="text-center text-sm text-gray-600">Enter your credentials to continue</p>
        </div>

        <!-- Error message (optional) -->
        @if (session('error'))
            <div class="text-red-600 text-sm text-center bg-red-50 p-2 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
            @csrf
            @if ($errors->any())
                <div class="text-red-500 text-sm text-center">{{ $errors->first() }}</div>
            @endif

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-[#027c7d]">Email Address</label>
                <input id="email" name="email" type="email" required autofocus
                class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-[#027c7d]">Password</label>
                <input id="password" name="password" type="password" required
                class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" />
            </div>

            <!-- Login Button and Register Link -->
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('guest.home', ['section' => 'register']) }}" class="text-[#027c7d] hover:underline font-medium">Register</a>
                </p>

                <button type="submit" class="py-2.5 px-6 rounded-md shadow-md text-white bg-[#027c7d] hover:bg-[#026a6b] transition duration-300 text-sm font-semibold">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
