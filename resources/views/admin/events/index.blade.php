@extends('admin.layout.layout')

@section('main-content')
<div class="table-responsive mt-4" style="font-family: Arial, sans-serif;">
    <h2 class="mb-3" style="color: #027c7d; font-weight: bold; font-size: large;">ALL EVENTS</h2>

    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">+ Add New Event</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">Title</th>
                <th class="py-2 px-3">Category</th>
                <th class="py-2 px-3">Topics</th>
                <th class="py-2 px-3">Status</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($events as $index => $event)
                <tr>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-2 px-3">{{ $event->title }}</td>
                    <td class="py-2 px-3">{{ $event->category->name ?? 'N/A' }}</td>
                    <td class="py-2 px-3">
                        @if($event->topics->isNotEmpty())
                            <ul class="mb-0" style="padding-left: 1rem;">
                                @foreach($event->topics as $topic)
                                    <li>{{ $topic->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">No Topics</span>
                        @endif
                    </td>
                    <td class="py-2 px-3">
                        <span class="badge {{ $event->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td class="py-2 px-3 text-nowrap">
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-info btn-sm me-1 text-white">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this event?');">
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
                    <td colspan="6" class="text-center" style="color: #000120;">No events found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
