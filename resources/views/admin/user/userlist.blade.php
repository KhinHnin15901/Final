@extends('admin.layout.layout')
@section('main-content')
<div class="table-responsive mt-4" style="font-family: Arial, sans-serif;">
    <h2 class="mb-4" style="color: #027c7d; font-weight: bold; font-size: large;">REVIEWERS</h2>

    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Name</th>
                <th class="py-2 px-3">Email</th>
                <th class="py-2 px-3">Position</th>
                <th class="py-2 px-3">Department</th>
                <th class="py-2 px-3">Organization</th>
                <th class="py-2 px-3">Field</th>
                <th class="py-2 px-3">Action</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($reviewers as $index => $reviewer)
            <tr>
                <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                    {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                </td>
                <td class="py-2 px-3">{{ $reviewer->name ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->email ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->position ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->department ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->organization ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->field ?? '-' }}</td>
                <td class="text-nowrap py-2 px-3">
                    <a href="{{ route('admin.user.edit', $reviewer->id) }}"
                       class="btn btn-primary btn-sm me-1">
                        <i class="fas fa-pen"></i>
                    </a>

                    <a href="#"
                       onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $reviewer->id }}').submit(); }"
                       class="btn btn-danger btn-sm me-1">
                        <i class="fas fa-trash"></i>
                    </a>

                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('approach-form-{{ $reviewer->id }}').submit();"
                       class="btn btn-success btn-sm">
                        @if (isset($reviewer->email_verified_at))
                            <i class="fas fa-times"></i>
                        @else
                            <i class="fas fa-check-circle"></i>
                        @endif
                    </a>

                    <form id="delete-form-{{ $reviewer->id }}"
                          action="{{ route('admin.user.destroy', $reviewer->id) }}" method="POST"
                          style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <form id="approach-form-{{ $reviewer->id }}"
                          action="{{ route('admin.user.approach', $reviewer->id) }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center" style="color: #000120;">No reviewer found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
