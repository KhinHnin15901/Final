@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 900px; width: 100%; padding: 24px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-top: 4px solid #027c7d;">

        <h4 class="text-center mb-5 fw-bold" style="color: #000120; font-size: 22px;">
            📅 Create Journal Review Schedule
        </h4>

        {{-- Topic Filter Form --}}
        <form method="GET" action="{{ route('admin.schedule.journal') }}" class="row g-3 mb-4">
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Select Topic</label>
                <select id="topic_id" name="topic_id" onchange="this.form.submit()" class="form-select">
                    <option value="">-- Choose Topic --</option>
                    @foreach ($topics as $topic)
                        <option value="{{ $topic->id }}" {{ (int) ($topicId ?? 0) === $topic->id ? 'selected' : '' }}>
                            {{ $topic->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if (session('error'))
            <div class="alert alert-danger mb-3">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        {{-- Schedule Submission Form --}}
        <form action="{{ route('admin.schedule.journalstore') }}" method="POST" class="row g-3">
            @csrf

            {{-- Paper Selection --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Select Paper</label>
                <select id="journal_submission_id" name="journal_submission_id" class="form-select">
                    <option value="">-- Choose Paper --</option>
                    @foreach ($papers as $paper)
                        <option value="{{ $paper->id }}">
                            {{ $paper->title ?? \Illuminate\Support\Str::of($paper->paper_path)->afterLast('/') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Reviewers --}}
            @for ($i = 1; $i <= 3; $i++)
                <div class="col-12">
                    <label class="form-label fw-semibold" style="color:#027c7d;">Reviewer {{ $i }}</label>
                    <select id="reviewer{{ $i }}_id" name="reviewer{{ $i }}_id" class="form-select">
                        <option value="">-- Select Reviewer --</option>
                        @foreach ($reviewers as $rev)
                            <option value="{{ $rev->id }}">{{ $rev->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endfor

            {{-- Start & End Date --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#027c7d;">Start Date</label>
                <input type="date" name="start_date" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#027c7d;">End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>

            {{-- Submit Button --}}
            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn text-white px-5 py-2" style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s;">
                    Save Schedule
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
