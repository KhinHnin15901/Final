@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 1000px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">
            Edit Event
        </h4>

        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="col-md-6">
                <label for="title" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Event Title</label>
                <input type="text" name="title" id="title" class="form-control shadow-sm @error('title') is-invalid @enderror"
                       value="{{ old('title', $event->title) }}" required style="padding:0.625rem; font-size:0.875rem;">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Category --}}
            <div class="col-md-6">
                <label for="category_id" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Category</label>
                <select name="category_id" class="form-select shadow-sm @error('category_id') is-invalid @enderror" required style="padding:0.625rem; font-size:0.875rem;">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Dates --}}
            <div class="col-md-6">
                <label for="start_date" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Start Date</label>
                <input type="date" name="start_date" class="form-control shadow-sm" value="{{ old('start_date', $event->start_date) }}" style="padding:0.625rem; font-size:0.875rem;">
            </div>

            <div class="col-md-6">
                <label for="end_date" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">End Date</label>
                <input type="date" name="end_date" class="form-control shadow-sm" value="{{ old('end_date', $event->end_date) }}" style="padding:0.625rem; font-size:0.875rem;">
            </div>

            {{-- Location --}}
            <div class="col-md-6">
                <label for="location" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Location</label>
                <input type="text" name="location" class="form-control shadow-sm" value="{{ old('location', $event->location) }}" style="padding:0.625rem; font-size:0.875rem;">
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <label for="status" class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Status</label>
                <select name="status" class="form-select shadow-sm" style="padding:0.625rem; font-size:0.875rem;">
                    <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="open" {{ old('status', $event->status) == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ old('status', $event->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                    <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            {{-- Topics --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d; font-size:0.875rem;">Topics</label>
                <div class="row">
                    @foreach($topics as $topic)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="topics[]" id="topic_{{ $topic->id }}" value="{{ $topic->id }}"
                                    class="form-check-input @error('topics') is-invalid @enderror"
                                    {{ in_array($topic->id, old('topics', $event->topics->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label" for="topic_{{ $topic->id }}">{{ $topic->name }}</label>
                            </div>
                        </div>
                    @endforeach
                    @error('topics') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn text-white px-4 py-2 shadow" style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s; font-size:0.95rem;">
                    Update Event
                </button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary px-4 py-2 shadow" style="border-radius:8px; font-size:0.95rem;">Cancel</a>
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
