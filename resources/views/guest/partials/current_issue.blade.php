<div class="overflow-x-auto font-[Arial,sans-serif] w-2/3">
    <h3 class="mb-4 text-md font-semibold text-[#000120]">Event: {{ $current_issue->title }}</h3>
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#027c7d] text-white">
                <tr>
                    <th class="py-2 px-3 text-left text-sm font-medium">#</th>
                    <th class="py-2 px-3 text-left text-sm font-medium">Author/Authors</th>
                    <th class="py-2 px-3 text-left text-sm font-medium">Paper</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-[#000120]">
                @if ($current_issue->journal_submissions)
                    @foreach ($current_issue->journal_submissions as $index => $issue)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-3 font-mono text-[#027c7d] text-md">
                                {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-2 px-3 text-sm">{{ $issue->name }}</td>
                            <td class="py-2 px-3 text-sm">
                                <a href="{{ asset('storage/'.$issue->paper_path) }}" class="text-blue-500 hover:text-blue-600" target="_blank">Download Paper</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="py-4 text-center text-[#000120]">No issue found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
