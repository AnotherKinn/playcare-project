<x-app-layout>
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Selamat datang, {{ Auth::user()->name ?? 'Orang Tua Hebat' }} 👋</h3>
                <p class="text-muted mb-0">Semoga harimu menyenangkan di PlayCare 💛</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('parent.booking.create') }}" class="btn btn-primary btn-lg shadow-sm">
                    <i class="bi bi-calendar-plus me-1"></i> Buat Booking
                </a>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="row">
            <!-- Left Column: Summary Cards -->
            <div class="col-lg-7">
                <div class="row g-3">
                    <!-- Active Bookings -->
                    <div class="col-sm-6">
                        <div class="card shadow-sm border-0 h-100 clickable-card" data-target="#listBooking">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 bg-primary bg-opacity-10 rounded p-3">
                                    <i class="bi bi-play-circle text-primary fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Active Bookings</h6>
                                    <h4 class="fw-bold mb-0">{{ $activeBookings }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Payment -->
                    <div class="col-sm-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 bg-warning bg-opacity-10 rounded p-3">
                                    <i class="bi bi-wallet2 text-warning fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Pending Payment</h6>
                                    <h4 class="fw-bold mb-0">{{ $pendingPayments }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Last Completed -->
                    <div class="col-sm-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 bg-success bg-opacity-10 rounded p-3">
                                    <i class="bi bi-check-circle text-success fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Completed Bookings</h6>
                                    <h4 class="fw-bold mb-0">{{ $completedBookings }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Anak Terdaftar -->
                    <div class="col-sm-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 bg-info bg-opacity-10 rounded p-3">
                                    <i class="bi bi-people text-info fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Anak Terdaftar</h6>
                                    <h4 class="fw-bold mb-0">{{ $registeredChildren }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Latest Bookings -->
            <div class="col-lg-5 mt-4 mt-lg-0" id="listBooking">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0">Booking Terbaru</h6>
                        <a href="{{ route('parent.booking.index') }}" class="text-decoration-none small text-primary">Lihat Semua</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse ($latestBookings as $booking)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-semibold">{{ $booking->child->name ?? 'Anak Tidak Diketahui' }}</h6>
                                    {{-- <small class="text-muted">Tanggal: {{ $booking->date->format('d M Y') }}</small>  --}}
                                </div>
                                @php
                                    $badgeClass = match($booking->status) {
                                        'pending' => 'bg-warning text-dark',
                                        'approved' => 'bg-info text-dark',
                                        'assigned' => 'bg-primary text-dark',
                                        'in_progress' => 'bg-warning text-dark',
                                        'completed' => 'bg-success text-dark',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($booking->status) }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">Belum ada booking terbaru</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toast notification trigger (demo)
        document.addEventListener('DOMContentLoaded', () => {
            const toastEl = document.getElementById('notifToast');
            const toast = new bootstrap.Toast(toastEl);
            setTimeout(() => toast.show(), 2000);
        });

        // Smooth scroll when clicking Active Bookings card
        document.querySelectorAll('.clickable-card').forEach(card => {
            card.addEventListener('click', () => {
                document.getElementById('listBooking').scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>

</x-app-layout>

