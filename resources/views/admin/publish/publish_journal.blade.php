@extends('admin.layout.layout')
@section('main-content')
<div class="container mt-4">
    <div class="mx-auto" style="font-family: Arial, sans-serif;">
        <h4 class="mb-4 fw-bold" style="color:#027c7d;">Published Journals</h4>
        @forelse ($publish_journals as $event)
            <div class="card mb-4 shadow-sm border-0 pt-3">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold" style="color:#000120;">Event: {{ $event->title }}</h5>

                    @if($event->journal_submissions->count())
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead style="background-color:#027c7d; color:#fff;">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Paper</th>
                                    </tr>
                                </thead>
                                <tbody style="color:#000120;">
                                    @foreach ($event->journal_submissions as $index => $journal)
                                        <tr>
                                            <td class="text-center fw-bold" style="color:#027c7d;">
                                                {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td>{{ $journal->name }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $journal->paper_path) }}"
                                                   class="btn btn-sm"
                                                   style="background-color:#027c7d; color:#fff; border:none;"
                                                   onmouseover="this.style.backgroundColor='#026a6b';"
                                                   onmouseout="this.style.backgroundColor='#027c7d';"
                                                   target="_blank">
                                                    <i class="bi bi-download"></i> Download Paper
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted py-2">No Data.</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert text-center" style="background-color:#f8f9fa; color:#000120;">No Data...</div>
        @endforelse
    </div>
</div>
@endsection
