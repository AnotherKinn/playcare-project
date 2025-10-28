<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">📊 Laporan Admin</h3>

        <div class="row g-4">
            <!-- Staff Report Card -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.report.staff-report') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100 border-start border-primary border-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title text-primary">Staff Report</h5>
                                    <p class="card-text">Jumlah laporan: 12</p>
                                </div>
                                <i class="bi bi-clipboard-data fs-2 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Parent Review Card -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.report.parent-review') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100 border-start border-purple border-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title text-purple">Parent Review</h5>
                                    <p class="card-text">Jumlah review: 8</p>
                                </div>
                                <i class="bi bi-chat-left-text fs-2 text-purple"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Keuangan Card -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.report.income-report') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100 border-start border-success border-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title text-success">Keuangan</h5>
                                    <p class="card-text">Total pendapatan: Rp12.500.000</p>
                                </div>
                                <i class="bi bi-currency-dollar fs-2 text-success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Kondisi Anak Card -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.report.children-report') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100 border-start border-warning border-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title text-warning">Kondisi Anak</h5>
                                    <p class="card-text">Jumlah laporan: 10</p>
                                </div>
                                <i class="bi bi-file-text fs-2 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
