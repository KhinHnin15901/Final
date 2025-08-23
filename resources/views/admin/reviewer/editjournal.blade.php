@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 900px; width: 100%; padding: 24px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-top: 4px solid #027c7d;">

        <h4 class="text-center mb-5 fw-bold" style="color: #000120; font-size: 22px;">
            ✏️ Edit Journal Review Schedule
        </h4>

        <form method="POST" action="{{ route('admin.schedule.journalupdate', $schedules->id) }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')

            {{-- Current Paper --}}
            <div class="col-12">
                <a href="{{ asset('storage/' . $schedules->journalSubmission->paper_path) }}" class="btn btn-primary" target="_blank">Download Current Paper</a>
            </div>

            {{-- Upload New Paper --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Upload New Paper</label>
                <input type="file" name="paper" class="form-control" accept=".pdf,.doc,.docx,.txt">
            </div>

            {{-- Reviewers --}}
            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Reviewer 1</label>
                <select name="reviewer1_id" class="form-select">
                    <option value="">-- Select Reviewer --</option>
                    @foreach ($reviewers as $reviewer)
                        <option value="{{ $reviewer->id }}" {{ $schedules->reviewer1_id == $reviewer->id ? 'selected' : '' }}>
                            {{ $reviewer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Reviewer 2</label>
                <select name="reviewer2_id" class="form-select">
                    <option value="">-- Select Reviewer --</option>
                    @foreach ($reviewers as $reviewer)
                        <option value="{{ $reviewer->id }}" {{ $schedules->reviewer2_id == $reviewer->id ? 'selected' : '' }}>
                            {{ $reviewer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold" style="color:#027c7d;">Reviewer 3</label>
                <select name="reviewer3_id" class="form-select">
                    <option value="">-- Select Reviewer --</option>
                    @foreach ($reviewers as $reviewer)
                        <option value="{{ $reviewer->id }}" {{ $schedules->reviewer3_id == $reviewer->id ? 'selected' : '' }}>
                            {{ $reviewer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Start & End Dates --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#027c7d;">Start Date</label>
                <input type="date" name="start_date" value="{{ $schedules->start_date }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#027c7d;">End Date</label>
                <input type="date" name="end_date" value="{{ $schedules->end_date }}" class="form-control">
            </div>

            {{-- Submit Button --}}
            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn text-white px-5 py-2" style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s;">
                    Update Schedule
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
