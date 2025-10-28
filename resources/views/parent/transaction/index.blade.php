<x-app-layout>
    <div class="d-flex">
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary mb-0">💳 Riwayat Transaksi</h4>
            </div>

            {{-- Filter Bar --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('parent.transaction.index') }}">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari berdasarkan nama anak..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="Berhasil" {{ request('status') == 'Berhasil' ? 'selected' : '' }}>
                                        Berhasil</option>
                                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="Gagal" {{ request('status') == 'Gagal' ? 'selected' : '' }}>Gagal
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Data Transaksi --}}
            @if($transactions->count() > 0)
            <div class="card shadow-sm d-none d-md-block">
                <div class="card-body table-responsive">
                    <table class="table table-striped align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Nama Anak</th>
                                <th>Layanan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $trx)
                            @php
                            $badgeClass = match($trx->status) {
                            'Berhasil' => 'success',
                            'Pending' => 'warning',
                            'Gagal' => 'danger',
                            default => 'secondary'
                            };
                            @endphp
                            <tr>
                                <td>{{ $trx->transaction_code }}</td>
                                <td>{{ $trx->booking->child->name ?? '-' }}</td>
                                @if($trx->booking->service_type === 'half_day')
                                <td>Half Day</td>
                                @elseif($trx->booking->service_type === 'playground')
                                <td>Playground</td>
                                @else
                                <td>Full Day</td>
                                @endif
                                <td>{{ $trx->booking->booking_date ? date('d M Y', strtotime($trx->booking->booking_date)) : '-' }}
                                </td>
                                <td>Rp{{ number_format($trx->amount, 0, ',', '.') }}</td>
                                <td><span class="badge bg-{{ $badgeClass }}">{{ $trx->status }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $trx->id }}">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile Card View --}}
            <div class="d-block d-md-none">
                @foreach ($transactions as $trx)
                @php
                $badgeClass = match($trx->status) {
                'Berhasil' => 'success',
                'Pending' => 'warning',
                'Gagal' => 'danger',
                default => 'secondary'
                };
                @endphp
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            @if($trx->booking->service_type === 'half_day')
                            <h6 class="fw-bold text-primary mb-0">Half Day</h6>
                            @elseif($trx->booking->service_type === 'playground')
                            <h6 class="fw-bold text-primary mb-0">Playground</h6>
                            @else
                            <h6 class="fw-bold text-primary mb-0">Full Day</h6>
                            @endif

                            <span class="badge bg-{{ $badgeClass }}">{{ $trx->status }}</span>
                        </div>
                        <p class="mb-1"><strong>ID:</strong> {{ $trx->transaction_code }}</p>
                        <p class="mb-1"><strong>Nama Anak:</strong> {{ $trx->booking->child->name ?? '-' }}</p>
                        <p class="mb-1"><strong>Tanggal:</strong>
                            {{ $trx->booking->booking_date ? date('d M Y', strtotime($trx->booking->booking_date)) : '-' }}
                        </p>
                        <p class="mb-2"><strong>Total:</strong> Rp{{ number_format($trx->amount, 0, ',', '.') }}</p>
                        <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#detailModal{{ $trx->id }}">
                            <i class="bi bi-eye"></i> Detail
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Modal Detail --}}
            @foreach ($transactions as $trx)
            @php
            $badgeClass = match($trx->status) {
            'Berhasil' => 'success',
            'Pending' => 'warning',
            'Gagal' => 'danger',
            default => 'secondary'
            };
            @endphp
            <div class="modal fade" id="detailModal{{ $trx->id }}" tabindex="-1"
                aria-labelledby="detailModalLabel{{ $trx->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Detail Transaksi {{ $trx->transaction_code }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nama Anak:</strong>
                                    {{ $trx->booking->child->name ?? '-' }}</li>
                                <li class="list-group-item"><strong>Layanan:</strong>
                                    @if($trx->booking->service_type === 'half_day')
                                        Half Day
                                    @elseif($trx->booking->service_type === 'playground')
                                        Playground
                                    @else
                                        Full Day
                                    @endif
                                </li>
                                <li class="list-group-item"><strong>Total Pembayaran:</strong>
                                    Rp{{ number_format($trx->amount, 0, ',', '.') }}</li>
                                <li class="list-group-item"><strong>Status:</strong> <span
                                        class="badge bg-{{ $badgeClass }}">{{ $trx->status }}</span></li>
                                <li class="list-group-item"><strong>Metode Pembayaran:</strong>
                                    {{ $trx->payment_method ?? '-' }}</li>
                                <li class="list-group-item"><strong>Keterangan:</strong>
                                    {{ $trx->status == 'Berhasil' ? 'Pembayaran diterima dan diverifikasi.' : ($trx->status == 'Pending' ? 'Menunggu konfirmasi pembayaran.' : 'Transaksi gagal, silakan ulangi.') }}
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $transactions->withQueryString()->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-emoji-neutral fs-1 text-muted"></i>
                <h5 class="text-muted mt-3">Belum ada transaksi 😅</h5>
                <p class="text-secondary">Ayo booking layanan dulu untuk melakukan transaksi!</p>
                <a href="{{ route('parent.booking.create') }}" class="btn btn-primary">
                    <i class="bi bi-calendar-plus"></i> Booking Sekarang
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
