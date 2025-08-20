@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card p-4" style="max-width: 800px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; border-top: 4px solid #027c7d; background: #fff;">
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">Edit {{ $user->name }}</h4>

        <form method="POST" action="{{ route('admin.user.update', $user->id) }}" class="row g-3" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if (session('success'))
                <div class="alert alert-success col-12">
                    {{ session('success') }}
                </div>
            @endif

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
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="form-control shadow-sm @error('name') is-invalid @enderror"
                       style="padding: 0.625rem; font-size: 0.875rem;">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                       class="form-control shadow-sm @error('email') is-invalid @enderror"
                       style="padding: 0.625rem; font-size: 0.875rem;">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            @if ($user->roles()->first()->name == 'reviewer')
                <!-- Prefix -->
                <div class="col-md-6">
                    <label for="user_prefix_id" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Prefix</label>
                    <select id="user_prefix_id" name="user_prefix_id" required
                            class="form-control shadow-sm @error('user_prefix_id') is-invalid @enderror"
                            style="padding: 0.625rem; font-size: 0.875rem;">
                        <option value="" disabled {{ old('user_prefix_id', $user->user_prefix_id ?? '') == '' ? 'selected' : '' }}>Select Prefix</option>
                        @foreach ($user_prefixes as $user_prefix)
                            <option value="{{ $user_prefix->id }}" {{ old('user_prefix_id', $user->user_prefix_id ?? '') == $user_prefix->id ? 'selected' : '' }}>
                                {{ $user_prefix->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_prefix_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <!-- Phone -->
                <div class="col-md-6">
                    <label for="phone" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required
                           class="form-control shadow-sm @error('phone') is-invalid @enderror"
                           style="padding: 0.625rem; font-size: 0.875rem;">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Qualification -->
                <div class="col-md-6">
                    <label for="qualification" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Qualification</label>
                    <input type="text" name="qualification" id="qualification" value="{{ old('qualification', $user->qualification) }}" required
                           class="form-control shadow-sm @error('qualification') is-invalid @enderror"
                           style="padding: 0.625rem; font-size: 0.875rem;">
                    @error('qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Institute Name -->
                <div class="col-md-6">
                    <label for="institute_name" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Institute Name</label>
                    <input type="text" name="institute_name" id="institute_name" value="{{ old('institute_name', $user->institute_name) }}" required
                           class="form-control shadow-sm @error('institute_name') is-invalid @enderror"
                           style="padding: 0.625rem; font-size: 0.875rem;">
                    @error('institute_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- CV Form -->
                <div class="col-md-6">
                    <label for="cv_form" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">CV Form</label>
                    <input type="file" name="cv_form" id="cv_form" accept=".pdf,.doc,.docx"
                           class="form-control shadow-sm @error('cv_form') is-invalid @enderror"
                           style="padding: 0.625rem; font-size: 0.875rem;">
                    @php
                        $cvExt = pathinfo($user->cv_form, PATHINFO_EXTENSION);
                    @endphp
                    <a href="{{ asset('storage/' . $user->cv_form) }}"
                        class="btn btn-primary mt-1"
                        target="_blank"
                        download="CV_{{ $user->name ?? 'Reviewer' }}.{{ $cvExt }}">
                        View
                    </a>
                    @error('cv_form') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Latest Qualification -->
                <div class="col-md-6">
                    <label for="latest_qualification" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Latest Qualification</label>
                    <input type="file" name="latest_qualification" id="latest_qualification" accept=".pdf,.doc,.docx"
                           class="form-control shadow-sm @error('latest_qualification') is-invalid @enderror"
                           style="padding: 0.625rem; font-size: 0.875rem;">
                    @php
                        $qualExt = pathinfo($user->latest_qualification, PATHINFO_EXTENSION);
                    @endphp
                    <a href="{{ asset('storage/' . $user->latest_qualification) }}"
                        class="btn btn-primary mt-1"
                        target="_blank"
                        download="Qualification_{{ $user->name ?? 'Reviewer' }}.{{ $qualExt }}">
                        View
                    </a>
                    @error('latest_qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Field -->
                <div class="col-md-12">
                    <label for="field_input" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Field</label>
                    <textarea name="field" id="field_input" rows="4"
                            class="form-control shadow-sm @error('field') is-invalid @enderror"
                            style="padding: 0.625rem; font-size: 0.875rem;">{{ old('field', $user->field) }}</textarea>
                    @error('field') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            @endif

            @if ($user->roles()->first()->name == 'author')
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
            @endif

            <!-- Submit -->
            <div class="col-12 text-end">
                <button type="submit" class="btn shadow-sm text-white px-4 py-2" style="background-color:#027c7d; border-radius: 8px; font-weight:600; font-size:0.875rem;">Update</button>
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
