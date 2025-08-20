@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 800px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <!-- Section Title -->
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">
            Edit Profile
        </h4>
        <form method="POST" action="{{ route('profile.update', $user->id) }}" class="row g-2">
            @csrf
            @method('PUT')
            @if (session('success'))
                <div class="alert alert-success col-12">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger col-12">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Name -->
            <div class="col-md-6">
                <label for="name" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Name</label>
                <input type="text" name="name"
                    class="form-control shadow-sm @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}"
                    style="font-size: 0.875rem; padding: 0.625rem;" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Email</label>
                <input type="email" name="email"
                    class="form-control shadow-sm @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}"
                    style="font-size: 0.875rem; padding: 0.625rem;" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Old Password -->
            <div class="col-md-4">
                <label for="old_password" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Current Password</label>
                <input type="password" name="old_password"
                    class="form-control shadow-sm @error('old_password') is-invalid @enderror"
                    style="font-size: 0.875rem; padding: 0.625rem;">
                @error('old_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- New Password -->
            <div class="col-md-4">
                <label for="password" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">New Password</label>
                <input type="password" name="password"
                    class="form-control shadow-sm @error('password') is-invalid @enderror"
                    style="font-size: 0.875rem; padding: 0.625rem;">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="col-md-4">
                <label for="password_confirmation" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="form-control shadow-sm"
                    style="font-size: 0.875rem; padding: 0.625rem;">
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-end">
                <button type="submit"
                    class="btn text-white px-4 py-2 shadow"
                    style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s; font-size: 0.95rem;">
                    Update
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Custom Styles -->
<style>
    .form-control:focus {
        border-color: #027c7d;
        box-shadow: 0 0 0 0.2rem rgba(2,124,125,0.25);
        outline: none;
    }
    .btn:hover {
        background-color: #026a6b !important;
    }
</style>
@endsection
