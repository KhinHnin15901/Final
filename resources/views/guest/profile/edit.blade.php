<section class="flex justify-center font-[Arial,sans-serif]">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8 border-t-4 border-[#027c7d]">
        <!-- Section Title -->
        <h4 class="text-center mb-8 font-bold text-gray-900 text-2xl">
            Edit Profile
        </h4>

        <form method="POST" action="{{ route('profile.update', $user->id) }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <!-- Success Message -->
            @if (session('success'))
                <div class="col-span-2 bg-green-100 text-green-800 px-4 py-3 rounded-md shadow">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="col-span-2 bg-red-100 text-red-800 px-4 py-3 rounded-md shadow">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-[#027c7d] mb-1">Name</label>
                <input type="text" name="name"
                    class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#027c7d] focus:ring focus:ring-[#027c7d]/30 text-sm p-3 @error('name') border-red-500 @enderror"
                    value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-[#027c7d] mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#027c7d] focus:ring focus:ring-[#027c7d]/30 text-sm p-3 @error('email') border-red-500 @enderror"
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Old Password -->
            <div>
                <label for="old_password" class="block text-sm font-semibold text-[#027c7d] mb-1">Current Password</label>
                <input type="password" name="old_password"
                    class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#027c7d] focus:ring focus:ring-[#027c7d]/30 text-sm p-3 @error('old_password') border-red-500 @enderror">
                @error('old_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-[#027c7d] mb-1">New Password</label>
                <input type="password" name="password"
                    class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#027c7d] focus:ring focus:ring-[#027c7d]/30 text-sm p-3 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-[#027c7d] mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#027c7d] focus:ring focus:ring-[#027c7d]/30 text-sm p-3">
            </div>

            <!-- Submit Button -->
            <div class="col-span-2 text-right">
                <button type="submit"
                    class="bg-[#027c7d] hover:bg-[#026a6b] text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 text-sm">
                    Update
                </button>
            </div>
        </form>
    </div>
</section>
