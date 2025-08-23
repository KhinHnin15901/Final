@if ($section === 'notification')
    <div class="author-notifications font-[Arial,sans-serif] p-4 bg-white rounded-md shadow-md shadow-[#d6dd42] w-[50vw] mx-auto border-4 border-t-[#027c7d]">

        <h2 class="text-lg font-semibold mb-4 text-[#027c7d]">Your Notifications</h2>
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded relative mx-auto shadow mb-2">
                {{ session('success') }}
            </div>
        @endif

        @if ($notifications->count() > 0)
            <ul class="space-y-3 text-sm">
                @foreach ($notifications as $notification)
                    <li class="border p-3 rounded bg-blue-50 flex justify-between items-center">
                        <div>
                            <p class="text-gray-800" style="text-align: justify;">{{ $notification->data['message'] }}</p>
                            @if (isset($notification->data['evaluation']) &&
                                    in_array($notification->data['evaluation'], ['major_revisions', 'minor_revisions']))
                                <div x-data="{
                                    show: false,
                                    submissionId: null,
                                    category: '',
                                    openModal(id, cat) {
                                        this.submissionId = id;
                                        this.category = cat;
                                        this.show = true;
                                    }
                                }" x-cloak>

                                    <!-- Trigger Button -->
                                    <button
                                        @click="openModal({{ $notification->data['submission_id'] }}, '{{ $notification->data['category'] }}')"
                                        class="inline-block mt-2 px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                                        Edit Paper
                                    </button>

                                    <!-- Modal Overlay -->
                                    <div x-show="show" class="fixed inset-0 bg-black bg-opacity-50 z-40"
                                        @click="show = false"></div>

                                    <!-- Modal -->
                                    <div x-show="show" class="fixed inset-0 z-50 flex items-center justify-center p-4">
                                        <div @click.away="show = false"
                                            class="bg-white overflow-y-auto max-h-[90vh] max-w-2xl w-full p-6 border-t-4 border-t-[#027c7d] shadow-md shadow-[#d6dd42] rounded-md">
                                            <h2 class="text-xl font-semibold mb-4 text-gray-700">Edit Your Paper</h2>

                                            <!-- FORM LOGIC -->
                                            <template x-if="category === 'conference'">
                                                <form method="POST" :action="`/conference/${submissionId}`"
                                                    class="space-y-4" enctype="multipart/form-data" class="space-y-4">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ($errors->any())
                                                        <div>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li class="text-red-500">{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <label for="paper"
                                                            class="block font-medium text-gray-700">Paper
                                                            (PDF, DOC, DOCX)
                                                        </label>
                                                        <input type="file" name="paper" id="paper"
                                                            accept=".pdf,.doc,.docx"
                                                            class="w-full border rounded px-3 py-2">
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit"
                                                            class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700 transition">
                                                            Update
                                                        </button>
                                                    </div>

                                                </form>
                                            </template>

                                            <template x-if="category === 'journal'">
                                                <form method="POST" :action="`/journal/${submissionId}`"
                                                    class="space-y-4" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ($errors->any())
                                                        <div>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li class="text-red-500">{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <label for="paper"
                                                            class="block text-sm font-semibold text-[#027c7d]">Paper
                                                            (PDF, DOC, DOCX)
                                                        </label>
                                                        <input type="file" name="paper" id="paper"
                                                            accept=".pdf,.doc,.docx"
                                                            class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1">
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit"
                                                            class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700 transition">
                                                            Update
                                                        </button>
                                                    </div>

                                                </form>
                                            </template>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('notifications.markRead', $notification->id) }}">
                            @csrf
                            <div class="bg-white rounded-lg shadow-lg overflow-y-auto max-h-[20vh] max-w-l p-2">
                                <button type="submit" class="text-sm text-dark-600 hover:text-green-900 whitespace-nowrap">{{in_array($notification->data['evaluation'], ['major_revisions', 'minor_revisions']) ? "Mark Done" : "Mark Read"}}</button>
                            </div>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 text-sm">You have no new notifications.</p>
        @endif
        <br><br>
        <h2 class="text-lg font-semibold mb-4 text-[#027c7d]">Read Notifications</h2>
        @php
            $readNotifications = auth()->user()->readNotifications()->get()->sortByDesc('created_at');

        @endphp

        @if ($readNotifications->count() > 0)
            <ul class="space-y-3 text-sm">
                @foreach ($readNotifications as $notification)
                    <li class="border p-3 rounded bg-blue-50 flex justify-between items-center">
                        <div>
                            <p>{{ $notification->data['message'] }}</p>
                            {{--
                            @if (isset($notification->data['submission_id']))
                                <a href="{{ url('/submissions/' . $notification->data['submission_id']) }}"
                                    class="text-blue-600 underline">View submission</a>
                            @endif --}}
                        </div>

                    </li>
                @endforeach
            @else
                <p>No old notifications.</p>
        @endif
        </ul>
    @else
        <p class="text-gray-600 text-sm">You have no new notifications.</p>
    @endif
</div>
