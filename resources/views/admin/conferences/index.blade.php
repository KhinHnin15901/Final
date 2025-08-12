@extends('admin.layout.layout')

@section('main-content')
    <div class="pagetitle">
        <h1>All Conferences</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Conferences</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body pt-4">
                <a href="{{ route('admin.conferences.create') }}" class="btn btn-primary mb-3">+ Create New Conference</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Topic</th>
                                <th>Description</th>
                                <th>Paper</th>
                                <th> Published: </th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conferences as $conference)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $conference->category->name ?? '-' }}</td>
                                    <td>{{ $conference->topic->name ?? '-' }}</td>
                                    <td>{{ \Str::limit($conference->description, 50) }}</td>
                                    <td>
                                        @if ($conference->paper_path)
                                            <a href="{{ asset('storage/' . $conference->paper_path) }}" target="_blank">View
                                                Paper</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <small>
                                            {{ $conference->publication_date ?? '-' }}
                                        </small>
                                    </td>
                                    <td>{{ $conference->contact_email }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ ucfirst($conference->status) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.conferences.edit', $conference->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.conferences.destroy', $conference->id) }}"
                                                method="POST" style="display:inline-block;"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
