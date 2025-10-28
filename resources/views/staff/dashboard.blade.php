<x-app-layout>
    <div class="container-fluid py-4 px-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-primary mb-1">Selamat datang, {{ Auth::user()->name ?? 'Staff Hebat' }} 👋</h3>
                <p class="text-muted mb-0">Semoga harimu menyenangkan di PlayCare 💙</p>
            </div>
            <a href="#" class="btn btn-primary btn-lg shadow-sm">
                📋 Tugas Hari Ini
            </a>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-1">Tugas Hari Ini</h6>
                        <h3 class="fw-bold text-primary">8</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-1">Tugas Selesai</h6>
                        <h3 class="fw-bold text-success">5</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-1">Tugas Berjalan</h6>
                        <h3 class="fw-bold text-warning">3</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-1">Shift Hari Ini</h6>
                        <span class="badge bg-primary fs-6">Pagi (07:00 - 15:00)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi Penting -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">
                🔔 Notifikasi Penting
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0">🧾 Laporan harian harus dikirim sebelum pukul 17:00.</li>
                    <li class="list-group-item border-0">👶 Anak baru bergabung di kelompok B — pastikan penyesuaian jadwal.</li>
                    <li class="list-group-item border-0">🧹 Ruangan A akan dibersihkan pukul 12:00, mohon dialihkan sementara.</li>
                </ul>
            </div>
        </div>

    </div>

    <style>
        .card {
            border-radius: 1rem;
        }
        .card-body h3 {
            font-size: 2rem;
        }
    </style>
</x-app-layout>
