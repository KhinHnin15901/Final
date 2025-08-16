@extends('admin.layout.layout')

@section('main-content')
<div class="overflow-x-auto mt-6" style="font-family: Arial, sans-serif;">
    <h2 class="mb-3" style="color: #027c7d; font-weight: bold; font-size: 1.5rem;">Journal Submissions</h2>

    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">User</th>
                <th class="py-2 px-3">Topic</th>
                <th class="py-2 px-3">Category</th>
                <th class="py-2 px-3">Abstract</th>
                <th class="py-2 px-3">Keywords</th>
                <th class="py-2 px-3">Paper</th>
                <th class="py-2 px-3">Department Rule</th>
                <th class="py-2 px-3">Professor Rule</th>
                <th class="py-2 px-3">Start Date</th>
                <th class="py-2 px-3">End Date</th>
                <th class="py-2 px-3">Action</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($journalSubmissions as $index => $submission)
                <tr>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-2 px-3 text-center">{{ $submission->user_id ?? 'User ' . $submission->user_id }}</td>
                    <td class="py-2 px-3 text-center">{{ $submission->topic_id ?? '-' }}</td>
                    <td class="py-2 px-3 text-center">{{ $submission->category_id ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $submission->abstract ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $submission->keywords ?? '-' }}</td>
                    <td class="py-2 px-3 text-center">
                        @if ($submission->paper_path)
                            <a href="{{ route('admin.journalpaper.download', $submission->id) }}" class="text-success text-decoration-underline">Download</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td class="py-2 px-3 text-center">
                        @if ($submission->department_rule_path)
                            <a href="{{ route('admin.journaldprule.download', $submission->id) }}" class="text-success text-decoration-underline">Download</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td class="py-2 px-3 text-center">
                        @if ($submission->professor_rule_path)
                            <a href="{{ route('admin.journalprorule.download', $submission->id) }}" class="text-success text-decoration-underline">Download</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td class="py-2 px-3 text-center">
                        {{ $submission->start_date ? $submission->start_date->format('d-m-Y') : '-' }}
                    </td>
                    <td class="py-2 px-3 text-center">
                        {{ $submission->end_date ? $submission->end_date->format('d-m-Y') : '-' }}
                    </td>
                    <td class="py-2 px-3 text-nowrap text-center">
                        <a href="{{ route('admin.papers.journalsedit', $submission->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="#"
                           onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this paper?')) { document.getElementById('delete-form-{{ $submission->id }}').submit(); }"
                           class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                        <form id="delete-form-{{ $submission->id }}" action="{{ route('admin.papers.journalsdestroy', $submission->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center" style="color: #000120;">No journal submissions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
