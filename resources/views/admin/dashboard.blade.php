<x-app-layout>
    <div class="container-fluid py-4">
        {{-- Tambahkan padding-top khusus untuk mobile --}}
        <style>
            @media (max-width: 768px) {
                .admin-dashboard {
                    padding-top: 50px;
                    /* kasih jarak agar gak ketimpa navbar hamburger */
                }
            }

        </style>
        {{-- Header --}}
        <div class="admin-dashboard">

            <div class="mb-4">
                <h4 class="fw-bold text-primary mb-1">Dashboard Admin</h4>
                <p class="text-muted">Ringkasan aktivitas dan statistik sistem - {{ now()->format('d M Y') }}</p>
            </div>

            {{-- Alert / Notifikasi --}}
            <div class="alert alert-warning shadow-sm">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Ada <strong>3 transaksi</strong> menunggu verifikasi pembayaran.
                <a href="#" class="text-decoration-none fw-bold ms-2">Verifikasi Sekarang</a>
            </div>

            {{-- Statistik Cards --}}
            <div class="row g-3 align-items-stretch">
                <div class="col-6 col-md-3">
                    <div class="card text-white bg-primary shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Total Parents</h6>
                                <h3 class="fw-bold">120</h3>
                            </div>
                            <i class="bi bi-people fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card text-white bg-info shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Total Staff</h6>
                                <h3 class="fw-bold">15</h3>
                            </div>
                            <i class="bi bi-person-badge fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card text-dark bg-warning shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Booking Aktif</h6>
                                <h3 class="fw-bold">34</h3>
                            </div>
                            <i class="bi bi-calendar-check fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card text-white bg-success shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Pendapatan Bulan Ini</h6>
                                <h3 class="fw-bold">Rp 8.500.000</h3>
                            </div>
                            <i class="bi bi-cash-stack fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Grafik Pendapatan (hanya tampil di layar md ke atas) --}}
            <div class="card mt-4 shadow-sm border-0 d-none d-md-block">
                <div class="card-header bg-white fw-bold">
                    <i class="bi bi-bar-chart-line me-2"></i> Statistik Pendapatan Bulanan
                </div>
                <div class="card-body">
                    <canvas id="incomeChart" height="120"></canvas>
                </div>
            </div>

            {{-- Booking Terbaru --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-white fw-bold">
                    <i class="bi bi-calendar-event me-2"></i> Booking Terbaru
                </div>
                <div class="card-body">

                    {{-- Versi Tabel (desktop/tablet) --}}
                    <div class="table-responsive d-none d-md-block">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Parent</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Staff</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rina Puspita</td>
                                    <td>25 Okt 2025</td>
                                    <td><span class="badge bg-warning">Menunggu</span></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Andi Setiawan</td>
                                    <td>24 Okt 2025</td>
                                    <td><span class="badge bg-success">Disetujui</span></td>
                                    <td>Sinta Dewi</td>
                                </tr>
                                <tr>
                                    <td>Maya Lestari</td>
                                    <td>22 Okt 2025</td>
                                    <td><span class="badge bg-danger">Dibatalkan</span></td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Versi Card (mobile) --}}
                    <div class="d-block d-md-none">
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Rina Puspita</h6>
                                <p class="mb-1"><i class="bi bi-calendar-event me-1"></i> 25 Okt 2025</p>
                                <span class="badge bg-warning">Menunggu</span>
                                <p class="text-muted mt-2 mb-0"><i class="bi bi-person me-1"></i> Staff: -</p>
                            </div>
                        </div>
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Andi Setiawan</h6>
                                <p class="mb-1"><i class="bi bi-calendar-event me-1"></i> 24 Okt 2025</p>
                                <span class="badge bg-success">Disetujui</span>
                                <p class="text-muted mt-2 mb-0"><i class="bi bi-person me-1"></i> Staff: Sinta Dewi</p>
                            </div>
                        </div>
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">Maya Lestari</h6>
                                <p class="mb-1"><i class="bi bi-calendar-event me-1"></i> 22 Okt 2025</p>
                                <span class="badge bg-danger">Dibatalkan</span>
                                <p class="text-muted mt-2 mb-0"><i class="bi bi-person me-1"></i> Staff: -</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script Grafik Dummy --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('incomeChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [4000000, 5000000, 4800000, 7000000, 6000000, 8000000, 9500000, 8700000,
                        9100000, 8500000
                    ],
                    borderColor: '#1E3A8A',
                    backgroundColor: 'rgba(30, 58, 138, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
    @endpush
</x-app-layout>
