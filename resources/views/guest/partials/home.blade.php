<div class="w-full px-4 font-[Arial,sans-serif]">
    <div class="max-w-3xl mx-auto bg-white shadow-md border border-[#d6dd42] rounded-lg overflow-hidden">
        <!-- Header Section -->
        <div class="flex items-center justify-between px-8 py-6 bg-white">
            <img src="{{ asset('assets/img/logo/logo.jpg') }}" alt="Logo" class="w-20 h-auto object-contain">
            <div class="text-right">
                <h1 class="text-2xl font-bold text-[#027c7d]">{{ $event->title ?? 'Title' }}</h1>
                <p class="text-sm mt-1">{{ $event->organizer ?? 'Organizer' }}</p>
            </div>
        </div>

        <!-- Event Details Section -->
        <div class="px-8 py-6 bg-[#027c7d]">
            <div>
                <h2 class="text-lg font-semibold text-[#d6dd42] mb-3">Event Details</h2>
                <ul class="space-y-2 text-white text-sm">
                    <li class="capitalize"><span class="font-semibold">Category:</span> {{ $event->category->name ?? 'Sample' }}</li>
                    <li><span class="font-semibold">Start Date:</span> {{ $event->start_date ?? 'Sample' }}</li>
                    <li><span class="font-semibold">End Date:</span> {{ $event->end_date ?? 'Sample' }}</li>
                    <li><span class="font-semibold">Location:</span> {{ $event->location ?? 'Yangon' }}</li>
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-[#027c7d] mb-4">Important Dates</h2>
            <div class="grid grid-cols-3 gap-6">
                <div class="bg-[#027c7d] shadow shadow-[#d6dd42] rounded-lg p-4 text-center">
                    <p class="text-sm text-[#d6dd42] font-semibold">Submission Deadline</p>
                    <p class="text-md font-semibold text-white">
                        {{ $event->submission_deadline ?? 'None' }}
                    </p>
                </div>
                <div class="bg-[#027c7d] shadow shadow-[#d6dd42] rounded-lg p-4 text-center">
                    <p class="text-sm text-[#d6dd42] font-semibold">Acceptance Date</p>
                    <p class="text-md font-semibold text-white">
                        {{ $event->acceptance_date ?? 'None' }}
                    </p>
                </div>
                <div class="bg-[#027c7d] shadow shadow-[#d6dd42] rounded-lg p-4 text-center">
                    <p class="text-sm text-[#d6dd42] font-semibold">Camera Ready</p>
                    <p class="text-md font-semibold text-white">
                        {{ $event->camera_ready_deadline ?? 'None' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- About -->
        <div class="px-8 py-6 bg-[#027c7d]">
            <h2 class="text-lg font-semibold text-[#d6dd42] mb-3">About the Event</h2>
            <p class="text-white text-sm leading-relaxed">
                {{ $event->description ?? "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni consequuntur quisquam repudiandae veritatis, et fugit quis, inventore minus a porro incidunt alias saepe. Magnam, ut nam id aliquam quas unde." }}
            </p>
        </div>

        <!-- Topic Areas -->
        <div class="bg-white px-8 py-6">
            <h2 class="text-xl font-semibold text-[#027c7d] mb-4">Topic Areas</h2>
            <div class="grid grid-cols-2 gap-3">
                @forelse ($event->topics as $topic)
                    <span class="inline-block bg-[#027c7d] text-white text-xs font-medium px-4 py-3 rounded-md shadow shadow-[#d6dd42]">
                        {{ $topic->name }}
                    </span>
                @empty
                    <p class="text-gray-500 italic">No topics available.</p>
                @endforelse
            </div>
        </div>
        <!-- Contact Emails -->
        <div class="bg-[#027c7d] px-8 py-6">
            @if(!empty($infos['email']))
                <div>
                    <h3 class="text-lg font-semibold text-[#d6dd42] mb-4">Contact Emails</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach ($infos['email'] as $item)
                            <li class="flex items-center gap-2">
                                <span class="font-medium text-white">{{ $item->label }}:</span>
                                <a href="mailto:{{ $item->value }}" class="text-white hover:underline font-semibold transition">
                                    {{ $item->value }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="font-medium text-white text-sm">
                    No Information...
                </div>
            @endif
        </div>
        <!-- Registration Fees Section -->
        <div class="bg-white px-8 py-6">
            <h2 class="text-xl font-semibold text-[#027c7d] mb-4">Registration Fees</h2>

            <!-- Fees Table -->
            <div class="overflow-hidden rounded-lg border border-gray-200">
                <table class="min-w-full bg-white text-gray-700">
                    <thead class="bg-[#027c7d] text-white text-sm">
                        <tr>
                            <th class="text-left px-6 py-3">Type</th>
                            <th class="text-left px-6 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach ($infos['fee'] ?? [] as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 font-medium">{{ $item->label }}</td>
                                <td class="px-6 py-3">{{ $item->value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-white px-8 py-4 text-center text-sm text-gray-500 border-t border-gray-200">
            Status: <span class="font-semibold capitalize">{{ $event->status ?? 'Published' }}</span> |
            <a href="{{ $event->event_website ?? '#' }}" class="text-blue-500 hover:underline" target="_blank">
                Visit Website
            </a>
        </div>
    </div>
</div>
