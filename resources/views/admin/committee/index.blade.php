@extends('admin.layout.layout')

@section('main-content')
<div class="table-responsive mt-4" style="font-family: Arial, sans-serif;">
    <h2 class="mb-3" style="color: #027c7d; font-weight: bold; font-size: large;">COMMITTEE MEMBERS</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.committee.create') }}" class="btn btn-primary mb-3">Add New</a>

    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">Role</th>
                <th class="py-2 px-3">Title</th>
                <th class="py-2 px-3">Name</th>
                <th class="py-2 px-3">Affiliation</th>
                <th class="py-2 px-3">Country</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($members as $index => $member)
                <tr>
                    <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                        {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="py-2 px-3">
                        @switch($member->role)
                            @case('general_chair')
                                General Chair
                            @break
                            @case('program_chair')
                                Program Chair
                            @break
                            @default
                                Member
                        @endswitch
                    </td>
                    <td class="py-2 px-3">{{ $member->title }}</td>
                    <td class="py-2 px-3">{{ $member->name }}</td>
                    <td class="py-2 px-3">{{ $member->affiliation }}</td>
                    <td class="py-2 px-3">{{ $member->country ?? '-' }}</td>
                    <td class="text-nowrap py-2 px-3">
                        <a href="{{ route('admin.committee.edit', $member->id) }}"
                           class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-pen"></i>
                        </a>

                        <form action="{{ route('admin.committee.destroy', $member->id) }}" method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this member?');">
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
                    <td colspan="7" class="text-center" style="color: #000120;">No committee members found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
