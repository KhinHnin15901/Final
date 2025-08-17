@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 800px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">
            Edit: {{ $info->label }}
        </h4>

        @if (session('success'))
            <div class="alert alert-success text-center" style="border-radius: 8px;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.fees.update', $info->id) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label for="type" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Type</label>
                <select name="type" id="type" class="form-select shadow-sm @error('type') is-invalid @enderror" style="padding: 0.625rem; font-size: 0.875rem;" required>
                    <option value="">Select Type</option>
                    <option value="fee" {{ $info->type === 'fee' ? 'selected' : '' }}>Fee</option>
                    <option value="email" {{ $info->type === 'email' ? 'selected' : '' }}>Email</option>
                </select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="label" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Label</label>
                <input type="text" name="label" id="label" value="{{ old('label', $info->label) }}"
                       class="form-control shadow-sm @error('label') is-invalid @enderror"
                       style="padding: 0.625rem; font-size: 0.875rem;" required>
                @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label for="value" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Value</label>
                <input type="text" name="value" id="value" value="{{ old('value', $info->value) }}"
                       class="form-control shadow-sm @error('value') is-invalid @enderror"
                       style="padding: 0.625rem; font-size: 0.875rem;" required>
                @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 text-center mt-4 d-flex justify-content-center gap-3">
                <button type="submit"
                        class="btn text-white px-4 py-2 shadow"
                        style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s; font-size: 0.95rem;">
                    Update Info
                </button>
                <a href="{{ route('admin.fees.index') }}"
                   class="btn text-white px-4 py-2 shadow"
                   style="background-color:#6c757d; font-weight:600; border-radius:8px; transition:all 0.3s; font-size: 0.95rem;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #027c7d;
        box-shadow: 0 0 0 0.2rem rgba(2,124,125,0.25);
        outline: none;
    }
    .btn:hover {
        background-color: #026a6b !important;
    }
    a.btn:hover {
        background-color: #5a6268 !important;
    }
</style>
@endsection
