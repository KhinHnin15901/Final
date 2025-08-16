@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 800px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <h5 class="card-title text-center mb-4 fw-bold" style="color: #000120;">New Committee Member</h5>
        <form method="POST" action="{{ route('admin.committee.store') }}" class="row g-2">
            @csrf

            <!-- Role -->
            <div class="col-md-6">
                <label for="role" class="form-label fw-semibold" style="color: #027c7d; font-size: 0.875rem;">Role</label>
                <select name="role" id="role" class="form-control shadow-sm rounded-md @error('role') is-invalid @enderror"
                    style="border-color: #ced4da; font-size: 0.875rem; padding: 0.625rem;" required>
                    <option value="">Select Role</option>
                    <option value="general_chair">General Chair</option>
                    <option value="program_chair">Program Chair</option>
                    <option value="member">Member</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Title -->
            <div class="col-md-6">
                <label for="title" class="form-label fw-semibold" style="color: #027c7d; font-size: 0.875rem;">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="form-control shadow-sm rounded-md @error('title') is-invalid @enderror"
                    style="border-color: #ced4da; font-size: 0.875rem; padding: 0.625rem;" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Name -->
            <div class="col-md-6">
                <label for="name" class="form-label fw-semibold" style="color: #027c7d; font-size: 0.875rem;">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="form-control shadow-sm rounded-md @error('name') is-invalid @enderror"
                    style="border-color: #ced4da; font-size: 0.875rem; padding: 0.625rem;" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Affiliation -->
            <div class="col-md-6">
                <label for="affiliation" class="form-label fw-semibold" style="color: #027c7d; font-size: 0.875rem;">Affiliation</label>
                <input type="text" id="affiliation" name="affiliation" value="{{ old('affiliation') }}"
                    class="form-control shadow-sm rounded-md @error('affiliation') is-invalid @enderror"
                    style="border-color: #ced4da; font-size: 0.875rem; padding: 0.625rem;" required>
                @error('affiliation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Country -->
            <div class="col-md-6">
                <label for="country" class="form-label fw-semibold" style="color: #027c7d; font-size: 0.875rem;">Country</label>
                <input type="text" id="country" name="country" value="{{ old('country') }}"
                    class="form-control shadow-sm rounded-md @error('country') is-invalid @enderror"
                    style="border-color: #ced4da; font-size: 0.875rem; padding: 0.625rem;">
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-end">
                <button type="submit" class="btn text-white px-3 py-2 shadow"
                    style="background-color: #027c7d; font-weight: 600; border-radius: 8px; transition: all 0.3s; font-size: medium;">
                    Add Member
                </button>
            </div>
        </form>
    </div>
</section>

<style>
    .btn:hover {
        background-color: #026a6b !important;
    }
</style>
@endsection
