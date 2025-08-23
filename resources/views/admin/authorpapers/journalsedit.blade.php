@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 900px; width: 100%; padding: 24px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-top: 4px solid #027c7d;">
        <h4 class="text-center mb-6 fw-bold" style="color: #000120; font-size: 20px;">
            ✏️ Edit Journal Submission
        </h4>

        <form method="POST" action="{{ route('admin.papers.journalupdate', $submission->id) }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Name --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Name</label>
                <input type="text" name="name" class="form-control shadow-sm @error('name') is-invalid @enderror" value="{{ old('name', $submission->user->name) }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Topic --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Topic</label>
                <select name="topic_id" class="form-select shadow-sm @error('topic_id') is-invalid @enderror" required>
                    <option value="">-- Select Topic --</option>
                    @foreach ($topics as $topic)
                        <option value="{{ $topic->id }}" {{ old('topic_id', $submission->topic_id) == $topic->id ? 'selected' : '' }}>
                            {{ $topic->name }}
                        </option>
                    @endforeach
                </select>
                @error('topic_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Abstract --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Abstract</label>
                <textarea name="abstract" class="form-control shadow-sm @error('abstract') is-invalid @enderror" rows="4" required>{{ old('abstract', $submission->abstract) }}</textarea>
                @error('abstract') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Keywords --}}
            <div class="col-md-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Keywords</label>
                <input type="text" name="keywords" class="form-control shadow-sm @error('keywords') is-invalid @enderror" value="{{ old('keywords', $submission->keywords) }}" required>
                @error('keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Keywords</label>
                <select name="keywords" class="form-select shadow-sm @error('keywords') is-invalid @enderror">
                    <option value="">-- Choose Keyword --</option>
                    @foreach ($allKeywords as $keyword)
                        <option value="{{ $keyword->name }}" {{ old('keywords', $submission->keywords) == $keyword->name ? 'selected' : '' }}>
                            {{ ucfirst($keyword->name) }}
                        </option>
                    @endforeach
                </select>
                @error('keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div> --}}

            {{-- Start & End Date --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#027c7d;">Start Date</label>
                <input type="date" name="start_date" class="form-control shadow-sm @error('start_date') is-invalid @enderror" value="{{ old('start_date', $submission->start_date) }}" required>
                @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#027c7d;">End Date</label>
                <input type="date" name="end_date" class="form-control shadow-sm @error('end_date') is-invalid @enderror" value="{{ old('end_date', $submission->end_date) }}" required>
                @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- File Uploads --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Upload New Paper</label>
                <input type="file" name="paper" class="form-control shadow-sm" accept=".pdf,.doc,.docx">
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Department Rule File</label>
                <input type="file" name="department_rule_file" class="form-control shadow-sm" accept=".pdf,.doc,.docx">
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Professor Rule File</label>
                <input type="file" name="professor_rule_file" class="form-control shadow-sm" accept=".pdf,.doc,.docx">
            </div>

            {{-- Submit Button --}}
            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn text-white px-5 py-2 shadow" style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s;">
                    Update Submission
                </button>
            </div>
        </form>
    </div>
</section>

<style>
    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: #027c7d;
        box-shadow: 0 0 0 0.2rem rgba(2,124,125,0.25);
        outline: none;
    }
    .btn:hover {
        background-color: #026a6b !important;
    }
</style>
@endsection
