<x-app-layout>
    <div class="container py-4">
        <div class="card border-0 shadow-soft-card rounded-4">
            <div class="card-body p-4 p-md-5">

                <!-- Header -->
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 48px; height: 48px; background-color: rgba(220, 53, 69, 0.12);">
                        <i class="bi bi-x-circle-fill fs-4 text-danger"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-danger">Booking Ditolak 😔</h5>
                        <small class="text-muted">Diperbarui {{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </div>

                <!-- Konten -->
                <div class="mt-3" style="font-family: 'Poppins', sans-serif;">
                    <p class="text-secondary mb-4 lh-lg">
                        Mohon maaf, booking kamu untuk anak
                        <strong>{{ $notification->booking->child->name ?? 'Tidak diketahui' }}</strong>
                        <strong>tidak dapat disetujui</strong>. 😢
                        Hal ini bisa terjadi karena bukti pembayaran belum diunggah, atau data pembayaran tidak valid.
                        Kamu bisa mencoba kembali dengan memastikan bukti pembayaran sudah lengkap dan benar ya 🙏
                    </p>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <a href="{{ route('parent.payments.create', ['booking_id' => $notification->booking->id]) }}"
                        class="btn fw-semibold shadow-sm text-white"
                        style="background-color: #f4a836; border-radius: 12px; transition: 0.3s;">
                        🔁 Unggah Ulang Pembayaran
                    </a>

                    <form action="{{ route('parent.notifications.destroy', $notification->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger fw-semibold rounded-3 shadow-sm">
                            🗑️ Hapus Notifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS tambahan -->
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }

        .btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(43, 190, 198, 0.15);
        }
    </style>
</x-app-layout>
