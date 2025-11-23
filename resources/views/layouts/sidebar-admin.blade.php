<!-- Sidebar Admin -->
<!-- Sidebar versi Desktop -->
<nav id="sidebarAdmin"
    class="d-none d-md-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm position-fixed"
    style="width: 265px; min-height: 100vh; z-index: 1030;">
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 text-decoration-none">
        <img src="{{ asset('assets/images/logo-playcare.png') }}" alt="PlayCare Logo" class="me-2"
            style="height: 40px;">
        <span class="fs-4 fw-bold text-primary">PlayCare Admin</span>
    </a>

    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>

        {{-- Booking --}}
        <li>
            <a href="{{ route('admin.booking.index') }}"
                class="nav-link {{ request()->routeIs('admin.booking.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-calendar-check me-2"></i> Booking
            </a>
        </li>

        {{-- Staff --}}
        <li>
            <a href="{{ route('admin.data-staff.index') }}"
                class="nav-link {{ request()->routeIs('admin.data-staff.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-person-badge me-2"></i> Staff
            </a>
        </li>

        {{-- Parent --}}
        <li>
            <a href="{{ route('admin.data-parent.index') }}"
                class="nav-link {{ request()->routeIs('admin.data-parent.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-people me-2"></i> Parent
            </a>
        </li>

        {{-- Transaksi --}}
        <li>
            <a href="{{ route('admin.transaction.index') }}"
                class="nav-link {{ request()->routeIs('admin.transaction.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-wallet2 me-2"></i> Transaksi
            </a>
        </li>

        {{-- Laporan --}}
        <li>
            <a href="{{ route('admin.report.index') }}"
                class="nav-link {{ request()->routeIs('admin.report.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-bar-chart-line me-2"></i> Laporan
            </a>
        </li>
    </ul>


    <hr class="mt-3 mb-2">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger w-100">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</nav>

<!-- Tombol Hamburger untuk Mobile -->
<div class="d-md-none bg-white border-bottom shadow-sm p-2 d-flex align-items-center position-fixed top-0 start-0 w-100"
    style="z-index: 1040; height: 56px;">
    <button class="btn btn-outline-primary me-2 ms-2" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasSidebarAdmin" aria-controls="offcanvasSidebarAdmin">
        <i class="bi bi-list fs-4"></i>
    </button>
    <h5 class="fw-bold mb-0 text-primary d-flex align-items-center">
        <img src="{{ asset('assets/images/logo-playcare.png') }}" alt="PlayCare Logo" class="me-2"
            style="height: 28px;">
        PlayCare Admin
    </h5>
</div>

<!-- Spacer agar konten tidak ketutup navbar di mobile -->
<div class="d-md-none" style="height: 56px;"></div>




<!-- Sidebar versi Mobile (Offcanvas) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebarAdmin">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold text-primary">🛠️ PlayCare Admin</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav nav-pills flex-column mb-auto px-3">

            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.booking.index') }}"
                    class="nav-link {{ request()->routeIs('admin.booking.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-calendar-check me-2"></i> Booking
                </a>
            </li>

            <li>
                <a href="{{ route('admin.data-staff.index') }}"
                    class="nav-link {{ request()->routeIs('admin.data-staff.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-person-badge me-2"></i> Staff
                </a>
            </li>

            <li>
                <a href="{{ route('admin.data-parent.index') }}"
                    class="nav-link {{ request()->routeIs('admin.data-parent.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-people me-2"></i> Parent
                </a>
            </li>

            <li>
                <a href="{{ route('admin.transaction.index') }}"
                    class="nav-link {{ request()->routeIs('admin.transaction.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-wallet2 me-2"></i> Transaksi
                </a>
            </li>

            <li>
                <a href="{{ route('admin.report.index') }}"
                    class="nav-link {{ request()->routeIs('admin.report.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-bar-chart-line me-2"></i> Laporan
                </a>
            </li>
        </ul>


        <hr class="mt-3 mb-2">
        <form method="POST" action="{{ route('logout') }}" class="px-3 mb-3">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>
