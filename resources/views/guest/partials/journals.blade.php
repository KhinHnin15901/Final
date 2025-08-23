<div class="max-w-6xl mx-auto mt-10 space-y-6 font-[Arial,sans-serif]">
    <!-- Header -->
    <div class="bg-[#027c7d] rounded-lg text-white p-5 text-center w-[20vw] mx-auto shadow-lg">
        <h2 class="text-lg font-semibold">My Assigned List</h2>
    </div>

    @php
        $criteria = [
            'originality' => 'Originality',
            'significance' => 'Significance of the main idea(s)',
            'technical_quality' => 'Technical Quality (experimental/technical/comparative results)',
            'familiarity' => "Reviewer's familiarity with the material",
            'related_work' => 'Awareness of related work',
            'clarity' => 'Clarity of presentation',
            'organization' => 'Organization of the paper',
            'length' => 'Paper Length',
            'relevance' => 'Relevance of paper’s purpose, discussion and conclusion',
            'references' => 'Reference adequate and correctly cited',
        ];

        $scale = [
            '1' => 'Very Weak',
            '2' => 'Weak',
            '3' => 'Average',
            '4' => 'Strong',
            '5' => 'Very Strong',
        ];
    @endphp
    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded relative w-[60vw] mx-auto shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if (session('error'))
        <div class="bg-red-100 text-red-800 border border-red-300 px-4 py-3 rounded relative w-[60vw] mx-auto shadow">
            {{ session('error') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative w-[60vw] mx-auto shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @forelse($journalsubmissions as $submission)
        <div x-data="{ showForm: false }" class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200 transition hover:shadow-xl w-[60vw]">

            <!-- Card header / Left side -->
            <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full">
                <div class="flex flex-col items-start justify-center gap-1">
                    <h3 class="text-lg font-bold text-[#027c7d] mb-1">
                        {{ $submission->journalSubmission->topics->name ?? 'Untitled' }}
                    </h3>

                    <p class="text-gray-700 text-sm"><strong>Topic:</strong>
                        {{ $submission->journalSubmission->topics->name ?? 'N/A' }}</p>
                    <p class="text-gray-700 text-sm"><strong>Category:</strong>
                        {{ $submission->journalSubmission->category->name ?? 'N/A' }}</p>
                    <p class="text-gray-700 text-sm"><strong>Keywords:</strong>
                        {{ $submission->journalSubmission->keywords }}</p>
                    <p class="text-gray-500 text-sm"><strong>Abstract:</strong>
                        {{ \Illuminate\Support\Str::limit($submission->journalSubmission->abstract, 100) }}</p>

                    @if ($submission->journalSubmission->paper_path)
                        <p class="text-sm">
                            <strong>Paper:</strong>
                            <a href="{{ route('conference.download', $submission->id) }}"
                               class="text-blue-600 font-medium hover:underline hover:text-green-700" download>
                                Download
                            </a>
                        </p>
                    @endif

                    <p class="text-sm text-[#027c7d]">
                        Submitted on {{ $submission->created_at->format('M d, Y h:i A') }}
                    </p>
                    @if (collect([
                            $submission->journalSubmission->review?->reviewer1_id,
                            $submission->journalSubmission->review?->reviewer2_id,
                            $submission->journalSubmission->review?->reviewer3_id
                        ])->contains(auth()->id()) || $submission->journalSubmission->review?->evaluation == 'publish_draft' || $submission->journalSubmission->review?->evaluation == 'published')
                        <p class="text-red-500 text-sm">You already reviewed this paper...</p>
                    @else
                        <p class="text-sm text-blue-500 italic font-medium cursor-pointer" @click="showForm = !showForm">
                            <span x-text="showForm ? 'Click to hide form ▲' : 'Click to review ▼'"></span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Review form / Right side -->
            <div x-show="showForm" x-transition class="border-t px-6 py-4 bg-gray-50 w-full">
                <form method="POST" action="{{ route('journals.update', $submission->journalSubmission->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Criteria Table -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Please rate (✓) the paper on the following features:
                        </label>
                        <div class="overflow-x-auto border border-gray-300 rounded-lg">
                            <table class="w-full text-sm text-center">
                                <thead class="bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 border">Item</th>
                                        @foreach ($scale as $desc)
                                            <th class="px-3 py-2 border">{{ $desc }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($criteria as $key => $label)
                                        <tr class="border-t">
                                            <td class="px-3 py-2 border text-left font-medium">{{ $label }}</td>
                                            @foreach ($scale as $value => $desc)
                                                <td class="px-3 py-2 border">
                                                    <input type="radio"
                                                           name="ratings[{{ $key }}]"
                                                           value="{{ $value }}"
                                                           {{ old("ratings.$key") == $value ? 'checked' : '' }}
                                                           class="text-indigo-600 focus:ring-indigo-500">
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Overall Evaluation -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Overall Evaluation</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                            @foreach ([
                                'acceptable' => 'Acceptable',
                                'minor_revisions' => 'Acceptable with minor revisions',
                                'major_revisions' => 'Acceptable with major revisions',
                                'reject' => 'Definite Reject'
                            ] as $value => $label)
                                <label class="flex items-center border p-2 rounded">
                                    <input type="radio" name="evaluation" value="{{ $value }}"
                                           {{ old('evaluation', $submission->evaluation ?? '') === $value ? 'checked' : '' }}
                                           class="mr-2 text-indigo-600 focus:ring-indigo-500">
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Comments -->
                    <div>
                        <label for="reviewer_comments" class="block text-sm font-semibold text-gray-700 mb-2">
                            Reviewer’s Comments
                        </label>
                        <textarea id="reviewer_comments" name="reviewer_comments" rows="5" required
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                  placeholder="• Suggestion one...
• Suggestion two...
• (Optional) Suggestion three...">{{ old('reviewer_comments', $submission->reviewer_comments ?? '') }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="text-right">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 text-gray-600 text-center">
            You have no journals yet.
        </div>
    @endforelse
</div>
