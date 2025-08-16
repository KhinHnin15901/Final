@extends('admin.layout.layout')

@section('main-content')
<div class="table-responsive mt-8" style="font-family: Arial, sans-serif;">
    <h2 class="mb-3" style="color: #027c7d; font-weight: bold; font-size: large;">📅 Conference Review Schedule List</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">Paper</th>
                <th class="py-2 px-3">Reviewer 1</th>
                <th class="py-2 px-3">Reviewer 2</th>
                <th class="py-2 px-3">Reviewer 3</th>
                <th class="py-2 px-3">Start Date</th>
                <th class="py-2 px-3">End Date</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($schedules as $index => $schedule)
                <tr>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-2 px-3">
                        {{ $schedule->conferenceSubmission->title ?? \Illuminate\Support\Str::of($schedule->conferenceSubmission->paper_path)->afterLast('/') }}
                    </td>
                    <td class="py-2 px-3">{{ $schedule->reviewer1->name ?? 'N/A' }}</td>
                    <td class="py-2 px-3">{{ $schedule->reviewer2->name ?? 'N/A' }}</td>
                    <td class="py-2 px-3">{{ $schedule->reviewer3->name ?? 'N/A' }}</td>
                    <td class="py-2 px-3">{{ $schedule->start_date ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $schedule->end_date ?? '-' }}</td>
                    <td class="py-2 px-3 text-nowrap">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.schedule.conferenceedit', $schedule->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-pen"></i>
                        </a>

                        <!-- Send/Unsend Button -->
                        @if($schedule->status === 'send')
                            <a href="#"
                               onclick="event.preventDefault(); if(confirm('Are you sure you want to unsend this paper?')) { document.getElementById('unsend-form-{{ $schedule->id }}').submit(); }"
                               class="btn btn-info btn-sm me-1">
                               <i class="fas fa-undo"></i>
                            </a>
                            <form id="unsend-form-{{ $schedule->id }}" action="{{ route('admin.schedule.conferencesend', $schedule->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                        @else
                            <a href="#"
                               onclick="event.preventDefault(); if(confirm('Are you sure you want to send this paper?')) { document.getElementById('send-form-{{ $schedule->id }}').submit(); }"
                               class="btn btn-success btn-sm me-1">
                               <i class="fas fa-paper-plane"></i>
                            </a>
                            <form id="send-form-{{ $schedule->id }}" action="{{ route('admin.schedule.conferencesend', $schedule->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                        @endif

                        <!-- Delete Button -->
                        <a href="#"
                           onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this schedule?')) { document.getElementById('delete-form-{{ $schedule->id }}').submit(); }"
                           class="btn btn-danger btn-sm">
                           <i class="fas fa-trash"></i>
                        </a>
                        <form id="delete-form-{{ $schedule->id }}" action="{{ route('admin.schedule.conferencedestroy', $schedule->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="color: #000120;">No schedules found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
