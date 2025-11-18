<x-app-layout>
    <div class="container py-4">

        {{-- Header --}}
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body d-flex align-items-center">
                @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle me-3" alt="Foto Profil"
                    width="100" height="100" style="object-fit: cover;">
                @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                    style="width: 100px; height: 100px; font-size: 36px; font-weight: bold;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                @endif

                <div class="flex-grow-1">
                    <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                    <p class="text-muted mb-1">
                        👩‍🦱 Parent | Member sejak:
                        {{ $user->member_since
                    ? \Carbon\Carbon::parse($user->member_since)->translatedFormat('F Y')
                    : $user->created_at->translatedFormat('F Y')
                }}
                    </p>
                </div>

                <a href="{{ route('parent.profile.edit') }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i> Edit Profil
                </a>
            </div>
        </div>

        {{-- Informasi Akun --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-person-circle me-2"></i> Informasi Akun
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">Nama Lengkap</div>
                    <div class="col-md-8">{{ $user->name }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">Email</div>
                    <div class="col-md-8">{{ $user->email }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">No. Telepon</div>
                    <div class="col-md-8">{{ $user->phone ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">Alamat</div>
                    <div class="col-md-8">{{ $user->address ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Informasi Anak --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-people-fill me-2"></i> Informasi Anak
            </div>
            <div class="card-body">
                @if($user->children->isNotEmpty())
                <div class="list-group">
                    @foreach ($user->children as $child)
                    <div class="list-group-item">
                        <h6 class="fw-bold mb-1">👶 {{ $child->name }}</h6>
                        <p class="mb-1 text-muted">Usia: {{ $child->age ?? '-' }} tahun</p>
                        <small class="text-success">Status: {{ $child->status ?? 'Terdaftar di PlayCare' }}</small>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted mb-0">Belum ada data anak yang terdaftar.</p>
                @endif
            </div>
        </div>

        {{-- Keamanan Akun --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-box-arrow-left me-2"></i> Logout Akun
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-inline">
                    @csrf
                    <button type="button" id="logout-btn" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ✅ Notifikasi Sukses --}}
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1800
        });

    </script>
    @endif

    {{-- ⚠️ Konfirmasi Logout --}}
    <script>
        document.getElementById('logout-btn').addEventListener('click', function (e) {
            Swal.fire({
                title: 'Yakin mau logout?',
                text: "Kamu akan keluar dari akun ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });

    </script>
</x-app-layout>
