<!-- Sidebar Parent -->
<!-- Sidebar versi Desktop -->
<nav id="sidebarParent"
    class="d-none d-md-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm position-fixed"
    style="width: 260px; min-height: 100vh; z-index: 1030;">
    <a href="{{ route('parent.dashboard') }}" class="d-flex align-items-center mb-3 text-decoration-none">
        <img src="{{ asset('assets/images/logo-playcare.png') }}" alt="PlayCare Logo" class="me-2"
            style="height: 40px;">
        <span class="fs-4 fw-bold text-primary">PlayCare</span>
    </a>

    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('parent.dashboard') }}"
                class="nav-link {{ request()->routeIs('parent.dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('parent.data-children.index') }}"
                class="nav-link {{ request()->routeIs('parent.data-children.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-people me-2"></i> Data Anak
            </a>
        </li>
        <li>
            <a href="{{ route('parent.booking.index') }}"
                class="nav-link {{ request()->routeIs('parent.booking.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-calendar-check me-2"></i> Booking
            </a>
        </li>
        <li>
            <a href="{{ route('parent.transaction.index') }}"
                class="nav-link {{ request()->routeIs('parent.transaction.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-wallet2 me-2"></i> Transaksi
            </a>
        </li>
        <li>
            <a href="{{ route('parent.review.index') }}"
                class="nav-link {{ request()->routeIs('parent.review.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-star me-2"></i> Review
            </a>
        </li>
        <li>
            <a href="{{ route('parent.profile.index') }}"
                class="nav-link {{ request()->routeIs('parent.profile.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-person-circle me-2"></i> Profil
            </a>
        </li>
    </ul>
</nav>


<!-- Sidebar versi Mobile (Offcanvas) -->
<!-- Sidebar versi Mobile (Offcanvas) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold text-primary d-flex align-items-center">
            <img src="{{ asset('assets/images/logo-playcare.png') }}" alt="PlayCare Logo" class="me-2"
                style="height: 32px;">
            PlayCare
        </h5>

        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">
        <ul class="nav nav-pills flex-column mb-auto px-3">

            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('parent.dashboard') }}"
                    class="nav-link {{ request()->routeIs('parent.dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>

            <!-- Data Anak -->
            <li>
                <a href="{{ route('parent.data-children.index') }}"
                    class="nav-link {{ request()->routeIs('parent.data-children.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-people me-2"></i> Data Anak
                </a>
            </li>

            <!-- Booking -->
            <li>
                <a href="{{ route('parent.booking.index') }}"
                    class="nav-link {{ request()->routeIs('parent.booking.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-calendar-check me-2"></i> Booking
                </a>
            </li>

            <!-- Transaksi -->
            <li>
                <a href="{{ route('parent.transaction.index') }}"
                    class="nav-link {{ request()->routeIs('parent.transaction.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-wallet2 me-2"></i> Transaksi
                </a>
            </li>

            <!-- Review -->
            <li>
                <a href="{{ route('parent.review.index') }}"
                    class="nav-link {{ request()->routeIs('parent.review.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-star me-2"></i> Review
                </a>
            </li>

            <!-- Profil -->
            <li>
                <a href="{{ route('parent.profile.index') }}"
                    class="nav-link {{ request()->routeIs('parent.profile.*') ? 'active bg-primary text-white' : 'text-dark' }}">
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
