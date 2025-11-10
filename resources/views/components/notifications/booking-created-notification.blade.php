<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="fw-bold text-primary mb-3">✅ Bukti Pembayaran Diterima</h5>

        <p class="text-secondary mb-3">
            Terima kasih telah mengunggah bukti pembayaran untuk booking di <strong>PlayCare</strong>! 💖
            Kami sudah menerima berkas pembayaran Anda dan saat ini sedang dalam proses <strong>verifikasi oleh admin</strong>.
            Mohon menunggu sebentar ya — kami akan mengabari Anda segera setelah pembayaran terkonfirmasi agar proses booking bisa dilanjutkan.
        </p>

        <div class="d-flex justify-content-start mt-4">
            <!-- Tombol Hapus Notifikasi -->
            <form action="{{ route('parent.notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">🗑️ Hapus Notifikasi</button>
            </form>
        </div>
    </div>
</div>
