<x-app-layout>
    <div class="container-fluid py-4 px-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <div class="mb-3 mb-md-0">
                <h3 class="fw-bold text-primary mb-1">
                    Selamat datang, {{ Auth::user()->name ?? 'Staff Hebat' }} 👋
                </h3>
                <p class="text-muted mb-0">Semoga harimu menyenangkan di PlayCare 💙</p>
            </div>
            <a href="{{ route('staff.task.index') }}" class="btn btn-primary btn-lg shadow-sm">
                📋 Tugas Hari Ini
            </a>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4 justify-content-center">
            <div class="col-10 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 text-center p-3 h-100">
                    <div class="card-body">
                        <h6 class="text-muted mb-1">Tugas Hari Ini</h6>
                        <h2 class="fw-bold text-primary">{{ $tugasHariIni }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-10 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 text-center p-3 h-100">
                    <div class="card-body">
                        <h6 class="text-muted mb-1">Tugas Selesai</h6>
                        <h2 class="fw-bold text-success">{{ $tugasSelesai }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-10 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 text-center p-3 h-100">
                    <div class="card-body">
                        <h6 class="text-muted mb-1">Tugas Berjalan</h6>
                        <h2 class="fw-bold text-warning">{{ $tugasBerjalan }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">
                📝 Aktivitas Terbaru
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">

                    <!-- 1. Tugas baru dari admin -->
                    <li class="list-group-item border-0">
                        📌 Admin menambahkan <strong>{{ $tugasBaru ?? 0 }}</strong> tugas baru
                    </li>

                    <!-- 2. Booking selesai atau sedang berjalan -->
                    <li class="list-group-item border-0">
                        👨‍👩‍👧‍👦 <strong>{{ $bookingSelesaiHariIni ?? 0 }}</strong> booking sudah selesai / berjalan hari ini
                    </li>

                    <!-- 3. Laporan harian (hanya tampil jika ada) -->
                    @if(!empty($laporanHariIni) && $laporanHariIni > 0)
                    <li class="list-group-item border-0">
                        🧾 <strong>{{ $laporanHariIni }}</strong> laporan telah dibuat hari ini
                    </li>
                    @endif

                </ul>
            </div>
        </div>

    </div>

    <style>
        .card {
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body h2 {
            font-size: 2rem;
        }

    </style>
</x-app-layout>
