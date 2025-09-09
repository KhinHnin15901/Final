<div class="font-[Arial,sans-serif] w-2/3">
    <h2 class="mb-6 text-lg font-bold text-[#027c7d]">{{ $published_event->title }}</h2>
    <form method="GET" action="{{ route('guest.home') }}" class="flex flex-row items-center gap-2 w-full max-w-md mb-4">
        <input type="hidden" name="section" value="published_papers">
        <input type="hidden" name="event_id" value="{{ $published_event->id }}">
        <input type="hidden" name="journal_or_conference" value="{{$journal_or_conference}}">
        <input id="keyword_search" name="keyword_search" type="text" value="{{ request('keyword_search') }}"
            placeholder="Search issues with keyword..."
            class="flex-1 rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm" />
        <button type="submit"
                class="px-6 py-2 rounded-md shadow-md text-white bg-[#027c7d] hover:bg-[#026a6b] transition duration-300 text-sm font-semibold">
            Search
        </button>
        <a href="{{ route('guest.home', ['section' => 'past_issue', 'journal_or_conference' => $journal_or_conference]) }}"
                class="px-6 py-2 rounded-md shadow-md text-white bg-red-600 hover:bg-red-500 transition duration-300 text-sm font-semibold">
            Back
        </a>
    </form>

    <div class="mb-6 rounded-lg border border-gray-200 shadow p-4 shadow-[#d6dd42] bg-white">
        @if($published_event->journal_submissions->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#027c7d] text-white">
                        <tr>
                            <th class="py-2 px-3 text-left text-sm font-medium">#</th>
                            <th class="py-2 px-3 text-left text-sm font-medium text-nowrap">Author/Authors</th>
                            <th class="py-2 px-3 text-left text-sm font-medium">Keywords</th>
                            <th class="py-2 px-3 text-left text-sm font-medium">Paper</th>
                        </tr>
                    </thead>
                    @php
                        $journal_submissions = $published_event->journal_submissions()
                            ->whereHas('review', function($q) {
                                $q->where('evaluation', 'published');
                            })->when(request('keyword_search'), function ($q1){
                                $q1->where('keywords', 'LIKE', '%'.request('keyword_search').'%');
                            })
                            ->get();
                    @endphp
                    <tbody class="bg-white divide-y divide-gray-200 text-[#000120]">
                        @foreach ($journal_submissions as $index => $journal)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-2 px-3 font-mono text-[#027c7d] text-md">
                                    {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-2 px-3 text-sm">{{ $journal->name }}</td>
                                <td class="py-2 px-3 text-sm">{{ $journal->keywords }}</td>
                                <td class="py-2 px-3 text-sm">
                                    <a href="{{ asset('storage/' . $journal->paper_path) }}"
                                        class="text-blue-600 hover:text-blue-700 font-medium"
                                        target="_blank">
                                        Download Paper
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 py-2">No submissions for this issue.</p>
        @endif
    </div>
</div>
