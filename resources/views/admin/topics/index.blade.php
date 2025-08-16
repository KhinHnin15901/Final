@extends('admin.layout.layout')

@section('main-content')
<div class="table-responsive mt-4" style="font-family: Arial, sans-serif;">
    <h2 class="mb-3" style="color: #027c7d; font-weight: bold; font-size: large;">ALL TOPICS</h2>

    <a href="{{ route('admin.topics.create') }}" class="btn btn-primary mb-3">+ Add New Topic</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">Topic Name</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($topics as $index => $topic)
                <tr>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-2 px-3">{{ $topic->name }}</td>
                    <td class="py-2 px-3 text-nowrap">
                        <a href="{{ route('admin.topics.edit', $topic->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.topics.destroy', $topic->id) }}" method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this topic?');">
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
                    <td colspan="3" class="text-center" style="color: #000120;">No topics found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
