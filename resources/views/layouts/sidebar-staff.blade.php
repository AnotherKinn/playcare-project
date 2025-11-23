<!-- Sidebar Staff -->
<!-- Sidebar versi Desktop -->
<nav id="sidebarStaff"
    class="d-none d-md-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm position-fixed"
    style="width: 260px; min-height: 100vh; z-index: 1030;">
    <a href="{{ route('staff.dashboard') }}" class="d-flex align-items-center mb-3 text-decoration-none">
        <img src="{{ asset('assets/images/logo-playcare.png') }}" alt="PlayCare Logo" class="me-2"
            style="height: 40px;">
        <span class="fs-4 fw-bold text-primary">PlayCare Staff</span>
    </a>

    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('staff.dashboard') }}"
                class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>

        {{-- Daftar Tugas --}}
        <li>
            <a href="{{ route('staff.task.index') }}"
                class="nav-link {{ request()->routeIs('staff.task.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-people me-2"></i> Daftar Tugas
            </a>
        </li>


        {{-- Jadwal --}}
        {{--<li>
            <a href="#"
                class="nav-link {{ request()->routeIs('staff.report.*') ? 'active bg-primary text-white' : 'text-dark' }}">
        <i class="bi bi-clipboard-data me-2"></i> Jadwal
        </a>
        </li> --}}

        {{-- Laporan --}}
        <li>
            <a href="{{ route('staff.report.index') }}"
                class="nav-link {{ request()->routeIs('staff.report.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-calendar-check me-2"></i> Laporan
            </a>
        </li>

        {{-- Profil --}}
        <li>
            <a href="{{ route('staff.profile.index') }}"
                class="nav-link {{ request()->routeIs('staff.profile.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-person-circle me-2"></i> Profil
            </a>
        </li>
    </ul>
</nav>

<!-- Sidebar versi Mobile (Offcanvas) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold text-primary d-flex align-items-center">
            <img src="{{ asset('assets/images/logo-playcare.png') }}" alt="PlayCare Logo" class="me-2"
                style="height: 32px;">
            PlayCare Staff
        </h5>

        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">
        <ul class="nav nav-pills flex-column mb-auto px-3">

            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('staff.dashboard') }}"
                    class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>

            <!-- Daftar Tugas -->
            <li>
                <a href="{{ route('staff.task.index') }}"
                    class="nav-link {{ request()->routeIs('staff.task.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-people me-2"></i> Daftar Tugas
                </a>
            </li>

            <!-- Laporan -->
            <li>
                <a href="{{ route('staff.report.index') }}"
                    class="nav-link {{ request()->routeIs('staff.report.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-calendar-check me-2"></i> Laporan
                </a>
            </li>

            <!-- Profil -->
            <li>
                <a href="{{ route('staff.profile.index') }}"
                    class="nav-link {{ request()->routeIs('staff.profile.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-person-circle me-2"></i> Profil
                </a>
            </li>

        </ul>

        <hr class="mt-3 mb-2">

        <form method="POST" action="{{ route('logout') }}" class="px-3 mb-3">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
        </form>
    </div>
</div>
