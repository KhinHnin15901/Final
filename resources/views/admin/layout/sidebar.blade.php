@php
    // Check if any Manage Topics child route is active
    $manageTopicsActive = request()->routeIs('admin.topics.*');
    $requestAuthorPaper = request()->routeIs('admin.papers.*');
    $user = request()->routeIs('admin.user.*');
    $schedule = request()->routeIs('admin.schedule.*');
    $committee = request()->routeIs('admin.committee.*');
    $fees = request()->routeIs('admin.fees.*');
    $journals = request()->routeIs('admin.journals.*');
    $conferences = request()->routeIs('admin.conferences.*');
@endphp

<aside class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link {{ $user ? '' : 'collapsed' }}" data-bs-target="#user-nav" data-bs-toggle="collapse"
                href="#" aria-expanded="{{ $user ? 'true' : 'false' }}">
                <i class="bi bi-list"></i><span class="{{ (request()->routeIs('admin.user.reviewer') || request()->routeIs('admin.user.author')) ? 'active' : '' }}">Manage Users</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="user-nav" class="nav-content collapse {{ $user ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->routeIs('admin.user.reviewer') ? 'active' : '' }}"
                        href="{{ route('admin.user.reviewer') }}">
                        <i class="bi bi-circle"></i><span>Reviewer</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.user.author') ? 'active' : '' }}"
                        href="{{ route('admin.user.author') }}">
                        <i class="bi bi-circle"></i><span>Author</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $committee ? '' : 'collapsed' }}" data-bs-target="#committee-nav"
                data-bs-toggle="collapse" href="#" aria-expanded="{{ $committee ? 'true' : 'false' }}">
                <i class="bi bi-people-fill text-purple-700"></i><span class="{{ (request()->routeIs('admin.committee.create') || request()->routeIs('admin.committee.index')) ? 'active' : '' }}">Manage Committee</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="committee-nav" class="nav-content collapse {{ $committee ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.committee.create') }}"
                        class="{{ request()->routeIs('admin.committee.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Create Committee</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.committee.index') }}"
                        class="{{ request()->routeIs('admin.committee.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>View Committee</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $fees ? '' : 'collapsed' }}" data-bs-target="#fees-nav" data-bs-toggle="collapse"
                href="#" aria-expanded="{{ $fees ? 'true' : 'false' }}">
                <i class="bi bi-currency-dollar text-green-700"></i><span class="{{ (request()->routeIs('admin.fees.create') || request()->routeIs('admin.fees.index')) ? 'active' : '' }}">Manage Fees</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="fees-nav" class="nav-content collapse {{ $fees ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.fees.create') }}"
                        class="{{ request()->routeIs('admin.fees.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Create Fee</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.fees.index') }}"
                        class="{{ request()->routeIs('admin.fees.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>View Fees</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $journals ? '' : 'collapsed' }}" data-bs-target="#journal-nav"
                data-bs-toggle="collapse" href="#" aria-expanded="{{ $journals ? 'true' : 'false' }}">
                <i class="bi bi-book text-indigo-700"></i><span class="{{ (request()->routeIs('admin.journals.create') || request()->routeIs('admin.journals.index')) ? 'active' : '' }}">Manage Journals</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="journal-nav" class="nav-content collapse {{ $journals ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.journals.create') }}"
                        class="{{ request()->routeIs('admin.journals.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Create Journal</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.journals.index') }}"
                        class="{{ request()->routeIs('admin.journals.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>View Journals</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $conferences ? '' : 'collapsed' }}" data-bs-target="#conference-nav"
                data-bs-toggle="collapse" href="#" aria-expanded="{{ $conferences ? 'true' : 'false' }}">
                <i class="bi bi-calendar-event text-indigo-700"></i><span class="{{ (request()->routeIs('admin.conferences.create') || request()->routeIs('admin.conferences.index')) ? 'active' : '' }}">Manage Conferences</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="conference-nav" class="nav-content collapse {{ $conferences ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.conferences.create') }}"
                        class="{{ request()->routeIs('admin.conferences.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Create Conference</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.conferences.index') }}"
                        class="{{ request()->routeIs('admin.conferences.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>View Conferences</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ $manageTopicsActive ? '' : 'collapsed' }}" data-bs-target="#forms-nav"
                data-bs-toggle="collapse" href="#" aria-expanded="{{ $manageTopicsActive ? 'true' : 'false' }}">
                <i class="bi bi-journal-richtext"></i><span class="{{ (request()->routeIs('admin.topics.create') || request()->routeIs('admin.topics.index')) ? 'active' : '' }}">Manage Topics</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse {{ $manageTopicsActive ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->routeIs('admin.topics.create') ? 'active' : '' }}"
                        href="{{ route('admin.topics.create') }}">
                        <i class="bi bi-circle"></i>
                        <span>Create Topics</span>
                    </a>
                </li>

                <li>
                    <a class="{{ request()->routeIs('admin.topics.index') ? 'active' : '' }}"
                        href="{{ route('admin.topics.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>View Topics</span>
                    </a>
                </li>


            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#event-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-easel2 text-green-600 text-xl"></i><span class="{{ (request()->routeIs('admin.events.create') || request()->routeIs('admin.events.index')) ? 'active' : '' }}">Manage Events</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="event-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('admin.events.create') }}"
                        class="{{ request()->routeIs('admin.events.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Create Event</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.events.index') }}"
                        class="{{ request()->routeIs('admin.events.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>View Events</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $requestAuthorPaper ? '' : 'collapsed' }}" data-bs-target="#forms-navs"
                data-bs-toggle="collapse" href="#"
                aria-expanded="{{ $requestAuthorPaper ? 'true' : 'false' }}">
                <i class="bi bi-circle"></i><span class="d-flex align-items-center gap-1 {{ (request()->routeIs('admin.papers.journals') || request()->routeIs('admin.papers.conferences')) ? 'active' : '' }}">
                    Author Paper Request
                    @if (auth()->user()->journalSubCount() > 0 || auth()->user()->conferenceSubCount() > 0)
                        <span class="badge bg-danger">{{ auth()->user()->journalSubCount() + auth()->user()->conferenceSubCount()}}</span>
                    @endif
                </span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-navs" class="nav-content collapse {{ $requestAuthorPaper ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <a class="{{ request()->routeIs('admin.papers.journals') ? 'active' : '' }} d-flex align-items-center gap-1"
                    href="{{ route('admin.papers.journals') }}">
                    <i class="bi bi-circle"></i>
                    <span>Journals</span>
                    @if (auth()->user()->journalSubCount() > 0)
                        <span class="badge bg-danger">{{ auth()->user()->journalSubCount()}}</span>
                    @endif
                </a>

                <a class="{{ request()->routeIs('admin.papers.conferences') ? 'active' : '' }} d-flex align-items-center gap-1"
                    href="{{ route('admin.papers.conferences') }}">
                    <i class="bi bi-circle"></i>
                    <span>Conferences</span>
                    @if (auth()->user()->conferenceSubCount() > 0)
                        <span class="badge bg-danger">{{ auth()->user()->conferenceSubCount()}}</span>
                    @endif
                </a>



            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $schedule ? '' : 'collapsed' }}" data-bs-target="#schedule-nav"
                data-bs-toggle="collapse" href="#" aria-expanded="{{ $schedule ? 'true' : 'false' }}">
                <i class="bi bi-list"></i><span class="{{
                (
                    request()->routeIs('admin.schedule.journal') ||
                    request()->routeIs('admin.schedule.conference')) ||
                    request()->routeIs('admin.schedule.journalview') ||
                    request()->routeIs('admin.schedule.conferenceview') ||
                    request()->routeIs('admin.schedule.journalreview') ||
                    request()->routeIs('admin.schedule.conferencereview'
                ) ? 'active' : '' }}">Manage Reviewer Assign</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="schedule-nav" class="nav-content collapse {{ $schedule ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->routeIs('admin.schedule.journal') ? 'active' : '' }}"
                        href="{{ route('admin.schedule.journal') }}">
                        <i class="bi bi-circle"></i><span>Create Journal Schedule</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.schedule.conference') ? 'active' : '' }}"
                        href="{{ route('admin.schedule.conference') }}">
                        <i class="bi bi-circle"></i><span>Create Conference Schedule</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.schedule.journalview') ? 'active' : '' }}"
                        href="{{ route('admin.schedule.journalview') }}">
                        <i class="bi bi-circle"></i><span>View Journal Schedule</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.schedule.conferenceview') ? 'active' : '' }}"
                        href="{{ route('admin.schedule.conferenceview') }}">
                        <i class="bi bi-circle"></i><span>View Conference Schedule</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.schedule.journalreview') ? 'active' : '' }}"
                        href="{{ route('admin.schedule.journalreview') }}">
                        <i class="bi bi-circle"></i>
                        <span class="d-flex align-items-center gap-1">
                            View Return Journal
                            @if (auth()->user()->returnJournal() > 0)
                                <span class="badge bg-danger">{{ auth()->user()->returnJournal() }}</span>
                            @endif
                        </span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.schedule.conferencereview') ? 'active' : '' }}"
                        href="{{ route('admin.schedule.conferencereview') }}">
                        <i class="bi bi-circle"></i><span>View Return Conference</span>
                    </a>
                </li>



                {{-- <li>
                    <a class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"
                        href="{{ route('admin.return.conferences') }}">
                        <i class="bi bi-circle"></i><span>Conferences</span>
                    </a>
                </li> --}}

            </ul>
        </li>

    </ul>

    </li><!-- End Forms Nav -->

    </ul>

</aside>

@include('admin.components.LogoutModal')
