@extends('admin.layout.layout')
@section('main-content')
<div class="row g-4" style="font-family: Arial, sans-serif;">
    @php
        $cards = [
            ['title' => 'Reviewers', 'count' => $reviewer_count, 'icon' => 'bi-people-fill', 'bg' => '#027c7d', 'text' => '#d6dd42', 'accent' => 'white'],
            ['title' => 'Authors', 'count' => $author_count, 'icon' => 'bi-person-lines-fill', 'bg' => '#027c7d', 'text' => '#d6dd42', 'accent' => 'white'],
            ['title' => 'Requested Papers', 'count' => $request_paper_journals_count, 'icon' => 'bi-file-earmark-text-fill', 'bg' => '#027c7d', 'text' => '#d6dd42', 'accent' => 'white'],
            ['title' => 'Published Journals', 'count' => $published_journals_count, 'icon' => 'bi-journal-check', 'bg' => '#027c7d', 'text' => '#d6dd42', 'accent' => 'white'],
        ];
    @endphp

    @foreach($cards as $card)
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0 text-center p-4"
                style="background-color: {{ $card['bg'] }}; color: {{ $card['text'] }}; border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">

                <!-- Icon -->
                <div class="mb-2">
                    <i class="bi {{ $card['icon'] }} fs-2" style="color: {{ $card['text'] }};"></i>
                </div>

                <!-- Title -->
                <h6 class="fw-bold text-uppercase mb-3" style="color: {{ $card['accent'] }}; font-size: 14px;">
                    {{ $card['title'] }}
                </h6>

                <!-- Number in circle -->
                <div style="
                    width: 30px;
                    height: 30px;
                    background-color: {{ $card['text'] }};
                    color: {{ $card['bg'] }};
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto;
                    font-size: 16px;
                    font-weight: bold;">
                    {{ $card['count'] }}
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
    }
</style>
@endsection
