@extends('admin.layout.layout')

@section('main-content')
<div class="table-responsive mt-8" style="font-family: Arial, sans-serif;">
    <h2 class="mb-3" style="color: #027c7d; font-weight: bold; font-size: large;">📝 Journal Reviews</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">Submission ID</th>
                <th class="py-2 px-3">Reviewer 1</th>
                <th class="py-2 px-3">Reviewer 2</th>
                <th class="py-2 px-3">Reviewer 3</th>
                <th class="py-2 px-3">Evaluation</th>
                <th class="py-2 px-3">Comments</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($reviews as $index => $review)
                <tr>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-2 px-3">
                        {{ $review->journalSubmission ? $review->journalSubmission->id : 'N/A' }}
                    </td>
                    <td class="py-2 px-3">{{ $review->reviewer1->name ?? 'Unknown' }}</td>
                    <td class="py-2 px-3">{{ $review->reviewer2->name ?? 'Unknown' }}</td>
                    <td class="py-2 px-3">{{ $review->reviewer3->name ?? 'Unknown' }}</td>
                    <td class="py-2 px-3 capitalize">{{ str_replace('_', ' ', $review->evaluation) }}</td>
                    <td class="py-2 px-3">{{ \Illuminate\Support\Str::limit($review->reviewer_comments, 50) }}</td>
                    <td class="py-2 px-3 text-nowrap">
                        <!-- Send/Unsend Button -->
                        @if ($review->status === 'sent')
                            <a href="#"
                               onclick="event.preventDefault(); if(confirm('Unsend this review?')) { document.getElementById('toggle-status-{{ $review->id }}').submit(); }"
                               class="btn btn-info btn-sm me-1">
                               <i class="fas fa-undo"></i>
                            </a>
                        @else
                            <a href="#"
                               onclick="event.preventDefault(); if(confirm('Send this review?')) { document.getElementById('toggle-status-{{ $review->id }}').submit(); }"
                               class="btn btn-success btn-sm me-1">
                               <i class="fas fa-paper-plane"></i>
                            </a>
                        @endif
                        <form id="toggle-status-{{ $review->id }}" action="{{ route('admin.schedule.journaltoggleStatus', $review->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                        </form>

                        <!-- Delete Button -->
                        <a href="#"
                           onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this review?')) { document.getElementById('delete-form-{{ $review->id }}').submit(); }"
                           class="btn btn-danger btn-sm">
                           <i class="fas fa-trash"></i>
                        </a>
                        <form id="delete-form-{{ $review->id }}" action="{{ route('admin.schedule.journalreturndestroy', $review->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="color: #000120;">No reviews found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
