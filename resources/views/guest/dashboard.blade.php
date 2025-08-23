@extends('guest.layout.layout')
@section('header')
    {{-- Header --}}
    @include('guest.layout.header')
@endsection
@section('main-content')
    @php
        $section = request('section', 'home');
    @endphp


    @if ($section === 'register')
        @include('guest.partials.register')
    @elseif ($section === 'login')
        @include('guest.partials.login')
    @elseif ($section === 'contact')
        @include('guest.partials.contact')
    @elseif ($section === 'about')
        @include('guest.partials.about')
    @elseif ($section === 'notification')
        @include('guest.partials.notification')
    @elseif ($section === 'conferences')
        @include('guest.partials.conferences')
    @elseif ($section === 'conferencesedit')
        @include('guest.partials.conferenceedit')
    @elseif ($section === 'journals')
        @include('guest.partials.journals')
    @elseif ($section === 'journal')
        @include('guest.partials.journal')
    @elseif ($section === 'conference')
        @include('guest.partials.conference')
    @elseif ($section === 'edit')
        @include('guest.partials.journaledit')
    @elseif ($section === 'home')
        @include('guest.partials.home')
    @elseif ($section === 'committee')
        @include('guest.partials.committee')
    @elseif ($section === 'reviewer')
        @include('guest.partials.reviewer')
    @elseif ($section === 'profile')
        @include('guest.profile.edit')
    @elseif ($section === 'publish')
        @include('guest.partials.publish')
    @elseif ($section === 'current_issue')
        @include('guest.partials.current_issue')
    @elseif ($section === 'past_issue')
        @include('guest.partials.past_issue')
    @else
        @include('guest.partials.events')
    @endif
@endsection
