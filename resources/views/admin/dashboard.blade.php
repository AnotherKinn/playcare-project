{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        <h3 class="text-[color:var(--pc-turquoise)] font-bold text-xl mb-6 flex items-center gap-2">📊 <span>Dashboard Admin</span></h3>

        {{-- ====== ALERT TRANSAKSI PENDING ====== --}}
        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 rounded-lg shadow-soft-card p-4 mb-6 flex items-center gap-3">
            <i class="bi bi-exclamation-triangle text-yellow-600 text-2xl"></i>
            <div class="flex-1 text-gray-800 text-sm">
                Ada <strong>{{ $transaksiPending }}</strong> transaksi menunggu verifikasi pembayaran.
                <a href="{{ route('admin.transaction.index') }}" class="underline font-semibold ml-1 hover:text-[color:var(--pc-turquoise)]">Verifikasi Sekarang</a>
            </div>
        </div>

        {{-- ====== STATISTIK KARTU ====== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
            <div class="rounded-2xl bg-blue-700 text-white shadow-soft-card p-6 flex items-center justify-between">
                <div>
                    <h6 class="font-semibold uppercase text-sm">Total Parents</h6>
                    <h3 class="text-3xl font-extrabold">{{ $totalParents }}</h3>
                </div>
                <i class="bi bi-people text-white opacity-80 text-5xl"></i>
            </div>

            <div class="rounded-2xl bg-blue-500 text-white shadow-soft-card p-6 flex items-center justify-between">
                <div>
                    <h6 class="font-semibold uppercase text-sm">Total Staff</h6>
                    <h3 class="text-3xl font-extrabold">{{ $totalStaff }}</h3>
                </div>
                <i class="bi bi-person-badge text-white opacity-80 text-5xl"></i>
            </div>

            <div class="rounded-2xl bg-yellow-400 text-gray-900 shadow-soft-card p-6 flex items-center justify-between">
                <div>
                    <h6 class="font-semibold uppercase text-sm">Booking Aktif</h6>
                    <h3 class="text-3xl font-extrabold">{{ $bookingAktif }}</h3>
                </div>
                <i class="bi bi-calendar-check text-gray-900 opacity-80 text-5xl"></i>
            </div>

            <div class="rounded-2xl bg-green-600 text-white shadow-soft-card p-6 flex items-center justify-between">
                <div>
                    <h6 class="font-semibold uppercase text-sm">Pendapatan Bulan Ini</h6>
                    <h3 class="text-3xl font-extrabold">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
                </div>
                <i class="bi bi-cash-stack text-white opacity-80 text-5xl"></i>
            </div>
        </div>

        {{-- ====== BAGIAN GRAFIK & BOOKING ====== --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- ====== GRAFIK PENDAPATAN ====== --}}
            <div class="lg:col-span-7 bg-white rounded-2xl shadow-soft-card p-6">
                <div class="mb-4 text-[color:var(--pc-turquoise)] font-bold text-lg flex items-center gap-2">
                    📈 Grafik Pendapatan Tahunan
                </div>
                <canvas id="incomeChart" height="150"></canvas>
            </div>

            {{-- ====== BOOKING TERBARU ====== --}}
            <div class="lg:col-span-5 bg-white rounded-2xl shadow-soft-card p-6 flex flex-col">
                <h5 class="mb-4 text-[color:var(--pc-turquoise)] font-bold text-lg flex items-center gap-2">
                    🕒 Booking Terbaru
                </h5>

                @if($bookingTerbaru->count() > 0)
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Parent</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Staff</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($bookingTerbaru as $b)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">{{ $b->parent->name ?? '-' }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($b->booking_date)->format('d M Y') }}</td>
                                        <td class="px-4 py-3">
                                            @if ($b->status == 'pending')
                                                <span class="inline-block px-3 py-1 rounded-full text-yellow-800 bg-yellow-100 font-semibold text-xs">Menunggu Verifikasi</span>
                                            @elseif ($b->status == 'approved')
                                                <span class="inline-block px-3 py-1 rounded-full text-green-800 bg-green-100 font-semibold text-xs">Disetujui Admin</span>
                                            @elseif ($b->status == 'assigned')
                                                <span class="inline-block px-3 py-1 rounded-full text-green-800 bg-green-100 font-semibold text-xs">Ditugaskan ke Staff</span>
                                            @elseif ($b->status == 'in_progress')
                                                <span class="inline-block px-3 py-1 rounded-full text-blue-800 bg-blue-100 font-semibold text-xs">Sedang Dikerjakan</span>
                                            @elseif ($b->status == 'completed')
                                                <span class="inline-block px-3 py-1 rounded-full text-green-900 bg-green-200 font-semibold text-xs">Selesai</span>
                                            @else
                                                <span class="inline-block px-3 py-1 rounded-full text-red-800 bg-red-100 font-semibold text-xs">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">{{ $b->assignedStaff->name ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-40 text-gray-400 space-y-2">
                        <i class="bi bi-calendar-x fs-3 text-4xl"></i>
                        <div>Belum ada booking terbaru.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ====== SCRIPT GRAFIK ====== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('incomeChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: @json($chartData),
                    borderColor: '#2bbec6',
                    backgroundColor: 'rgba(43, 190, 198, 0.2)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</x-app-layout>
