<x-app-layout>
    <div class="container py-4">

        {{-- Header --}}
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body d-flex align-items-center">
                <img
                    src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/100' }}"
                    class="rounded-circle me-3"
                    alt="Foto Profil"
                    width="100" height="100">
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
                {{-- <a href="#" class="btn btn-outline-primary me-2">
                    <i class="bi bi-key-fill"></i> Ganti Password
                </a> --}}
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
