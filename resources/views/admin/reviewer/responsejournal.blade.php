@extends('admin.layout.layout')
@section('main-content')
<div class="table-responsive mt-8" style="font-family: Arial, sans-serif;">
    <h2 class="mb-3" style="color: #027c7d; font-weight: bold; font-size: large;">📝 Journal Reviews</h2>
    <form method="GET" action="{{ route('admin.schedule.journalreview') }}" class="row g-2 align-items-center mb-4" style="max-width: 500px;">
        <div class="col">
            <select id="search_evaluation" name="search_evaluation"
                    class="form-select shadow-sm"
                    style="border-color:#ccc; color:#000120; font-size:14px;">
                <option value="" {{ request('search_evaluation') == '' ? 'selected' : '' }}>Select Evaluation</option>
                @foreach ($evaluations as $index => $evaluation)
                    <option value="{{ $index }}" {{ request('search_evaluation') == $index ? 'selected' : '' }}>
                        {{ $evaluation }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn text-white shadow-sm"
                    style="background-color:#027c7d; font-size:14px;"
                    onmouseover="this.style.backgroundColor='#026a6b';"
                    onmouseout="this.style.backgroundColor='#027c7d';">
                Search
            </button>
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3 text-nowrap">#</th>
                <th class="py-2 px-3 text-nowrap">Submission ID</th>
                <th class="py-2 px-3 text-nowrap">Reviewer 1</th>
                <th class="py-2 px-3 text-nowrap">Reviewer 2</th>
                <th class="py-2 px-3 text-nowrap">Reviewer 3</th>
                <th class="py-2 px-3 text-nowrap">Evaluation</th>
                <th class="py-2 px-3 text-nowrap">Payment Receipt</th>
                <th class="py-2 px-3 text-nowrap">Comments</th>
                <th class="py-2 px-3 text-nowrap">Actions</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($reviews as $index => $review)
                <tr>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        {{ str_pad($review->id, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        PJ{{ $review->journalSubmission ? str_pad($review->journalSubmission->id, 3, '0', STR_PAD_LEFT) : 'N/A' }}
                    </td>
                    <td class="py-2 px-3">{{ $review->reviewer1->name ?? 'Not Reviewed Yet' }}</td>
                    <td class="py-2 px-3">{{ $review->reviewer2->name ?? 'Not Reviewed Yet' }}</td>
                    <td class="py-2 px-3">{{ $review->reviewer3->name ?? 'Not Reviewed Yet' }}</td>
                    <td class="py-2 px-3 text-capitalize">{{ str_replace('_', ' ', $review->evaluation) }}</td>
                    <td class="py-2 px-3 text-capitalize">
                        @if ($review->kpay_receipt)
                            <a href="{{ asset('storage/'.$review->kpay_receipt) }}" target="_blank" class="text-primary">View</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="py-2 px-3">{{ \Illuminate\Support\Str::limit($review->reviewer_comments, 50) }}</td>
                    <td class="py-2 px-3 text-nowrap">
                        @if ($review->reviewer1_id && $review->reviewer2_id && $review->reviewer3_id && $review->status != 'resubmit' && $review->evaluation != 'published')
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
                        @endif
                        @if ($review->evaluation != 'published')
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
                        @endif
                        @if ($review->evaluation == 'published')
                            <span class="text-success">No Action</span>
                        @endif
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
