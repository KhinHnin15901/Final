@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 800px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <!-- Section Title -->
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">
            Edit {{ $user->name }}
        </h4>
        <form method="POST" action="{{ route('admin.user.update', $user->id) }}" class="row g-2">
            @csrf
            @method('PUT')
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
            <!-- Address -->
            <div class="col-md-6">
                <label for="address" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Address</label>
                <input type="text" name="address"
                    class="form-control shadow-sm @error('address') is-invalid @enderror"
                    value="{{ old('address', $user->address) }}"
                    style="font-size: 0.875rem; padding: 0.625rem;">
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <!-- Position -->
            <div class="col-md-6">
                <label for="position" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Position</label>
                <input type="text" name="position"
                    class="form-control shadow-sm @error('position') is-invalid @enderror"
                    value="{{ old('position', $user->position) }}"
                    style="font-size: 0.875rem; padding: 0.625rem;">
                @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <!-- Department -->
            <div class="col-md-6">
                <label for="department" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Department</label>
                <input type="text" name="department"
                    class="form-control shadow-sm @error('department') is-invalid @enderror"
                    value="{{ old('department', $user->department) }}"
                    style="font-size: 0.875rem; padding: 0.625rem;">
                @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <!-- Organization -->
            <div class="col-md-6">
                <label for="orginization" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Organization</label>
                <input type="text" name="orginization"
                    class="form-control shadow-sm @error('orginization') is-invalid @enderror"
                    value="{{ old('orginization', $user->orginization) }}"
                    style="font-size: 0.875rem; padding: 0.625rem;">
                @error('orginization') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <!-- Field -->
            <div class="col-md-6">
                <label for="field" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Field</label>
                <input type="text" name="field"
                    class="form-control shadow-sm @error('field') is-invalid @enderror"
                    value="{{ old('field', $user->field) }}"
                    style="font-size: 0.875rem; padding: 0.625rem;">
                @error('field') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
