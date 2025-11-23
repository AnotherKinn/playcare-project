<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-purple mb-4">💰 Laporan Keuangan</h3>

        <a href="{{ route('admin.reports.income.export') }}" class="btn btn-danger mb-10">
            📄 Export PDF
        </a>

        {{-- ====== 3 CARD SUMMARY ====== --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h6 class="text-muted mb-1">Total Pendapatan Bulan Ini</h6>
                    <h4 class="fw-bold text-success">
                        Rp {{ number_format($totals->last() ?? 0, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h6 class="text-muted mb-1">Jumlah Transaksi Bulan Ini</h6>
                    <h4 class="fw-bold">{{ $transactions->count() }}</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h6 class="text-muted mb-1">Bulan & Tahun</h6>
                    <h4 class="fw-bold">
                        {{ \Carbon\Carbon::now()->format('F Y') }}
                    </h4>
                </div>
            </div>
        </div>

        {{-- ====== CHART SECTION ====== --}}
        <div class="mt-5 mb-4">
            <h5 class="fw-bold text-purple mb-3">📈 Grafik Pendapatan per Bulan</h5>
            <div style="max-width: 700px; margin: auto;">
                <canvas id="incomeChart" height="70"></canvas>
            </div>
        </div>


        {{-- ====== TABEL TRANSAKSI ====== --}}
        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Parent</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $index => $trx)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $trx->booking?->parent?->name ?? '-' }}</td>
                        <td>Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $trx->status === 'success' ? 'success' : 'secondary' }}">
                                {{ ucfirst($trx->status) }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($trx->paid_at)->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada transaksi yang dikonfirmasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ====== SCRIPT: CHART.JS CDN ====== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- ====== SCRIPT: RENDER GRAFIK ====== --}}
    <script>
        const ctx = document.getElementById('incomeChart').getContext('2d');

        const months = @json($months);
        const totals = @json($totals);


        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Total Pendapatan (Rp)',
                    data: totals,
                    backgroundColor: 'rgba(99, 102, 241, 0.6)', // ungu soft
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return 'Rp ' + context.formattedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

    </script>
</x-app-layout>
