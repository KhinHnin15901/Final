<div class="w-full px-4 font-[Arial,sans-serif]">
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
