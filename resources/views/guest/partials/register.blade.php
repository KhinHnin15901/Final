<div class="flex items-center justify-center px-4 sm:px-6 lg:px-8 font-[Arial,sans-serif] max-w-3xl w-full">
    <div class="max-w-4xl w-full bg-white rounded-xl p-8 space-y-6 border-t-4 border-[#027c7d] shadow-md shadow-[#d6dd42]">

        <!-- Title -->
        <div class="flex flex-col items-center gap-2 justify-center">
            <h2 class="text-center text-xl font-bold text-[#000120]">Create an Account</h2>
            <p class="text-center text-sm text-gray-600">Fill out the form to get started</p>
        </div>

        <!-- Form -->
        <form class="grid grid-cols-1 md:grid-cols-2 gap-6" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-[#027c7d]">Full Name</label>
                <input id="name" name="name" type="text" required autofocus
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-[#027c7d]">Email Address</label>
                <input id="email" name="email" type="email" required
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" />
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-semibold text-[#027c7d] font-[Arial,sans-serif]">Select Role</label>
                <select id="role" name="role" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:ring-[#027c7d] focus:border-[#027c7d] text-sm font-[Arial,sans-serif] appearance-none"
                    style="
                    background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23027c7d%22><path d=%22M6 8l4 4 4-4%22 stroke=%22%23027c7d%22 stroke-width=%222%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/></svg>');
                    background-repeat: no-repeat;
                    background-position: right 0.75rem center;
                    background-size: 1rem;
                    padding-right: 2.5rem;">
                    <option value="" disabled selected>Select a role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Organization -->
            <div>
                <label for="organization" class="block text-sm font-semibold text-[#027c7d]">Organization</label>
                <input id="organization" name="organization" type="text" required
                    value="{{ old('organization', $user->organization ?? '') }}"
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

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-[#027c7d]">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" />
            </div>

            <!-- Position -->
            <div>
                <label for="position" class="block text-sm font-semibold text-[#027c7d]">Position</label>
                <input id="position" name="position" type="text" required
                    value="{{ old('position', $user->position ?? '') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" />
            </div>

            <!-- Department -->
            <div>
                <label for="department" class="block text-sm font-semibold text-[#027c7d]">Department</label>
                <input id="department" name="department" type="text" required
                    value="{{ old('department', $user->department ?? '') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" />
            </div>

            <!-- Reviewer Field (conditional) -->
            <div class="md:col-span-2" x-data="{ showField: false }" x-show="showField" x-transition>
                <label for="field" class="block text-sm font-semibold text-[#027c7d]">Field</label>
                <select id="field" name="field[]" multiple
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#027c7d] focus:border-[#027c7d] text-sm">
                    @foreach ($topics as $topic)
                        <option value="{{ $topic->name }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Command (Mac) to select multiple.</p>
            </div>
        </form>
        <div class="flex flex-row items-center justify-between">
            <!-- Login Link -->
            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('guest.home', ['section' => 'login']) }}" class="text-[#027c7d] hover:underline font-medium">
                    Log in
                </a>
            </p>

            <div>
                <button type="submit"
                    class="w-full py-2.5 px-4 rounded-md shadow-md text-white bg-[#027c7d] hover:bg-[#026a6b] transition duration-300 text-sm font-semibold">
                    Register
                </button>
            </div>
        </div>
    </div>
</div>
