<x-app-layout>
    <div class="container py-4">

        <style>
            @media (max-width: 768px) {
                .data-transaction-container {
                    padding-top: 50px;
                    /* kasih jarak agar gak ketimpa navbar hamburger */
                }
            }

        </style>
        <div class="data-transaction-container">

            {{-- Header --}}
            <h3 class="text-primary fw-bold">📊 Data Transaksi</h3>
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

                {{-- Filter, Search & Export --}}
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

            @php
            $dummyTransactions = [
            ['id' => 'TRX001', 'parent' => 'Aji Pamungkas', 'booking' => 'Anak A', 'method' => 'Transfer', 'total' =>
            'Rp150.000', 'status' => 'Pending', 'date' => '2025-10-26'],
            ['id' => 'TRX002', 'parent' => 'Rina Sari', 'booking' => 'Anak B', 'method' => 'Cash', 'total' =>
            'Rp200.000',
            'status' => 'Sukses', 'date' => '2025-10-25'],
            ['id' => 'TRX003', 'parent' => 'Budi Santoso', 'booking' => 'Anak C', 'method' => 'E-wallet', 'total' =>
            'Rp180.000', 'status' => 'Gagal', 'date' => '2025-10-24'],
            ];
            @endphp

            {{-- Tabel untuk Desktop --}}
            <div class="table-responsive d-none d-md-block mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Parent</th>
                            <th>Booking</th>
                            <th>Metode Pembayaran</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dummyTransactions as $trx)
                        @php
                        $statusClass = match($trx['status']) {
                        'Pending' => 'badge bg-warning text-dark',
                        'Sukses' => 'badge bg-success',
                        'Gagal' => 'badge bg-danger',
                        default => 'badge bg-secondary',
                        };
                        @endphp
                        <tr>
                            <td>{{ $trx['id'] }}</td>
                            <td>{{ $trx['parent'] }}</td>
                            <td>{{ $trx['booking'] }}</td>
                            <td>{{ $trx['method'] }}</td>
                            <td>{{ $trx['total'] }}</td>
                            <td><span class="{{ $statusClass }}">{{ $trx['status'] }}</span></td>
                            <td>{{ $trx['date'] }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $trx['id'] }}">Lihat</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Card untuk Mobile --}}
            <div class="d-md-none mt-3">
                @foreach($dummyTransactions as $trx)
                @php
                $statusClass = match($trx['status']) {
                'Pending' => 'badge bg-warning text-dark',
                'Sukses' => 'badge bg-success',
                'Gagal' => 'badge bg-danger',
                default => 'badge bg-secondary',
                };
                @endphp
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $trx['parent'] }}</h5>
                        <p class="mb-1"><strong>ID:</strong> {{ $trx['id'] }}</p>
                        <p class="mb-1"><strong>Booking:</strong> {{ $trx['booking'] }}</p>
                        <p class="mb-1"><strong>Metode:</strong> {{ $trx['method'] }}</p>
                        <p class="mb-1"><strong>Total:</strong> {{ $trx['total'] }}</p>
                        <p class="mb-1"><strong>Status:</strong> <span
                                class="{{ $statusClass }}">{{ $trx['status'] }}</span></p>
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $trx['date'] }}</p>
                        <div class="text-end mt-2">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $trx['id'] }}">Lihat</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination Dummy --}}
            <nav class="mt-3">
                <ul class="pagination justify-content-end">
                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>

            {{-- Modal Detail Transaksi --}}
            @foreach($dummyTransactions as $trx)
            <div class="modal fade" id="detailModal{{ $trx['id'] }}" tabindex="-1"
                aria-labelledby="detailModalLabel{{ $trx['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="detailModalLabel{{ $trx['id'] }}">Detail Transaksi
                                {{ $trx['id'] }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Parent:</strong> {{ $trx['parent'] }}</p>
                            <p><strong>Booking:</strong> {{ $trx['booking'] }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ $trx['method'] }}</p>
                            <p><strong>Total:</strong> {{ $trx['total'] }}</p>
                            <p><strong>Status:</strong> <span class="{{ $statusClass }}">{{ $trx['status'] }}</span></p>
                            <p><strong>Tanggal:</strong> {{ $trx['date'] }}</p>
                            <hr>
                            {{-- Contoh detail tambahan --}}
                            <p><strong>Detail Booking:</strong></p>
                            <ul>
                                <li>Layanan: Daycare Harian</li>
                                <li>Waktu: 08:00 - 16:00</li>
                                <li>Catatan: Tidak ada alergi</li>
                            </ul>
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
