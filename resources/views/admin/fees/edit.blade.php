@extends('admin.layout.layout')

@section('main-content')
    <div class="pagetitle">
        <h1>Edit Registration Info</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.fees.index') }}">Registration Info</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit: {{ $info->label }}</h5>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.fees.update', $info->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror"
                            required>
                            <option value="">Select Type</option>
                            <option value="fee" {{ $info->type === 'fee' ? 'selected' : '' }}>Fee</option>
                            <option value="email" {{ $info->type === 'email' ? 'selected' : '' }}>Email</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="label" class="form-label">Label</label>
                        <input type="text" name="label" id="label"
                            class="form-control @error('label') is-invalid @enderror"
                            value="{{ old('label', $info->label) }}" required>
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Value</label>
                        <input type="text" name="value" id="value"
                            class="form-control @error('value') is-invalid @enderror"
                            value="{{ old('value', $info->value) }}" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Update Info</button>
                    <a href="{{ route('admin.fees.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </section>
@endsection
