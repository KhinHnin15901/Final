<div class="font-[Arial,sans-serif] w-2/3">
    <h2 class="mb-6 text-lg font-bold text-[#027c7d]">Published Papers' Events</h2>

    <div class="mb-6 rounded-lg border border-gray-200 shadow p-4 shadow-[#d6dd42] bg-white">
        @forelse ($past_issues as $event)
            <a href="{{ route('guest.home', ['section' => 'published_papers', 'journal_or_conference' => $journal_or_conference, 'event_id' => $event->id]) }}"
            class="block w-full p-4 rounded-lg border border-gray-200 shadow-sm bg-white hover:bg-[#f0fafa] transition duration-300 mb-2">
                <span class="text-md font-semibold text-[#000120] hover:underline">
                    {{ $event->title }}
                </span>
            </a>
        @empty
            <p class="text-center text-gray-500 text-sm">No Events Yet...</p>
        @endforelse
    </div>
</div>
