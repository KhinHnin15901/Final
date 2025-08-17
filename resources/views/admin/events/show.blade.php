@extends('admin.layout.layout')

@section('main-content')
<section class="section d-flex justify-content-center" style="font-family: Arial, sans-serif; padding: 30px;">
    <div class="card" style="max-width: 900px; width: 100%; box-shadow: 0 4px 15px rgba(214, 221, 66, 0.6); border-radius: 12px; padding: 24px; background: #fff; border-top: 4px solid #027c7d;">
        <h4 class="text-center mb-4 fw-bold" style="color: #000120; font-size: 20px;">
            Event Details
        </h4>

        <table class="table table-bordered table-striped" style="font-size: 0.9rem;">
            <tbody>
                <tr>
                    <th style="width: 35%;">Title</th>
                    <td>{{ $event->title }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $event->description }}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{ $event->location }}</td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td>{{ $event->start_date }}</td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td>{{ $event->end_date }}</td>
                </tr>
                <tr>
                    <th>Submission Deadline</th>
                    <td>{{ $event->submission_deadline }}</td>
                </tr>
                <tr>
                    <th>Acceptance Date</th>
                    <td>{{ $event->acceptance_date }}</td>
                </tr>
                <tr>
                    <th>Camera Ready Deadline</th>
                    <td>{{ $event->camera_ready_deadline }}</td>
                </tr>
                <tr>
                    <th>Event Website</th>
                    <td><a href="{{ $event->event_website }}" target="_blank" style="color:#027c7d;">{{ $event->event_website }}</a></td>
                </tr>
                <tr>
                    <th>Organizer</th>
                    <td>{{ $event->organizer }}</td>
                </tr>
                <tr>
                    <th>Contact Email</th>
                    <td>{{ $event->contact_email }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($event->status) }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $event->category->name }}</td>
                </tr>
                <tr>
                    <th>Topics</th>
                    <td>
                        <ul class="mb-0">
                            @foreach($event->topics as $topic)
                                <li>{{ $topic->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="text-left mt-4">
            <a href="{{ route('admin.events.index') }}" class="btn text-white px-4 py-2 shadow" style="background-color:#027c7d; font-weight:600; border-radius:8px; transition:all 0.3s; font-size:0.95rem;">Back</a>
        </div>
    </div>
</section>

<style>
    table th {
        background-color: #f5f5f5;
        font-weight: 600;
        color: #027c7d;
    }
    table td {
        vertical-align: middle;
    }
    a:hover {
        color: #026a6b;
        text-decoration: none;
    }
</style>
@endsection
