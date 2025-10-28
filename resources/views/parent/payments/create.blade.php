<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Card Detail Booking --}}
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">💳 Pembayaran Booking</h5>
                    </div>
                    <div class="card-body">
                        {{-- Data Booking dari Controller --}}
                        <div class="mb-3">
                            <strong>Nama Anak:</strong> {{ $booking->child->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Layanan:</strong>
                            {{ ucfirst(str_replace('_', ' ', $booking->service_type)) }}
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal:</strong>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}
                        </div>
                        <div class="mb-3">
                            <strong>Durasi:</strong>
                            {{ $booking->duration_hours >= 24
                                ? floor($booking->duration_hours / 24).' Hari '.($booking->duration_hours % 24).' Jam'
                                : $booking->duration_hours.' Jam' }}
                        </div>
                        <div class="mb-3">
                            <strong>Total Pembayaran:</strong>
                            <span class="text-success fw-bold">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Form Metode Pembayaran --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-bold">Pilih Metode Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('parent.payments.store') }}" method="POST">
                            @csrf

                            {{-- Kirim booking_id --}}
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                            {{-- Metode Pembayaran --}}
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-select" required>
                                    <option value="" selected disabled>Pilih metode...</option>
                                    <option value="transfer_bank">Transfer Bank</option>
                                    <option value="qris">QRIS</option>
                                    <option value="cash">Bayar di Tempat</option>
                                </select>
                            </div>

                            {{-- Catatan (opsional) --}}
                            <div class="mb-3">
                                <label for="notes" class="form-label">Catatan (Opsional)</label>
                                <textarea name="notes" id="notes" rows="3" class="form-control"
                                    placeholder="Contoh: mohon disiapkan saat antar anak..."></textarea>
                            </div>

                            {{-- Tombol --}}
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('parent.booking.index') }}"
                                    class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
