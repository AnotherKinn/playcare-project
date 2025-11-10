{{-- components/notifications/booking-cancelled-notification.blade.php --}}
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">
        <h5 class="fw-bold text-danger mb-3">
            <i class="bi bi-x-circle-fill me-2"></i>Booking Ditolak 😔
        </h5>

        <p class="text-secondary mb-4">
            Mohon maaf, booking kamu untuk anak
            <strong>{{ $notification->booking->child->name ?? 'Tidak diketahui' }}</strong>
            <strong>tidak dapat disetujui</strong>.
            Hal ini bisa terjadi karena bukti pembayaran belum diunggah, atau data pembayaran tidak valid.
            Kamu bisa mencoba kembali dengan memastikan bukti pembayaran sudah lengkap dan benar ya 🙏
        </p>

        <div class="d-flex gap-2">
            <a href="{{ route('parent.payments.create', ['booking_id' => $notification->booking->id]) }}"
                class="btn btn-warning">
                🔁 Unggah Ulang Pembayaran
            </a>

            <form action="{{ route('parent.notifications.destroy', $notification->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">🗑️ Hapus Notifikasi</button>
            </form>
        </div>
    </div>
</div>
