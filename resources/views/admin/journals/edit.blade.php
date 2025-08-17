@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 900px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">
            Update Journal Entry
        </h4>

        <form method="POST" action="{{ route('admin.journals.update', $journal->id) }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-4">
                <label for="category_id" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Category</label>
                <select name="category_id" class="form-select shadow-sm @error('category_id') is-invalid @enderror" style="padding: 0.625rem; font-size: 0.875rem;" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $journal->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="topic_id" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Topic</label>
                <select name="topic_id" class="form-select shadow-sm @error('topic_id') is-invalid @enderror" style="padding: 0.625rem; font-size: 0.875rem;" required>
                    <option value="">Select Topic</option>
                    @foreach ($topics as $topic)
                        <option value="{{ $topic->id }}" {{ $journal->topic_id == $topic->id ? 'selected' : '' }}>
                            {{ $topic->name }}
                        </option>
                    @endforeach
                </select>
                @error('topic_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Status</label>
                <select name="status"
                        class="form-select shadow-sm @error('status') is-invalid @enderror"
                        style="padding: 0.625rem; font-size: 0.875rem;">
                    @foreach (['open', 'reviewing', 'accepted', 'published', 'closed'] as $status)
                        <option value="{{ $status }}" {{ $journal->status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label for="description" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Description</label>
                <textarea name="description" rows="3"
                          class="form-control shadow-sm @error('description') is-invalid @enderror"
                          style="padding: 0.625rem; font-size: 0.875rem;">{{ old('description', $journal->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label for="paper_path" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Upload New Papers (optional)</label>
                <input type="file" name="papers[]" multiple
                       class="form-control shadow-sm @error('paper_path') is-invalid @enderror"
                       accept=".pdf,.doc,.docx"
                       style="padding: 0.625rem; font-size: 0.875rem;">
                @if ($journal->paper_path)
                    <p class="mt-2" style="font-size: 0.85rem;">Current file:
                        <a href="{{ asset('storage/' . $journal->paper_path) }}" target="_blank" style="color:#027c7d; text-decoration: underline;">View Merged File</a>
                    </p>
                @endif
                @error('paper_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="start_date" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Start Date</label>
                <input type="date" name="start_date"
                       class="form-control shadow-sm @error('start_date') is-invalid @enderror"
                       value="{{ old('start_date', $journal->start_date) }}"
                       style="padding: 0.625rem; font-size: 0.875rem;">
                @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="end_date" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">End Date</label>
                <input type="date" name="end_date"
                       class="form-control shadow-sm @error('end_date') is-invalid @enderror"
                       value="{{ old('end_date', $journal->end_date) }}"
                       style="padding: 0.625rem; font-size: 0.875rem;">
                @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="publication_date" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Publication Date</label>
                <input type="date" name="publication_date"
                       class="form-control shadow-sm @error('publication_date') is-invalid @enderror"
                       value="{{ old('publication_date', $journal->publication_date) }}"
                       style="padding: 0.625rem; font-size: 0.875rem;">
                @error('publication_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="journal_website" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Journal Website</label>
                <input type="url" name="journal_website"
                       class="form-control shadow-sm @error('journal_website') is-invalid @enderror"
                       value="{{ old('journal_website', $journal->journal_website) }}"
                       style="padding: 0.625rem; font-size: 0.875rem;">
                @error('journal_website') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="contact_email" class="form-label fw-semibold" style="color:#027c7d; font-size: 0.875rem;">Contact Email</label>
                <input type="email" name="contact_email"
                       class="form-control shadow-sm @error('contact_email') is-invalid @enderror"
                       value="{{ old('contact_email', $journal->contact_email) }}"
                       style="padding: 0.625rem; font-size: 0.875rem;">
                @error('contact_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 text-center mt-4 d-flex justify-content-center gap-3">
                <button type="submit"
                        class="btn text-white px-4 py-2 shadow"
                        style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s; font-size: 0.95rem;">
                    Update Journal
                </button>
                <a href="{{ route('admin.journals.index') }}"
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
