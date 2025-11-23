<x-app-layout>

    <div class="container py-5 d-flex flex-column align-items-center justify-content-center">

        <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 600px; width: 100%;">

            <h3 class="fw-bold text-primary text-center mb-3">Detail Pembayaran</h3>
            <p class="text-muted text-center mb-4">Halaman ini muncul setelah QR di-scan.</p>

            {{-- Detail Transaksi --}}
            <h5 class="fw-bold text-secondary mb-3">Informasi Transaksi</h5>
            <div class="mb-3">
                <p class="mb-1"><strong>Kode Transaksi:</strong> {{ $transaction->transaction_code }}</p>
                <p class="mb-1"><strong>Metode Pembayaran:</strong> {{ strtoupper($transaction->payment_method) }}</p>
                <p class="mb-1"><strong>Status:</strong>
                    <span class="badge
                        @if($transaction->status == 'pending') bg-warning
                        @elseif($transaction->status == 'paid') bg-success
                        @else bg-secondary @endif">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Total Bayar:</strong>
                    Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                </p>
            </div>

            <hr>

            {{-- Detail Booking --}}
            <h5 class="fw-bold text-secondary mb-3">Informasi Booking</h5>
            <div>
                <p class="mb-1"><strong>Nama Anak:</strong> {{ $booking->child->name }}</p>
                <p class="mb-1"><strong>Usia:</strong> {{ $booking->child->age }} tahun</p>
                <p class="mb-1"><strong>Tanggal:</strong> {{  date('d M Y', strtotime($booking->booking_date)) }}</p>
                <p class="mb-1"><strong>Tipe Waktu Penitipan:</strong>
                    @if($booking->time_type === 'per_jam')
                    {{ $booking->duration}} Jam
                    @elseif($booking->time_type === 'per_hari')
                    Sehari
                    @elseif($booking->time_type === 'per_bulan')
                    Sebulan
                    @endif
                </Sehari>

                @if($booking->notes)
                <p class="mb-1"><strong>Catatan:</strong> {{ $booking->notes }}</p>
                @endif

                @if($booking->child->photo)
                <div class="text-center mt-3">
                    <img src="{{ Storage::url($booking->child->photo) }}" alt="Foto Anak"
                        class="img-thumbnail rounded-3" style="max-width: 140px;">
                </div>
                @endif
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('parent.transaction.index') }}" class="btn btn-primary rounded-pill px-4 py-2">
                    <i class="bi bi-arrow-left-circle"></i> Kembali ke Riwayat
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
