<x-app-layout>
    <div class="container py-4">

        <style>
            @media (max-width: 768px) {
                .data-transaction-container {
                    padding-top: 50px;
                }
            }
        </style>

        <div class="data-transaction-container">
            {{-- Header --}}
            <h3 class="text-primary fw-bold">📊 Data Transaksi</h3>

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body d-flex flex-wrap gap-3 align-items-center">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" placeholder="Cari transaksi..." id="searchInput">
                        </div>

                        <select class="form-select w-auto" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="sukses">Sukses</option>
                            <option value="gagal">Gagal</option>
                        </select>

                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </div>
                </div>
            </div>

            {{-- Tabel untuk Desktop --}}
            <div class="table-responsive d-none d-md-block mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Parent</th>
                            <th>Nama Anak</th>
                            <th>Metode Pembayaran</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                            @php
                                $statusClass = match (strtolower($trx->status)) {
                                    'pending' => 'badge bg-warning text-dark',
                                    'sukses' => 'badge bg-success',
                                    'gagal' => 'badge bg-danger',
                                    default => 'badge bg-secondary',
                                };
                            @endphp
                            <tr>
                                <td>{{ 'TRX-' . $trx->id }}</td>
                                <td>{{ $trx->user->name ?? '-' }}</td>
                                <td>{{ $trx->booking->child->name ?? '-' }}</td>
                                <td>{{ ucfirst($trx->payment_method ?? '-') }}</td>
                                <td>Rp{{ number_format($trx->amount ?? 0, 0, ',', '.') }}</td>
                                <td><span class="{{ $statusClass }}">{{ ucfirst($trx->status ?? '-') }}</span></td>
                                <td>{{ $trx->created_at ? $trx->created_at->format('Y-m-d') : '-' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $trx->id }}">Lihat</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $transactions->links() }}
                </div>
            </div>

            {{-- Card untuk Mobile --}}
            <div class="d-md-none mt-3">
                @foreach($transactions as $trx)
                    @php
                        $statusClass = match (strtolower($trx->status)) {
                            'pending' => 'badge bg-warning text-dark',
                            'sukses' => 'badge bg-success',
                            'gagal' => 'badge bg-danger',
                            default => 'badge bg-secondary',
                        };
                    @endphp
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $trx->user->name ?? '-' }}</h5>
                            <p class="mb-1"><strong>ID:</strong> {{ 'TRX-' . $trx->id }}</p>
                            <p class="mb-1"><strong>Anak:</strong> {{ $trx->booking->child->name ?? '-' }}</p>
                            <p class="mb-1"><strong>Metode:</strong> {{ ucfirst($trx->payment_method ?? '-') }}</p>
                            <p class="mb-1"><strong>Total:</strong> Rp{{ number_format($trx->amount ?? 0, 0, ',', '.') }}</p>
                            <p class="mb-1"><strong>Status:</strong> <span class="{{ $statusClass }}">{{ ucfirst($trx->status ?? '-') }}</span></p>
                            <p class="mb-1"><strong>Tanggal:</strong> {{ $trx->created_at ? $trx->created_at->format('Y-m-d') : '-' }}</p>
                            <div class="text-end mt-2">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $trx->id }}">Lihat</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Modal Detail --}}
            @foreach($transactions as $trx)
                <div class="modal fade" id="detailModal{{ $trx->id }}" tabindex="-1"
                    aria-labelledby="detailModalLabel{{ $trx->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="detailModalLabel{{ $trx->id }}">
                                    Detail Transaksi {{ 'TRX-' . $trx->id }}
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Parent:</strong> {{ $trx->user->name ?? '-' }}</p>
                                <p><strong>Anak:</strong> {{ $trx->booking->child->name ?? '-' }}</p>
                                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($trx->payment_method ?? '-') }}</p>
                                <p><strong>Total:</strong> Rp{{ number_format($trx->amount ?? 0, 0, ',', '.') }}</p>
                                <p><strong>Status:</strong> <span class="{{ $statusClass }}">{{ ucfirst($trx->status ?? '-') }}</span></p>
                                <p><strong>Tanggal:</strong> {{ $trx->created_at ? $trx->created_at->format('Y-m-d') : '-' }}</p>
                                <hr>
                                @if($trx->booking)
                                    <p><strong>Detail Booking:</strong></p>
                                    <ul>
                                        @if($trx->booking->service_type === 'full_day')
                                            <li>Full Day</li>
                                        @elseif($trx->booking->service_type === 'half_day')
                                            <li>Half Day</li>
                                        @elseif($trx->booking->service_type === 'playground')
                                            <li>Playground</li>
                                        @else
                                            <li>-</li>
                                        @endif
                                        <li>Durasi: {{ $trx->booking->duration_hours ?? '-' }} jam</li>
                                        <li>Tanggal Booking: {{ $trx->booking->booking_date?->format('Y-m-d H:i') ?? '-' }}</li>
                                        <li>Catatan: {{ $trx->booking->notes ?? '-' }}</li>
                                    </ul>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
