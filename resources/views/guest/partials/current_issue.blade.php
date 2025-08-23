<div class="overflow-x-auto font-[Arial,sans-serif] w-2/3">
    <h2 class="mb-4 text-[#027c7d] font-bold text-lg">Current Issue</h2>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#027c7d] text-white">
                <tr>
                    <th class="py-2 px-3 text-left text-sm font-medium">#</th>
                    <th class="py-2 px-3 text-left text-sm font-medium">Event Title</th>
                    <th class="py-2 px-3 text-left text-sm font-medium">Author</th>
                    <th class="py-2 px-3 text-left text-sm font-medium">Paper</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-[#000120]">
                @if ($current_issue)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-3 font-mono text-[#027c7d] text-md">
                            001
                        </td>
                        <td class="py-2 px-3 text-sm">{{ $current_issue->journalSubmission->event->title }}</td>
                        <td class="py-2 px-3 text-sm">{{ $current_issue->journalSubmission->name }}</td>
                        <td class="py-2 px-3 text-sm">
                            <a href="{{ asset('storage/'.$current_issue->journalSubmission->paper_path) }}" class="text-blue-500 hover:text-blue-600" target="_blank">Download Paper</a>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="5" class="py-4 text-center text-[#000120]">No issue found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
