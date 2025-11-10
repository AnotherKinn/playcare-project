<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="fw-bold text-primary mb-3">📢 Informasi Pembayaran</h5>

        <p class="text-secondary mb-3">
            Terima kasih telah melakukan booking di <strong>PlayCare</strong>! 🥰
            Kami sangat menghargai kepercayaan Anda kepada layanan kami.
            Demi kenyamanan bersama, kami mohon Anda segera melakukan konfirmasi pembayaran agar proses booking dapat diproses lebih lanjut.
        </p>

        <p class="text-secondary">
            Silakan unggah <strong>bukti pembayaran</strong> Anda melalui tombol di bawah ini.
            Tim kami akan segera melakukan verifikasi setelah Anda mengirimkannya.
        </p>

        <div class="d-flex justify-content-start mt-4 gap-2">
            <!-- Tombol Upload Bukti Pembayaran -->
            <a href="{{ route('parent.transaction.upload', $notification->transaction_id ?? 0) }}" class="btn btn-success">
                💳 Upload Bukti Pembayaran
            </a>

            <!-- Tombol Hapus Notifikasi -->
            <form action="{{ route('parent.notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">🗑️ Hapus Notifikasi</button>
            </form>
        </div>
    </div>
</div>
