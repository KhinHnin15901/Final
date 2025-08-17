@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 600px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">
            New Topic
        </h4>

        <form method="POST" action="{{ route('admin.topics.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Topic Name</label>
                <input type="text" name="name" class="form-control shadow-sm @error('name') is-invalid @enderror" value="{{ old('name') }}" required style="padding: 0.625rem; font-size: 0.875rem;">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn text-white px-4 py-2 shadow" style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s; font-size: 0.95rem;">
                    Create Topic
                </button>
            </div>
        </form>
    </div>
</section>

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
