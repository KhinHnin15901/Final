@extends('admin.layout.layout')

@section('main-content')
<div class="table-responsive mt-4" style="font-family: Arial, sans-serif;">
    <h2 class="mb-3" style="color: #027c7d; font-weight: bold; font-size: large;">ALL JOURNALS</h2>

    <a href="{{ route('admin.journals.create') }}" class="btn btn-primary mb-3">+ Create New Journal</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- can add datatable in class if want datatable --}}
    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">Category</th>
                <th class="py-2 px-3">Topic</th>
                <th class="py-2 px-3">Description</th>
                <th class="py-2 px-3">Paper</th>
                <th class="py-2 px-3">Published</th>
                <th class="py-2 px-3">Contact</th>
                <th class="py-2 px-3">Status</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($journals as $index => $journal)
                <tr>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-2 px-3">{{ $journal->category->name ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $journal->topic->name ?? '-' }}</td>
                    <td class="py-2 px-3">{{ \Str::limit($journal->description, 50) }}</td>
                    <td class="py-2 px-3">
                        @if ($journal->paper_path)
                            <a href="{{ asset('storage/' . $journal->paper_path) }}" target="_blank" class="text-primary">View Paper</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td class="py-2 px-3">
                        <small>{{ $journal->publication_date ?? '-' }}</small>
                    </td>
                    <td class="py-2 px-3">{{ $journal->contact_email }}</td>
                    <td class="py-2 px-3">
                        <span class="badge bg-info text-dark">{{ ucfirst($journal->status) }}</span>
                    </td>
                    <td class="text-nowrap py-2 px-3">
                        <a href="{{ route('admin.journals.edit', $journal->id) }}"
                           class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.journals.destroy', $journal->id) }}" method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this journal?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="color: #000120;">No journals found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
