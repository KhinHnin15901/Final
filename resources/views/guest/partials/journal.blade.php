<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 font-[Arial,sans-serif] w-full">
    @forelse ($journal as $journals)
        <div class="bg-white rounded-2xl shadow-md shadow-[#d6dd42] transition-all duration-300 border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-[#027c7d] text-white p-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">{{ $journals->topic->name ?? 'N/A' }}</h2>
                <a href="#"
                    class="bg-white text-[#027c7d] px-3 py-1 text-sm font-semibold rounded-full hover:bg-white/90">
                    Detail
                </a>
            </div>

            <div class="p-6 space-y-3 text-gray-700 text-sm">
                <div class="flex">
                    <span class="w-[9vw] font-semibold text-gray-800">Author:</span>
                    <span class="flex-1">{{ $journals->author->name ?? 'N/A' }}</span>
                </div>
                <div class="flex">
                    <span class="w-[9vw] font-semibold text-gray-800">Website:</span>
                    <span class="flex-1">{{ $journals->journal_website ?? 'N/A' }}</span>
                </div>
                <div class="flex">
                    <span class="w-[9vw] font-semibold text-gray-800">Published:</span>
                    <span class="flex-1">{{ $journals->publication_date ?? 'N/A' }}</span>
                </div>
                <div class="flex">
                    <span class="w-[9vw] font-semibold text-gray-800">Email:</span>
                    <span class="flex-1 text-blue-500 hover:underline cursor-pointer">{{ $journals->contact_email ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t">
                @if ($journals->paper_path)
                    <a href="
                        #
                        {{ asset('storage/' . $journals->paper_path) }}
                        "
                        target="_blank"
                        class="inline-block bg-blue-500 hover:bg-blue-500/90 text-white text-sm font-semibold px-4 py-2 rounded transition">
                        View Paper
                    </a>

                    <a href="
                        #
                        {{ asset('storage/' . $journals->paper_path) }}
                        "
                        download
                        class="inline-block bg-[#027c7d] hover:bg-[#027c7d]/90 text-white text-sm font-semibold px-4 py-2 rounded transition ml-2">
                        Download PDF
                    </a>
                @else
                    <p class="text-red-500 mt-2 text-sm font-medium">No paper uploaded</p>
                @endif
            </div>
        </div>
    @empty
        {{-- <div class="text-center col-span-full text-gray-500">
            <p class="text-md font-medium">No journals available at the moment.</p>
        </div> --}}
    @endforelse
    {{-- @forelse ($journal as $journals) --}}
        <div class="bg-white rounded-2xl shadow-md shadow-[#d6dd42] transition-all duration-300 border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-[#027c7d] text-white p-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold uppercase">{{-- {{ $journals->topic->name ?? 'N/A' }} --}} Journal Topic</h2>
                {{-- <a href="#"
                    class="bg-white text-[#027c7d] px-3 py-1 text-sm font-semibold rounded-full hover:bg-white/90">
                    Detail
                </a> --}}
            </div>

            <div class="p-6 space-y-3 text-gray-700 text-sm">
                <div class="flex">
                    <span class="w-32 font-semibold text-gray-800">Author:</span>
                    <span class="flex-1">{{-- {{ $journals->author->name ?? 'N/A' }} --}} John Doe</span>
                </div>
                <div class="flex">
                    <span class="w-32 font-semibold text-gray-800">Website:</span>
                    <span class="flex-1">{{-- {{ $journals->journal_website ?? 'N/A' }} --}} www.example.com</span>
                </div>
                <div class="flex">
                    <span class="w-32 font-semibold text-gray-800">Published:</span>
                    <span class="flex-1">{{-- {{ $journals->publication_date ?? 'N/A' }} --}} 10.1.2025</span>
                </div>
                <div class="flex">
                    <span class="w-32 font-semibold text-gray-800">Email:</span>
                    <span class="flex-1">{{-- {{ $journals->contact_email ?? 'N/A' }} --}} example@gmail.com</span>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t">
                {{-- @if ($journals->paper_path) --}}
                    <a href="
                        #
                        {{-- {{ asset('storage/' . $journals->paper_path) }} --}}
                        "
                        target="_blank"
                        class="inline-block bg-blue-500 hover:bg-blue-500/90 text-white text-sm font-semibold px-4 py-2 rounded transition">
                        View Paper
                    </a>

                    <a href="
                        #
                        {{-- {{ asset('storage/' . $journals->paper_path) }} --}}
                        "
                        download
                        class="inline-block bg-[#027c7d] hover:bg-[#027c7d]/90 text-white text-sm font-semibold px-4 py-2 rounded transition ml-2">
                        Download PDF
                    </a>
                {{-- @else --}}
                    {{-- <p class="text-red-500 mt-2 text-sm font-medium">No paper uploaded</p> --}}
                {{-- @endif --}}
            </div>
        </div>
    {{-- @empty
        <div class="text-center col-span-full text-gray-500">
            <p class="text-md font-medium">No journals available at the moment.</p>
        </div>
    @endforelse --}}
</div>
