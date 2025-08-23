<div class="font-[Arial,sans-serif] w-2/3">
    <h2 class="mb-6 text-lg font-bold text-[#027c7d]">Past Issues</h2>

    @forelse ($past_issues as $event)
        <div class="mb-6 rounded-lg border border-gray-200 shadow p-4 bg-white">
            <h3 class="mb-4 text-md font-semibold text-[#000120]">Event: {{ $event->title }}</h3>

            @if($event->journal_submissions->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#027c7d] text-white">
                            <tr>
                                <th class="py-2 px-3 text-left text-sm font-medium">#</th>
                                <th class="py-2 px-3 text-left text-sm font-medium">Author</th>
                                <th class="py-2 px-3 text-left text-sm font-medium">Paper</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-[#000120]">
                            @foreach ($event->journal_submissions as $index => $journal)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-2 px-3 font-mono text-[#027c7d] text-md">
                                        {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="py-2 px-3 text-sm">{{ $journal->name }}</td>
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
    @empty
        <p class="text-center text-gray-500 text-sm">No Issues Yet...</p>
    @endforelse
</div>
