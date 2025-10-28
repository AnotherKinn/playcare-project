<x-app-layout>
    @section('title', 'Manajemen Booking')

    {{-- Simpan di bagian atas halaman --}}
    <meta name="route-verify" content="{{ route('admin.booking.verify', ':id') }}">
    <meta name="route-reject" content="{{ route('admin.booking.reject', ':id') }}">
    <meta name="route-assign" content="{{ route('admin.booking.assign', ':id') }}">
    <div class="d-flex">
        <style>
            @media (max-width: 768px) {
                .booking-container {
                    padding-top: 50px;
                }
            }

        </style>

        <div class="booking-container">
            <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h4 class="fw-bold text-primary mb-2 mb-md-0">📅 Data Booking</h4>
                    <form class="d-flex" method="GET">
                        <input type="text" name="search" class="form-control me-2" placeholder="Cari booking..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary">Cari</button>
                    </form>
                </div>

                {{-- Statistik Ringkas --}}
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Total Booking</h6>
                                <h4 class="fw-bold text-primary">{{ $stats['total'] }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Pending</h6>
                                <h4 class="fw-bold text-warning">{{ $stats['pending'] }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Disetujui</h6>
                                <h4 class="fw-bold text-success">{{ $stats['approved'] }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Selesai</h6>
                                <h4 class="fw-bold text-secondary">{{ $stats['finished'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabel Desktop --}}
                <div class="card shadow-sm border-0 d-none d-md-block">
                    <div class="card-body table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Parent</th>
                                    <th>Nama Anak</th>
                                    <th>Tanggal Booking</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                    <th>Total Biaya</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $i => $b)
                                @php
                                $badge = match($b->status) {
                                'Pending' => 'bg-warning',
                                'Disetujui' => 'bg-success',
                                'Selesai' => 'bg-secondary',
                                default => 'bg-light text-dark'
                                };
                                @endphp
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $b->parent->name ?? '-' }}</td>
                                    <td>{{ $b->child->name ?? '-' }}</td>
                                    <td>{{ $b->booking_date->format('Y-m-d') }}</td>
                                    <td>{{ $b->duration_hours }} Jam</td>
                                    <td><span class="badge {{ $badge }}">{{ $b->status }}</span></td>
                                    <td>Rp {{ number_format($b->total_price, 0, ',', '.') }}</td>
                                    <td>{{ optional($b->transaction?->paid_at)->format('Y-m-d') ?? '-' }}</td>
                                    <td>
                                        @if ($b->transaction && $b->transaction->proof)
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalBukti"
                                            data-proof="{{ $b->transaction->proof }}">Lihat</button>
                                        @else
                                        <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalVerifikasi" data-id="{{ $b->id }}">
                                                Verifikasi
                                            </button>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modalAssign" data-id="{{ $b->id }}">
                                                Assign Staff
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">Belum ada data booking</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Card Mobile --}}
                <div class="d-md-none">
                    @forelse ($bookings as $b)
                    @php
                    $badge = match($b->status) {
                    'Pending' => 'bg-warning',
                    'Disetujui' => 'bg-success',
                    'Selesai' => 'bg-secondary',
                    default => 'bg-light text-dark'
                    };
                    @endphp
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold">{{ $b->child->name ?? '-' }}
                                <span class="badge {{ $badge }}">{{ $b->status }}</span>
                            </h6>
                            <p class="mb-1"><strong>Parent:</strong> {{ $b->parent->name ?? '-' }}</p>
                            <p class="mb-1"><strong>Tanggal Booking:</strong> {{ $b->booking_date->format('Y-m-d') }}
                            </p>
                            <p class="mb-1"><strong>Durasi:</strong> {{ $b->duration_hours }} Jam</p>
                            <p class="mb-1"><strong>Total Biaya:</strong> Rp
                                {{ number_format($b->total_price, 0, ',', '.') }}</p>
                            <p class="mb-1"><strong>Tanggal Transaksi:</strong>
                                {{ optional($b->transaction?->paid_at)->format('Y-m-d') ?? '-' }}</p>
                            <p class="mb-1"><strong>Bukti:</strong>
                                @if ($b->transaction && $b->transaction->proof)
                                <button class="btn btn-sm btn-outline-primary w-100 mb-1" data-bs-toggle="modal"
                                    data-bs-target="#modalBukti"
                                    data-proof="{{ $b->transaction->proof }}">Lihat</button>
                                @else
                                <span class="text-muted">Tidak ada</span>
                                @endif
                            </p>
                            <div class="d-flex gap-2 mt-2">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalVerifikasi" data-id="{{ $b->id }}">
                                    Verifikasi
                                </button>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalAssign" data-id="{{ $b->id }}">
                                    Assign Staff
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted">Belum ada data booking</p>
                    @endforelse
                </div>

                {{-- Modal --}}
                @include('admin.booking.modals')
            </div>
        </div>
    </div>
</x-app-layout>
