<div class="mt-8 w-full mx-auto">
    <div class="flex flex-col md:flex-row md:space-x-8 space-y-8 md:space-y-0 items-stretch">
        <!-- Available Paper Topics -->
        <div class="flex-1 bg-white rounded-lg border-l-8 border-[#d6dd42] shadow-md p-6 font-[Arial,sans-serif] flex flex-col" style="max-height: 480px;">
            <h2 class="text-lg font-semibold text-[#000120] mb-3 flex-shrink-0">Available Paper Topics</h2>
            <ul class="space-y-3 text-gray-900 overflow-y-auto flex-grow">
                @forelse($topics as $topic)
                    <li class="relative pl-5 cursor-pointer hover:text-[#027c7d] transition text-sm">
                        <span class="absolute left-0 top-1.5 w-2 h-2 bg-[#027c7d] rounded-full"></span>
                        {{ $topic->name }}
                    </li>
                @empty
                    <li class="text-gray-500 italic">No topics available at the moment.</li>
                @endforelse
            </ul>
        </div>

        <!-- Organizing Committee -->
        <section class="flex-1 bg-white rounded-lg border-l-8 border-[#027c7d] shadow-md p-6 font-[Arial,sans-serif] flex flex-col" style="max-height: 480px;">
            <h2 class="text-lg font-semibold text-[#000120] mb-3 flex-shrink-0">Organizing Committee</h2>

            <div class="overflow-y-auto flex-grow">
                @if ($generalChair)
                    <h3 class="text-md font-semibold text-[#027c7d] mb-1">General Chair</h3>
                    <p class="text-gray-800 text-sm mb-3">{{ $generalChair->title }} {{ $generalChair->name }}, {{ $generalChair->affiliation }}</p>
                @endif

                @if ($programChair)
                    <h3 class="text-md font-semibold text-[#027c7d] mb-1">Program Chair</h3>
                    <p class="text-gray-800 text-sm mb-3">{{ $programChair->title }} {{ $programChair->name }}, {{ $programChair->affiliation }}</p>
                @endif

                <h3 class="text-md font-semibold text-[#027c7d] mb-2">Organizing Committee Members</h3>
                <ul class="space-y-3 text-gray-900 overflow-y-auto flex-grow text-sm">
                    @foreach ($members as $member)
                        <li class="relative pl-5">
                            <span class="absolute left-0 top-1.5 w-2 h-2 bg-[#d6dd42] rounded-full"></span>

                            {{ $member->title }} {{ $member->name }}, {{ $member->affiliation }}
                            @if ($member->country && $member->country !== 'Myanmar')
                                , {{ $member->country }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</div>

{{-- Registration Fees --}}
<div class="mt-6 max-w-lg mx-auto bg-white rounded-lg shadow-md shadow-[#027c7d] p-6 font-[Arial,sans-serif]">
    <h2 class="text-lg font-semibold text-[#000120] mb-5 border-b border-[#d6dd42] pb-2">
        Registration Fees
    </h2>

    <div class="grid grid-cols-[auto_1fr] gap-x-7 gap-y-4 text-[#000120] text-sm leading-relaxed">
        @foreach ($infos['fee'] ?? [] as $item)
            <div class="font-semibold text-[#027c7d]">{{ $item->label }}:</div>
            <div>{{ $item->value }}</div>
        @endforeach

        @foreach ($infos['email'] ?? [] as $item)
            <div class="font-semibold text-[#027c7d]">{{ $item->label }}:</div>
            <div>
                <a href="mailto:{{ $item->value }}" class="text-blue-500 hover:text-blue-600 underline transition">
                {{ $item->value }}
                </a>
            </div>
        @endforeach
    </div>
</div>

