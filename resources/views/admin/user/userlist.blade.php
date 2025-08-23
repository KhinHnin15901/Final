@extends('admin.layout.layout')
@section('main-content')
<div class="table-responsive mt-4" style="font-family: Arial, sans-serif;">
    <h2 class="mb-4" style="color: #027c7d; font-weight: bold; font-size: large;">REVIEWERS</h2>
    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif
    <table class="table table-hover align-middle" style="border-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; font-size: medium;">
        <thead class="text-white" style="background-color: #027c7d;">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3 text-nowrap">Reviewer ID</th>
                <th class="py-2 px-3">Name</th>
                <th class="py-2 px-3">Email</th>
                <th class="py-2 px-3">Phone</th>
                <th class="py-2 px-3">Qualification</th>
                <th class="py-2 px-3">Institution</th>
                <th class="py-2 px-3">Field</th>
                <th class="py-2 px-3">Cv Form</th>
                <th class="py-2 px-3">Latest Qualification</th>
                <th class="py-2 px-3">Action</th>
            </tr>
        </thead>
        <tbody style="color: #000120;">
            @forelse ($reviewers as $index => $reviewer)
            <tr>
                <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                    {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                </td>
                <td class="py-2 px-3" style="font-family: monospace; color: #027c7d; font-size: large;">
                    @if ($reviewer->email_verified_at)
                        PJR{{ str_pad($reviewer->id, 3, '0', STR_PAD_LEFT) }}
                    @else
                        {{ str_pad($reviewer->id, 3, '0', STR_PAD_LEFT) }}
                    @endif
                </td>
                <td class="py-2 px-3">{{ $reviewer->user_prefix?->name.$reviewer->name ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->email ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->phone ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->qualification ?? '-' }}</td>
                <td class="py-2 px-3">{{ $reviewer->institute_name ?? '-' }}</td>
                <td class="py-2 px-3" style="max-width: 600px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    @php
                        $reviewer_fields = $reviewer->field ? explode(',', $reviewer->field) : [];
                    @endphp

                    @if (!empty($reviewer_fields))
                        <ul class="list-disc list-inside">
                            @foreach ($reviewer_fields as $field)
                                <li>{{ trim($field) }}</li>
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>

                <td class="py-2 px-3">
                    @if ($reviewer->cv_form)
                        @php
                            $cvExt = pathinfo($reviewer->cv_form, PATHINFO_EXTENSION);
                        @endphp
                        <a href="{{ asset('storage/' . $reviewer->cv_form) }}"
                            class="btn btn-primary"
                            target="_blank"
                            download="CV_{{ $reviewer->name ?? 'Reviewer' }}.{{ $cvExt }}">
                            View
                        </a>
                    @else
                        -
                    @endif
                </td>

                <td class="py-2 px-3">
                    @if ($reviewer->latest_qualification)
                        @php
                            $qualExt = pathinfo($reviewer->latest_qualification, PATHINFO_EXTENSION);
                        @endphp
                        <a href="{{ asset('storage/' . $reviewer->latest_qualification) }}"
                            class="btn btn-primary"
                            target="_blank"
                            download="Qualification_{{ $reviewer->name ?? 'Reviewer' }}.{{ $qualExt }}">
                        View
                        </a>
                    @else
                        -
                    @endif
                </td>

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
