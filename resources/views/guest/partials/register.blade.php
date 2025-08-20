<div class="flex items-center justify-center px-4 sm:px-6 lg:px-8 font-[Arial,sans-serif] max-w-3xl w-full">
    <div class="max-w-4xl w-full bg-white rounded-xl p-8 space-y-6 border-t-4 border-[#027c7d] shadow-md shadow-[#d6dd42]">

        <!-- Title -->
        <div class="flex flex-col items-center gap-2 justify-center">
            <h2 class="text-center text-xl font-bold text-[#000120]">
                Create an {{ $reg_role == 'author' ? 'Author' : 'Reviewer' }} Account
            </h2>
            <p class="text-center text-sm text-gray-600">Fill out the form to get started</p>
        </div>

        <!-- Form -->
        <form class="grid grid-cols-1 md:grid-cols-2 gap-6" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Role -->
            <input id="role" name="role" type="hidden" value="{{ $reg_role == 'author' ? 3 : 2 }}" />

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-[#027c7d]">Full Name</label>
                <input id="name" name="name" type="text" required autofocus
                    value="{{ old('name') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('name') border-red-500 @enderror" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-[#027c7d]">Email Address</label>
                <input id="email" name="email" type="email" required
                    value="{{ old('email') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('email') border-red-500 @enderror" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if ($reg_role == 'author')
                <!-- Organization -->
                <div>
                    <label for="organization" class="block text-sm font-semibold text-[#027c7d]">Organization</label>
                    <input id="organization" name="organization" type="text" required
                        value="{{ old('organization', $user->organization ?? '') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('organization') border-red-500 @enderror" />
                    @error('organization')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-semibold text-[#027c7d]">Position</label>
                    <input id="position" name="position" type="text" required
                        value="{{ old('position', $user->position ?? '') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('position') border-red-500 @enderror" />
                    @error('position')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label for="department" class="block text-sm font-semibold text-[#027c7d]">Department</label>
                    <input id="department" name="department" type="text" required
                        value="{{ old('department', $user->department ?? '') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('department') border-red-500 @enderror" />
                    @error('department')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @elseif ($reg_role == 'reviewer')
                <!-- Prefix -->
                <div>
                    <label for="user_prefix_id" class="block text-sm font-semibold text-[#027c7d]">Prefix</label>
                    <div class="relative mt-1">
                        <select id="user_prefix_id" name="user_prefix_id" required
                            class="appearance-none w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 bg-white
                                   focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm @error('user_prefix_id') border-red-500 @enderror">
                            <option value="" disabled {{ old('user_prefix_id', $user->user_prefix_id ?? '') == '' ? 'selected' : '' }}>Select Prefix</option>
                            @foreach ($user_prefixes as $user_prefix)
                                <option value="{{ $user_prefix->id }}" {{ old('user_prefix_id', $user->user_prefix_id ?? '') == $user_prefix->id ? 'selected' : '' }}>
                                    {{ $user_prefix->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @error('user_prefix_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Qualification -->
                <div>
                    <label for="qualification" class="block text-sm font-semibold text-[#027c7d]">Qualification</label>
                    <input id="qualification" name="qualification" type="text" required
                        value="{{ old('qualification', $user->qualification ?? '') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('qualification') border-red-500 @enderror" />
                    @error('qualification')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Institute Name -->
                <div>
                    <label for="institute_name" class="block text-sm font-semibold text-[#027c7d]">Institute Name</label>
                    <input id="institute_name" name="institute_name" type="text" required
                        value="{{ old('institute_name', $user->institute_name ?? '') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('institute_name') border-red-500 @enderror" />
                    @error('institute_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-[#027c7d]">Phone</label>
                    <input id="phone" name="phone" type="text" required
                        value="{{ old('phone', $user->phone ?? '') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('phone') border-red-500 @enderror" />
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CV Form -->
                <div>
                    <label for="cv_form" class="block text-sm font-semibold text-[#027c7d]">CV Form (PDF, DOC, DOCX)</label>
                    <input id="cv_form" name="cv_form" type="file" accept=".pdf,.doc,.docx"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120]
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('cv_form') border-red-500 @enderror" />
                    @error('cv_form')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Latest Qualification -->
                <div>
                    <label for="latest_qualification" class="block text-sm font-semibold text-[#027c7d]">Latest Qualification (PDF, DOC, DOCX)</label>
                    <input id="latest_qualification" name="latest_qualification" type="file" accept=".pdf,.doc,.docx"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120]
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('latest_qualification') border-red-500 @enderror" />
                    @error('latest_qualification')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Topics -->
                <div class="col-span-2">
                    <label for="field" class="block text-sm font-semibold text-[#027c7d]">Topics</label>
                    <select id="field" name="field[]" multiple
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#027c7d] focus:border-[#027c7d] text-sm @error('field') border-red-500 @enderror">
                        @foreach ($topics as $topic)
                            <option value="{{ $topic->name }}" {{ (collect(old('field'))->contains($topic->name)) ? 'selected' : '' }}>
                                {{ $topic->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Command (Mac) to select multiple.</p>
                    @error('field')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-[#027c7d]">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('password') border-red-500 @enderror" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-[#027c7d]">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('password_confirmation') border-red-500 @enderror" />
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Footer -->
            <div class="flex flex-row items-center justify-between col-span-2">
                <p class="text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('guest.home', ['section' => 'login']) }}" class="text-[#027c7d] hover:underline font-medium">
                        Log in
                    </a>
                </p>

                <div class="w-full md:w-auto">
                    <button type="submit"
                        class="w-full py-2.5 px-4 rounded-md shadow-md text-white bg-[#027c7d] hover:bg-[#026a6b] transition duration-300 text-sm font-semibold">
                        Register
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
