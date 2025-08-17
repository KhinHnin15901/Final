@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 1000px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">
            Create Event
        </h4>

        <form method="POST" action="{{ route('admin.events.store') }}" class="row g-3">
            @csrf

            {{-- Title --}}
            <div class="col-md-6">
                <label for="title" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Title</label>
                <input type="text" name="title" class="form-control shadow-sm @error('title') is-invalid @enderror" value="{{ old('title') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Location --}}
            <div class="col-md-6">
                <label for="location" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Location</label>
                <input type="text" name="location" class="form-control shadow-sm @error('location') is-invalid @enderror" value="{{ old('location') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Description --}}
            <div class="col-md-6">
                <label for="description" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Description</label>
                <textarea name="description" class="form-control shadow-sm @error('description') is-invalid @enderror" style="padding:0.625rem; font-size:0.875rem;">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Dates --}}
            <div class="col-md-3">
                <label for="start_date" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Start Date</label>
                <input type="date" name="start_date" class="form-control shadow-sm @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-3">
                <label for="end_date" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">End Date</label>
                <input type="date" name="end_date" class="form-control shadow-sm @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Other dates --}}
            <div class="col-md-4">
                <label for="submission_deadline" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Submission Deadline</label>
                <input type="date" name="submission_deadline" class="form-control shadow-sm @error('submission_deadline') is-invalid @enderror" value="{{ old('submission_deadline') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('submission_deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="acceptance_date" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Acceptance Date</label>
                <input type="date" name="acceptance_date" class="form-control shadow-sm @error('acceptance_date') is-invalid @enderror" value="{{ old('acceptance_date') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('acceptance_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="camera_ready_deadline" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Camera Ready Deadline</label>
                <input type="date" name="camera_ready_deadline" class="form-control shadow-sm @error('camera_ready_deadline') is-invalid @enderror" value="{{ old('camera_ready_deadline') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('camera_ready_deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Publication Partner --}}
            <div class="col-md-6">
                <label for="publication_partner" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Publication Partner</label>
                <input type="text" name="publication_partner" class="form-control shadow-sm @error('publication_partner') is-invalid @enderror" value="{{ old('publication_partner') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('publication_partner') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Organizer --}}
            <div class="col-md-6">
                <label for="organizer" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Organizer</label>
                <input type="text" name="organizer" class="form-control shadow-sm @error('organizer') is-invalid @enderror" value="{{ old('organizer') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('organizer') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Event Website --}}
            <div class="col-md-6">
                <label for="event_website" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Event Website</label>
                <input type="text" name="event_website" class="form-control shadow-sm @error('event_website') is-invalid @enderror" value="{{ old('event_website') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('event_website') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Contact Email --}}
            <div class="col-md-6">
                <label for="contact_email" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Contact Email</label>
                <input type="email" name="contact_email" class="form-control shadow-sm @error('contact_email') is-invalid @enderror" value="{{ old('contact_email') }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('contact_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Category --}}
            <div class="col-md-6">
                <label for="category_id" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Select Category</label>
                <select name="category_id" class="form-select shadow-sm @error('category_id') is-invalid @enderror" required style="padding:0.625rem; font-size:0.875rem;">
                    <option value="">-- Choose a Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <label for="status" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Status</label>
                <select name="status" class="form-select shadow-sm @error('status') is-invalid @enderror" required style="padding:0.625rem; font-size:0.875rem;">
                    <option value="">-- Choose Status --</option>
                    <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Topics --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Select Topics</label>
                <div class="row">
                    @foreach ($topics as $topic)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input @error('topics') is-invalid @enderror" type="checkbox" name="topics[]" value="{{ $topic->id }}" id="topic_{{ $topic->id }}" {{ in_array($topic->id, old('topics', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="topic_{{ $topic->id }}">{{ $topic->name }}</label>
                            </div>
                        </div>
                    @endforeach
                    @error('topics') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn text-white px-4 py-2 shadow" style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s; font-size:0.95rem;">
                    Create Event
                </button>
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
</style>
@endsection
