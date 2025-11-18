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
                                    <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>
                                        Selesai</option>
                                    <option value="pending_verification"
                                        {{ request('status') == 'pending_verification' ? 'selected' : '' }}>Menunggu
                                        Verifikasi</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        Menunggu</option>
                                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal
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
                                <th>Tipe Waktu Penitipan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $trx)
                            <tr>
                                <td>{{ $trx->transaction_code }}</td>
                                <td>{{ $trx->booking->child->name ?? '-' }}</td>
                                @if($trx->booking->time_type === 'per_jam')
                                <td>Per jam</td>
                                @elseif($trx->booking->time_type === 'per_hari')
                                <td>Sehari</td>
                                @elseif($trx->booking->time_type === 'per_bulan')
                                <td>Sebulan</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>{{ $trx->booking->booking_date ? date('d M Y', strtotime($trx->booking->booking_date)) : '-' }}
                                </td>
                                <td>Rp{{ number_format($trx->amount, 0, ',', '.') }}</td>
                                @if($trx->status === 'pending_verification')
                                <td><span class="badge bg-warning">Menunggu Verifikasi</span></td>
                                @elseif($trx->status === 'pending')
                                <td><span class="badge bg-info text-dark">Menunggu</span></td>
                                @elseif($trx->status === 'success')
                                <td><span class="badge bg-success">Selesai</span></td>
                                @elseif($trx->status === 'failed')
                                <td><span class="badge bg-danger">Gagal</span></td>
                                @else
                                <td><span class="badge bg-secondary">Tidak Diketahui</span></td>
                                @endif

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
                'success' => 'success',
                'pending' => 'warning',
                'pending_verification' => 'warning',
                'failed' => 'danger',
                default => 'secondary'
                };
                @endphp
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            @if($trx->status === 'pending_verification')
                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                                @elseif($trx->status === 'pending')
                                <span class="badge bg-info text-dark">Menunggu</span>
                                @elseif($trx->status === 'success')
                                <span class="badge bg-success">Selesai</span>
                                @elseif($trx->status === 'failed')
                                <span class="badge bg-danger">Gagal</span>
                                @else
                                <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
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
            <x-transaction-detail :transaction="$trx" />
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
