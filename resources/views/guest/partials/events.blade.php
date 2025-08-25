<div x-data="{ tab: 'journals', showModal: false, selectedEventId: null }" class="container mx-auto px-4 font-[Arial,sans-serif]">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">All Events</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded relative mx-auto shadow mb-2 w-2/3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Toggle Buttons -->
    <div class="flex justify-center gap-4 mb-6">
        {{-- <button @click="tab = 'conferences'"
            :class="tab === 'conferences' ? 'bg-[#027c7d] text-white' : 'bg-gray-200 text-gray-800'"
            class="px-5 py-2 rounded-md font-semibold shadow transition">
            Conferences
        </button> --}}

        <button @click="tab = 'journals'"
            :class="tab === 'journals' ? 'bg-[#027c7d] text-white' : 'bg-gray-200 text-gray-800'"
            class="px-5 py-2 rounded-md font-semibold shadow transition">
            Journals
        </button>
    </div>

    <!-- Conferences Section -->
    <div x-data="{ showModal: false, selectedEventId: null }" x-show="tab === 'conferences'" x-cloak class="min-h-[40vh]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($conferences as $conference)
                <div class="cursor-pointer bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-blue-700 mb-2">{{ $conference->title }}</h2>
                    <p class="text-gray-600 mb-2">{{ $conference->description }}</p>
                    <div class="text-sm text-gray-700 space-y-1">
                        <p><strong>Submission Deadline:</strong> {{ $conference->submission_deadline }}</p>
                        <p><strong>Acceptance Date:</strong> {{ $conference->acceptance_date }}</p>
                        <p><strong>Camera Ready Deadline:</strong> {{ $conference->camera_ready_deadline }}</p>

                        @if (!Auth::user())
                            {{-- Justify button to the right --}}
                            <div x-data="{ showModalAD: false }" class="pt-2 text-center pl-3">
                                <!-- Trigger Button -->
                                <a @click="showModalAD = true" class="inline-block bg-yellow-200 hover:bg-yellow-300 text-sm font-semibold px-3 py-2 rounded transition">
                                    See More
                                </a>

                                <!-- Modal -->
                                <div x-show="showModalAD" x-transition style="background-color: rgba(0,0,0,0.5);" class="fixed inset-0 flex items-center justify-center z-50" @click.self="showModalAD = false">
                                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded-xl shadow-lg p-6 w-full max-w-lg max-h-[90vh] overflow-auto relative">
                                        <!-- Modal Content -->
                                        <div>
                                            <button @click="showModalAD = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold" aria-label="Close modal">&times;</button>
                                            <h3 class="text-lg font-bold mb-1">Paper Submitted</h3>
                                            <p class="text-sm">
                                                You've already submitted a paper for this event.
                                            </p>
                                            <div class="mt-4 text-right">
                                                <a href="{{ route('guest.home', ['section' => 'register', 'role' => 'reviewer']) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded font-semibold transition">
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
                                    <a href="{{ asset('files/paper_format_conference.docx') }}" download class="px-4 py-2 bg-[#027c7d] text-white rounded hover:bg-green-700 transition">
                                        Download Paper Format
                                    </a>
                                    <a @click="selectedEventId = {{ $conference->id }}; showModal = true" class="bg-yellow-200 hover:bg-yellow-300 text-gray-800 text-sm font-semibold px-4 py-2 rounded transition cursor-pointer">
                                        See Paper Request Form
                                    </a>
                                </div>
                            @endif
                        @elseif(Auth::user()->roles->contains('name', 'reviewer'))
                            <div class="pt-2 text-center pl-3">
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center text-[#000120]">
                    <p class="text-lg font-medium">No conferences available.</p>
                </div>
            @endforelse
        </div>

        <!-- Modal backdrop -->
        <div x-show="showModal" x-transition style="background-color: rgba(0,0,0,0.5);" class="fixed inset-0 flex items-center justify-center z-50" @click.self="showModal = false">
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-lg max-h-[90vh] overflow-auto relative">
                <button @click="showModal = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold" aria-label="Close modal">&times;</button>
                <div x-data="{ isAuthenticated: @json(auth()->check()) }">
                    <!-- Create Conference Form -->
                    <form method="POST" action="{{ route('conference.submit') }}" class="space-y-4" enctype="multipart/form-data" class="space-y-4">
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
                            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" placeholder="Enter Author Name" required maxlength="255">
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
                            <textarea name="abstract" id="abstract" rows="4" class="w-full border rounded px-3 py-2" placeholder="Enter abstract" required></textarea>
                        </div>

                        <div>
                            <label for="keywords" class="block font-medium text-gray-700">Keywords</label>
                            <input type="text" name="keywords" id="keywords" class="w-full border rounded px-3 py-2" placeholder="Enter Keyword" required maxlength="255">
                        </div><br><br>

                        <div>
                            <label for="paper" class="block font-medium text-gray-700">Paper (PDF, DOC, DOCX)</label>
                            <input type="file" name="paper" id="paper" accept=".pdf,.doc,.docx" class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label for="department_rule_file" class="block font-medium text-gray-700">Department Aggrement (PDF, DOC, DOCX)</label>
                            <input type="file" name="department_rule_file" id="department_rule_file" accept=".pdf,.doc,.docx" class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label for="professor_rule_file" class="block font-medium text-gray-700">University Rule (PDF, DOC, DOCX)</label>
                            <input type="file" name="professor_rule_file" id="professor_rule_file" accept=".pdf,.doc,.docx" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="text-right">
                            <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700 transition">
                                Create Conference
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Journals Section -->
    <div x-data="{ showModal: false, selectedEventId: null }" x-show="tab === 'journals'" x-cloak class="min-h-[40vh]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($journals as $journal)
                <div @click="showModalAD = true" class="cursor-pointer bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-[#027c7d] mb-2">{{ $journal->title }}</h2>
                    <p class="text-gray-600 mb-2">{{ $journal->description }}</p>
                    <div class="text-sm text-gray-700 space-y-1">
                        <p><strong>Submission Deadline:</strong> {{ $journal->submission_deadline }}</p>
                        <p><strong>Acceptance Date:</strong> {{ $journal->acceptance_date }}</p>
                        <p><strong>Camera Ready Deadline:</strong> {{ $journal->camera_ready_deadline }}</p>
                        @if ($journal->journal_submissions()->where('user_id', auth()->user()->id)->first())
                            {{-- Justify button to the right --}}
                            <div x-data="{ showModalAD: false }" class="pt-2 text-center pl-3">
                                <!-- Trigger Button -->
                                <a @click="showModalAD = true" class="inline-block bg-yellow-200 hover:bg-yellow-300 text-sm font-semibold px-3 py-2 rounded transition">
                                    See More
                                </a>

                                <!-- Modal -->
                                <div
                                    x-show="showModalAD"
                                    x-transition.opacity
                                    class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
                                    @click.self="showModalAD = false"
                                >
                                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative">
                                        <!-- Close Button -->
                                        <button
                                            @click="showModalAD = false"
                                            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition text-2xl font-bold"
                                            aria-label="Close modal"
                                        >
                                            &times;
                                        </button>

                                        <!-- Icon & Title -->
                                        <div class="flex items-center mb-4">
                                            <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-2xl">
                                                ⚠️
                                            </div>
                                            <h3 class="ml-4 text-xl font-semibold text-gray-800">Paper Submitted</h3>
                                        </div>

                                        <!-- Message -->
                                        <p class="text-gray-600 mb-3">
                                            You've already submitted a paper for this event.
                                        </p>
                                        @php
                                            $journal_submission = $journal->journal_submissions()->where('user_id', auth()->user()->id)->first();
                                        @endphp
                                        <!-- Status -->
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 text-center">
                                            <p class="text-gray-700 font-semibold">Progress</p>
                                            @if ($journal_submission->review)
                                                <p class="mt-1 text-lg font-bold
                                                    @if ($journal_submission->review?->evaluation == 'acceptable' || $journal_submission->review?->evaluation == 'published') text-green-600
                                                    @elseif ($journal_submission->review?->evaluation == 'reject') text-red-600
                                                    @elseif ($journal_submission->review?->evaluation == 'minor_revisions' || $journal_submission->review?->evaluation == 'major_revisions' || $journal_submission->review?->evaluation == 'publish_draft') text-orange-500
                                                    @endif">
                                                    @if ($journal_submission->review?->evaluation == 'acceptable')
                                                        Accepted
                                                    @elseif ($journal_submission->review?->evaluation == 'reject')
                                                        Rejected
                                                    @elseif ($journal_submission->review?->evaluation == 'publish_draft')
                                                        Pending
                                                    @elseif ($journal_submission->review?->evaluation == 'published')
                                                        Published
                                                    @elseif ($journal_submission->review?->evaluation == 'minor_revisions' || $journal_submission->review?->evaluation == 'major_revisions')
                                                        Sent Back
                                                    @endif
                                                </p>
                                            @else
                                                <p class="mt-1 text-lg font-bold text-yellow-600"> Reviewing </p>
                                            @endif
                                        </div>

                                        <!-- Action Button -->
                                        <div class="mt-6 text-right flex flex-row gap-2 items-center">
                                            @if ($journal_submission->review?->evaluation == 'acceptable' && $journal_submission->review?->evaluation != 'publish_draft' && $journal_submission->review?->evaluation != 'published' && $journal_submission->review?->status == 'sent')
                                                <a href="{{ route('guest.home', ['section' => 'publish', 'journal_review_id' => $journal_submission->review->id]) }}"
                                                    class="bg-[#027c7d] hover:bg-[#027c7d]/90 text-white font-medium px-4 py-2 rounded-lg shadow transition"
                                                >
                                                    Publish
                                                </a>
                                            @endif
                                            <button
                                                @click="showModalAD = false"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded-lg shadow transition"
                                            >
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->roles->contains('name', 'author'))
                            @if (optional($journal)->submission_deadline && optional($journal)->submission_deadline >= now())
                                <div class="pt-2 pl-3 flex items-center justify-center space-x-4">
                                    <a href="{{ asset('files/paper_format_conference.docx') }}" download class="px-4 py-2 bg-[#027c7d] text-white rounded hover:bg-green-700 transition">
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
                <div class="text-center text-[#000120]">
                    <p class="text-lg font-medium">No journals available.</p>
                </div>
            @endforelse
        </div>

        <!-- Modal backdrop -->
        <div x-show="showModal" x-transition style="background-color: rgba(0,0,0,0.5);" class="fixed inset-0 flex items-center justify-center z-50" @click.self="showModal = false">
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-lg max-h-[90vh] overflow-auto relative">
                <div class="flex flex-row items-center justify-between">
                    <h2 class="text-center text-lg font-bold text-[#000120] uppercase">Journal</h2>
                    <button @click="showModal = false" class="text-gray-600 hover:text-gray-900 text-2xl font-bold" aria-label="Close modal">&times;</button>
                </div>
                <div x-data="{ isAuthenticated: @json(auth()->check()) }">
                    <!-- Create Conference Form -->
                    <form method="POST" action="{{ route('journal.submit') }}" class="space-y-4" enctype="multipart/form-data"
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
                            <label for="name" class="block text-sm font-semibold text-[#027c7d]">Name</label>
                            <input type="text" name="name" id="name" class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1"  placeholder="Enter Author Name" required maxlength="255">
                        </div>

                        <div>
                            <label for="topics" class="block text-sm font-semibold text-[#027c7d]">Topic</label>
                            <div class="relative mt-1">
                                <select name="topic_id" id="field" class="appearance-none w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 bg-white focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm" required>
                                    <option value="" disabled selected>Select a topic</option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="abstract" class="block text-sm font-semibold text-[#027c7d]">Abstract</label>
                            <textarea name="abstract" id="abstract" rows="4" class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" placeholder="Enter abstract" required></textarea>
                        </div>

                        <div>
                            <label for="keywords" class="block text-sm font-semibold text-[#027c7d]">Keywords</label>
                            <input type="text" name="keywords" id="keywords" class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" placeholder="Enter Keyword" required maxlength="255">
                        </div>

                        <div>
                            <label for="paper" class="block text-sm font-semibold text-[#027c7d]">Paper (PDF, DOC, DOCX)</label>
                            <input type="file" name="paper" id="paper" accept=".pdf,.doc,.docx" class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" required>
                        </div>

                        <div>
                            <label for="department_rule_file" class="block text-sm font-semibold text-[#027c7d]">Department Aggrement (PDF, DOC, DOCX)</label>
                            <input type="file" name="department_rule_file" id="department_rule_file" accept=".pdf,.doc,.docx" class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" required>
                        </div>

                        <div>
                            <label for="professor_rule_file" class="block text-sm font-semibold text-[#027c7d]">University Rule (PDF, DOC, DOCX)</label>
                            <input type="file" name="professor_rule_file" id="professor_rule_file" accept=".pdf,.doc,.docx" class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1" required>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="py-2.5 px-4 rounded-md shadow-md text-white bg-[#027c7d] hover:bg-[#026a6b] transition duration-300 text-sm font-semibold">
                                Create Journal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
