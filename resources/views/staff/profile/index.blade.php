<x-app-layout>
    <div class="container py-4">
        {{-- Header --}}
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body d-flex align-items-center">
                <img src="{{ $staff['foto'] }}" class="rounded-circle me-3" alt="Foto Profil" width="100" height="100">

                <div class="flex-grow-1">
                    <h4 class="fw-bold mb-0">{{ $staff['nama'] }}</h4>
                    <p class="text-muted mb-1">
                        👩‍⚕️ {{ $staff['jabatan'] }} | Bergabung sejak: {{ $staff['bergabung_sejak'] }}
                    </p>
                </div>
                <a href="{{ route('staff.profile.edit', $staff['id']) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i> Edit Profil
                </a>
            </div>
        </div>

        {{-- Informasi Pribadi --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-person-badge me-2"></i> Informasi Pribadi
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">Nama Lengkap</div>
                    <div class="col-md-8">{{ $staff['nama'] }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">Jabatan</div>
                    <div class="col-md-8">{{ $staff['jabatan'] }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">No. Telepon</div>
                    <div class="col-md-8">{{ $staff['telepon'] }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">Alamat</div>
                    <div class="col-md-8">{{ $staff['alamat'] }}</div>
                </div>
            </div>
        </div>

        {{-- Informasi Akun --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-person-circle me-2"></i> Informasi Akun
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4 fw-semibold">Email</div>
                    <div class="col-md-8">{{ $staff['email'] }}</div>
                </div>

            </div>
        </div>

        {{-- Riwayat Aktivitas --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-graph-up-arrow me-2"></i> Riwayat Aktivitas
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6 mb-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <h5 class="fw-bold mb-1">{{ $staff['laporan_dibuat'] }}</h5>
                            <p class="text-muted mb-0">Laporan Dibuat</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded-3 p-3 bg-light">
                            <h5 class="fw-bold mb-1">{{ $staff['booking_ditangani'] }}</h5>
                            <p class="text-muted mb-0">Booking Ditangani</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // === Sweet Alert Session Success ===
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    // === Sweet Alert Session Error (jaga-jaga) ===
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    @endif

});
</script>
