<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">📊 Laporan Admin</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            {{-- 📘 Staff Report --}}
            <a href="{{ route('admin.report.staff-report') }}"
                class="rounded-2xl bg-blue-600 text-white shadow-soft-card p-6 flex items-center justify-between transition hover:shadow-xl">
                <div>
                    <h6 class="font-semibold uppercase text-sm">Staff Report</h6>
                    <h3 class="text-2xl font-extrabold">{{ $totalStaffReports }} laporan</h3>
                </div>
                <i class="bi bi-clipboard-data text-5xl opacity-80"></i>
            </a>

            {{-- 💬 Parent Review --}}
            <a href="{{ route('admin.report.parent-review') }}"
                class="rounded-2xl bg-blue-400 text-white shadow-soft-card p-6 flex items-center justify-between transition hover:shadow-xl">
                <div>
                    <h6 class="font-semibold uppercase text-sm">Parent Review</h6>
                    <h3 class="text-2xl font-extrabold">{{ $totalParentReviews }} review</h3>
                </div>
                <i class="bi bi-chat-left-text text-5xl opacity-80"></i>
            </a>

            {{-- 💰 Keuangan --}}
            <a href="{{ route('admin.report.income-report') }}"
                class="rounded-2xl bg-green-600 text-white shadow-soft-card p-6 flex items-center justify-between transition hover:shadow-xl">
                <div>
                    <h6 class="font-semibold uppercase text-sm">Keuangan</h6>
                    <h3 class="text-2xl font-extrabold">
                        Rp {{ number_format($totalIncome, 0, ',', '.') }}
                    </h3>
                </div>
                <i class="bi bi-currency-dollar text-5xl opacity-80"></i>
            </a>

        </div>

    </div>
</x-app-layout>
