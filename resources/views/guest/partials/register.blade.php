<div
    class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white shadow-xl rounded-xl p-8 space-y-6">
        <h2 class="text-center text-3xl font-bold text-gray-900">Register an Account</h2>

        <form class="space-y-5" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input id="name" name="name" type="text" required autofocus
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div x-data="{ showField: false }">
                <!-- Role Selection -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                    <select id="role" name="role" required
                        x-on:change="showField = $event.target.options[$event.target.selectedIndex].text.toLowerCase() === 'reviewer'"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Select a role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Field Input (Shown only if role is Reviewer) -->
                <div x-show="showField" x-transition>
                    <label for="field" class="block text-sm font-medium text-gray-700 mt-4">Field</label>
                    <select id="field" name="field[]" multiple
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($topics as $topic)
                            @php
                                $currentUser = Auth::user();
                                $selectedFields = old('field');
                                if (!$selectedFields && $currentUser && $currentUser->field) {
                                    $selectedFields = explode(',', $currentUser->field);
                                }
                            @endphp

                            <option value="{{ $topic->name }}"
                                {{ is_array($selectedFields) && in_array($topic->name, $selectedFields) ? 'selected' : '' }}>
                                {{ $topic->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Command (Mac) to select multiple.</p>
                </div>
            </div>




            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                    Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <!-- Position -->
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <input id="position" name="position" type="text"
                    value="{{ old('position', $user->position ?? '') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <!-- Department -->
            <div>
                <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                <input id="department" name="department" type="text"
                    value="{{ old('department', $user->department ?? '') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <!-- Organization -->
            <div>
                <label for="organization" class="block text-sm font-medium text-gray-700">Organization</label>
                <input id="organization" name="organization" type="text"
                    value="{{ old('organization', $user->organization ?? '') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-md text-white bg-blue-600 hover:bg-blue-700 transition duration-300">
                    Register
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('guest.home', ['section' => 'login']) }}"
                class="text-blue-500 hover:underline font-medium">Log in</a>
        </p>
    </div>
</div>
