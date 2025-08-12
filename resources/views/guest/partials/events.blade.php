<div class="container mx-auto px-4 py-8" x-data="{ tab: 'conferences' }">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">All Events</h1>

    <!-- Toggle Buttons -->
    <div class="flex justify-center gap-4 mb-6">
        <button @click="tab = 'conferences'"
            :class="tab === 'conferences' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'"
            class="px-5 py-2 rounded-md font-semibold shadow">
            Conferences
        </button>

        <button @click="tab = 'journals'"
            :class="tab === 'journals' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800'"
            class="px-5 py-2 rounded-md font-semibold shadow">
            Journals
        </button>
    </div>

    <!-- Conferences Section -->
    <div x-data="{ showModal: false, selectedEventId: null }" x-show="tab === 'conferences'" x-transition x-cloak>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($conferences as $conference)
                <div
                    class="cursor-pointer bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-blue-700 mb-2">{{ $conference->title }}</h2>
                    <p class="text-gray-600 mb-2">{{ $conference->description }}</p>
                    <div class="text-sm text-gray-700 space-y-1">
                        <p><strong>Submission Deadline:</strong> {{ $conference->submission_deadline }}</p>
                        <p><strong>Acceptance Date:</strong> {{ $conference->acceptance_date }}</p>
                        <p><strong>Camera Ready Deadline:</strong> {{ $conference->camera_ready_deadline }}</p>
                        {{-- <p><strong>Submission Deadline:</strong> {{ $conference->submission_deadline }}</p>
                        <p><strong>Status:</strong>
                            <span
                                class="px-2 py-1 text-xs rounded-full text-white {{ $conference->status === 'open' ? 'bg-green-500' : 'bg-gray-400' }}">
                                {{ ucfirst($conference->status) }}
                            </span>
                        </p> --}}
                        @if (!Auth::user())
                            {{-- Justify button to the right --}}
                            <div x-data="{ showModalAD: false }" class="pt-2 text-center pl-3">
                                <!-- Trigger Button -->
                                <a @click="showModalAD = true"
                                    class="inline-block bg-yellow-200 hover:bg-yellow-300 text-sm font-semibold px-3 py-2 rounded transition">
                                    See More
                                </a>

                                <!-- Modal -->
                                <div x-show="showModalAD" x-transition style="background-color: rgba(0,0,0,0.5);"
                                    class="fixed inset-0 flex items-center justify-center z-50"
                                    @click.self="showModalAD = false">

                                    <div
                                        class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded-xl shadow-lg p-6 w-full max-w-lg max-h-[90vh] overflow-auto relative">


                                        <!-- Modal Content -->
                                        <div>
                                            <button @click="showModalAD = false"
                                                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold"
                                                aria-label="Close modal">&times;</button>
                                            <h3 class="text-lg font-bold mb-1">Reviewer Needed</h3>
                                            <p class="text-sm">
                                                You’ve already submitted a paper for this event. Reviewers are currently
                                                needed. Please consider
                                                registering as a reviewer to contribute to the review process.
                                            </p>
                                            <div class="mt-4 text-right">
                                                <a href="{{ route('guest.home', ['section' => 'register']) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded font-semibold transition">
                                                    Register as Reviewer
                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->roles->contains('name', 'author'))
                            @if (optional($conference)->submission_deadline && optional($conference)->submission_deadline >= now())
                                <div class="pt-2 pl-3 flex items-center justify-center space-x-4">
                                    <a href="{{ asset('files/paper_format_conference.docx') }}" download
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                        Download Paper Format
                                    </a>
                                    <a @click="selectedEventId = {{ $conference->id }}; showModal = true"
                                        class="bg-yellow-200 hover:bg-yellow-300 text-gray-800 text-sm font-semibold px-4 py-2 rounded transition cursor-pointer">
                                        See Paper Request Form
                                    </a>
                                </div>
                            @else
                            @endif
                        @elseif(Auth::user()->roles->contains('name', 'reviewer'))
                            <div class="pt-2 text-center pl-3">


                                {{-- <a href="{{ route('guest.home', ['section' => 'conferences']) }}"
                                    class="inline-block bg-yellow-200 hover:bg-yellow-300  text-sm font-semibold px-3 py-2 rounded transition">
                                    See Paper Assigned
                                </a> --}}
                            </div>
                        @endif
                    </div>

                </div>
            @empty
                <div class="text-center text-gray-500 py-12">
                    <p class="text-lg font-medium">No conferences available.</p>
                </div>
            @endforelse
        </div>

        <!-- Modal backdrop -->
        <div x-show="showModal" x-transition style="background-color: rgba(0,0,0,0.5);"
            class="fixed inset-0 flex items-center justify-center z-50" @click.self="showModal = false">
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-lg max-h-[90vh] overflow-auto relative">
                <button @click="showModal = false"
                    class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold"
                    aria-label="Close modal">&times;</button>
                <div x-data="{ isAuthenticated: @json(auth()->check()) }">
                    <!-- Create Conference Form -->
                    <form method="POST" action="{{ route('conference.submit') }}" class="space-y-4"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-500">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="event_id" :value="selectedEventId">
                        <div>
                            <label for="name" class="block font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2"
                                placeholder="Enter Author Name" required maxlength="255">
                        </div>

                        <div>
                            <label for="topics" class="block font-medium text-gray-700">Topic</label>
                            <select name="topic_id" id="field" class="w-full border rounded px-3 py-1">
                                <option value="" disabled selected>Select a topic</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach
                            </select>
                        </div><br><br>
                        <div>
                            <label for="abstract" class="block font-medium text-gray-700">Abstract</label>
                            <textarea name="abstract" id="abstract" rows="4" class="w-full border rounded px-3 py-2"
                                placeholder="Enter abstract" required></textarea>
                        </div>

                        <div>
                            <label for="keywords" class="block font-medium text-gray-700">Keywords</label>
                            <input type="text" name="keywords" id="keywords" class="w-full border rounded px-3 py-2"
                                placeholder="Enter Keyword" required maxlength="255">
                        </div><br><br>

                        <div>
                            <label for="paper" class="block font-medium text-gray-700">Paper (PDF, DOC, DOCX)</label>
                            <input type="file" name="paper" id="paper" accept=".pdf,.doc,.docx"
                                class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label for="department_rule_file" class="block font-medium text-gray-700">Department
                                Aggrement
                                (PDF,
                                DOC, DOCX)</label>
                            <input type="file" name="department_rule_file" id="department_rule_file"
                                accept=".pdf,.doc,.docx" class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label for="professor_rule_file" class="block font-medium text-gray-700">University Rule
                                (PDF,
                                DOC, DOCX)</label>
                            <input type="file" name="professor_rule_file" id="professor_rule_file"
                                accept=".pdf,.doc,.docx" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700 transition">
                                Create Conference
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Journals Section -->
    <div x-data="{ showModal: false, selectedEventId: null }" x-show="tab === 'journals'" x-transition x-cloak>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($journals as $journal)
                <div @click="showModalAD = true"
                    class="cursor-pointer bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">{{ $journal->title }}</h2>
                    <p class="text-gray-600 mb-2">{{ $journal->description }}</p>
                    <div class="text-sm text-gray-700 space-y-1">
                        <p><strong>Submission Deadline:</strong> {{ $journal->submission_deadline }}</p>
                        <p><strong>Acceptance Date:</strong> {{ $journal->acceptance_date }}</p>
                        <p><strong>Camera Ready Deadline:</strong> {{ $journal->camera_ready_deadline }}</p>
                        {{-- <p><strong>Submission:</strong> {{ $journal->submission_deadline }}</p>
                        <p><strong>Acceptance:</strong> {{ $journal->acceptance_date }}</p>
                        <p><strong>Deadline:</strong> {{ $journal->camera_ready_deadline }}</p>
                        <p><strong>Organizer:</strong> {{ $journal->organizer }}</p>
                        <p><strong>Status:</strong>
                            <span
                                class="px-2 py-1 text-xs rounded-full text-white {{ $journal->status === 'open' ? 'bg-green-500' : 'bg-gray-400' }}">
                                {{ ucfirst($journal->status) }}
                            </span>
                        </p> --}}
                        @if (!Auth::user())
                            {{-- Justify button to the right --}}
                            <div x-data="{ showModalAD: false }" class="pt-2 text-center pl-3">
                                <!-- Trigger Button -->
                                <a @click="showModalAD = true"
                                    class="inline-block bg-yellow-200 hover:bg-yellow-300 text-sm font-semibold px-3 py-2 rounded transition">
                                    See More
                                </a>

                                <!-- Modal -->
                                <div x-show="showModalAD" x-transition style="background-color: rgba(0,0,0,0.5);"
                                    class="fixed inset-0 flex items-center justify-center z-50"
                                    @click.self="showModalAD = false">

                                    <div
                                        class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded-xl shadow-lg p-6 w-full max-w-lg max-h-[90vh] overflow-auto relative">


                                        <!-- Modal Content -->
                                        <div>
                                            <button @click="showModalAD = false"
                                                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold"
                                                aria-label="Close modal">&times;</button>
                                            <h3 class="text-lg font-bold mb-1">Reviewer Needed</h3>
                                            <p class="text-sm">
                                                You’ve already submitted a paper for this event. Reviewers are currently
                                                needed. Please consider
                                                registering as a reviewer to contribute to the review process.
                                            </p>
                                            <div class="mt-4 text-right">
                                                <a href="{{ route('guest.home', ['section' => 'register']) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded font-semibold transition">
                                                    Register as Reviewer
                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->roles->contains('name', 'author'))
                            @if (optional($journal)->submission_deadline && optional($journal)->submission_deadline >= now())
                                <div class="pt-2 pl-3 flex items-center justify-center space-x-4">
                                    <a href="{{ asset('files/paper_format_conference.docx') }}" download
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                        Download Paper Format
                                    </a>
                                    <a @click="selectedEventId = {{ $journal->id }}; showModal = true"
                                        class="bg-yellow-200 hover:bg-yellow-300 text-gray-800 text-sm font-semibold px-4 py-2 rounded transition cursor-pointer">
                                        See Paper Request Form
                                    </a>
                                </div>
                            @endif
                        @elseif(Auth::user()->roles->contains('name', 'reviewer'))
                            <div class="pt-2 text-center pl-3">
                                {{-- <a href="{{ route('guest.home', ['section' => 'journals']) }}"
                                    class="inline-block bg-yellow-200 hover:bg-yellow-300  text-sm font-semibold px-3 py-2 rounded transition">
                                    See Paper Assigned
                                </a> --}}
                            </div>
                        @endif
                    </div>

                </div>
            @empty
                <div class="text-center text-gray-500 py-12">
                    <p class="text-lg font-medium">No journals available.</p>
                </div>
            @endforelse
        </div>

        <!-- Modal backdrop -->
        <div x-show="showModal" x-transition style="background-color: rgba(0,0,0,0.5);"
            class="fixed inset-0 flex items-center justify-center z-50" @click.self="showModal = false">
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-lg max-h-[90vh] overflow-auto relative">
                <button @click="showModal = false"
                    class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold"
                    aria-label="Close modal">&times;</button>
                <div x-data="{ isAuthenticated: @json(auth()->check()) }">
                    <!-- Create Conference Form -->
                    <form method="POST" action="{{ route('journal.submit') }}" class="space-y-4"
                        enctype="multipart/form-data"
                        @submit.prevent="
            if (!isAuthenticated) {
              window.location.href = '/?section=login';
            } else {
              $el.submit();
            }
          "
                        class="space-y-4">
                        @csrf
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-500">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="event_id" :value="selectedEventId">




                        <div>
                            <label for="name" class="block font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name"
                                class="w-full border rounded px-3 py-2" placeholder="Enter Author Name" required
                                maxlength="255">
                        </div>

                        <div>
                            <label for="topics" class="block font-medium text-gray-700">Topic</label>
                            <select name="topic_id" id="field" class="w-full border rounded px-3 py-1" required>
                                <option value="" disabled selected>Select a topic</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach
                            </select>
                        </div><br><br>
                        <div>
                            <label for="abstract" class="block font-medium text-gray-700">Abstract</label>
                            <textarea name="abstract" id="abstract" rows="4" class="w-full border rounded px-3 py-2"
                                placeholder="Enter abstract" required></textarea>
                        </div>

                        <div>
                            <label for="keywords" class="block font-medium text-gray-700">Keywords</label>
                            <input type="text" name="keywords" id="keywords"
                                class="w-full border rounded px-3 py-2" placeholder="Enter Keyword" required
                                maxlength="255">
                        </div><br><br>

                        <div>
                            <label for="paper" class="block font-medium text-gray-700">Paper (PDF, DOC,
                                DOCX)</label>
                            <input type="file" name="paper" id="paper" accept=".pdf,.doc,.docx"
                                class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label for="department_rule_file" class="block font-medium text-gray-700">Department
                                Aggrement
                                (PDF,
                                DOC, DOCX)</label>
                            <input type="file" name="department_rule_file" id="department_rule_file"
                                accept=".pdf,.doc,.docx" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label for="professor_rule_file" class="block font-medium text-gray-700">University Rule
                                (PDF,
                                DOC, DOCX)</label>
                            <input type="file" name="professor_rule_file" id="professor_rule_file"
                                accept=".pdf,.doc,.docx" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700 transition">
                                Create Journal
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
