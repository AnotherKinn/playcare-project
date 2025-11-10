<x-app-layout>
    <div class="container py-4">
        <h4 class="fw-bold text-primary mb-4">💳 Upload Bukti Pembayaran</h4>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <p class="text-secondary mb-4">
                    Silakan unggah bukti pembayaran untuk transaksi dengan kode:
                    <strong>{{ $transaction->transaction_code ?? 'Tidak Diketahui' }}</strong>
                </p>

                <form action="{{ route('parent.transaction.upload.store', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="payment_proof" class="form-label fw-semibold">Pilih Gambar Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" id="payment_proof" class="form-control @error('payment_proof') is-invalid @enderror" required>

                        @error('payment_proof')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            🚀 Kirim Bukti Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
