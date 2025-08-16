<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center custom-green-shadow">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
            <img src="{{ asset('assets/img/logo/logo.jpg') }}" alt="">
            <span class="d-none d-lg-block fs-5">E - JOURNAL</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn fs-4"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <!-- Profile Dropdown -->
            <li class="dropdown pe-3">
                <a class="nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/lu2.jpg') }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->role ?? 'admin' }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="">
                            <i class="bi bi-person" style="color: #027c7d;"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right" style="color: #d6dd42;"></i>
                                <span>Log Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
