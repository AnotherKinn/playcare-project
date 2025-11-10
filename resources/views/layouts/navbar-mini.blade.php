<!-- Navbar Mini -->
<nav class="navbar navbar-light bg-white border-bottom sticky-top px-3 py-2 shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Tombol Toggle Sidebar (muncul di mobile) -->
            <button class="btn btn-outline-primary d-md-none me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar">
                <i class="bi bi-list fs-5"></i>
            </button>
            <h6 class="mb-0 fw-semibold text-primary">Hai, {{ Auth::user()->name ?? 'Parent' }} 👋</h6>
        </div>

        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('parent.notifications.index') }}" class="btn btn-light position-relative">
                <i class="bi bi-bell fs-5"></i>
                @if($notifCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $notifCount }}
                </span>
                @endif
            </a>



            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->photo
                            ? asset('storage/' . Auth::user()->photo)
                            : 'https://via.placeholder.com/35?text=👤' }}" alt="avatar"
                        class="rounded-circle me-2 border" width="35" height="35" style="object-fit: cover;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-item" href="{{ route('parent.profile.edit') }}">Profil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
