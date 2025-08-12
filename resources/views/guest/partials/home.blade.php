{{-- List of Topics --}}
<div class="mt-10 bg-white rounded-xl shadow p-6 border border-gray-200">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">Available Paper Topics</h2>
    <ul class="list-disc list-inside text-gray-800 space-y-1">
        @forelse($topics as $topic)
            <li>{{ $topic->name }}</li>
        @empty
            <li class="text-gray-500">No topics available at the moment.</li>
        @endforelse
    </ul>
</div>

<section class="bg-white shadow rounded-lg p-6 my-6">
    <h2 class="text-2xl font-bold mb-4">Organizing Committee</h2>

    <!-- General Chair section -->
    @if ($generalChair)
        <h3 class="text-xl font-semibold text-gray-700 mb-2">General Chair</h3>
        <p class="text-gray-800 mb-4">{{ $generalChair->title }} {{ $generalChair->name }},
            {{ $generalChair->affiliation }}</p>
    @endif

    <!-- Program Chair section -->
    @if ($programChair)
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Program Chair</h3>
        <p class="text-gray-800 mb-6">{{ $programChair->title }} {{ $programChair->name }},
            {{ $programChair->affiliation }}</p>
    @endif

    <!-- Other Organizing Committee Members as list -->
    <h3 class="text-xl font-semibold text-gray-700 mb-3">Organizing Committee Members</h3>
    <ul class="list-disc list-inside space-y-1 text-gray-800">
        @foreach ($members as $member)
            <li>
                {{ $member->title }} {{ $member->name }}, {{ $member->affiliation }}
                @if ($member->country && $member->country !== 'Myanmar')
                    , {{ $member->country }}
                @endif
            </li>
        @endforeach
    </ul>
</section>

{{-- Registration Fees --}}
<div class="mt-6 bg-white rounded-xl shadow p-6 border border-gray-200">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">Registration Fees</h2>
    <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
        @foreach ($infos['fee'] ?? [] as $item)
            <div><strong>{{ $item->label }}:</strong></div>
            <div>{{ $item->value }}</div>
        @endforeach

        @foreach ($infos['email'] ?? [] as $item)
            <div><strong>{{ $item->label }}:</strong></div>
            <div>
                <a href="mailto:{{ $item->value }}" class="text-blue-600 underline">
                    {{ $item->value }}
                </a>
            </div>
        @endforeach
    </div>
</div>
