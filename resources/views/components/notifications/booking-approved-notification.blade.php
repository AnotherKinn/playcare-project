{{-- components/notifications/booking-approved-notification.blade.php --}}
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">
        <h5 class="fw-bold text-success mb-3">
            <i class="bi bi-check-circle-fill me-2"></i>Booking Disetujui 🎉
        </h5>

        <p class="text-secondary mb-4">
            Selamat! Booking kamu untuk anak
            <strong>{{ $notification->booking->child->name ?? 'Tidak diketahui' }}</strong>
            telah <strong>disetujui oleh admin</strong>.
            Terima kasih sudah mempercayakan layanan <strong>PlayCare</strong>! 💖
            Kami akan segera memberikan laporan harian anak agar kamu bisa memantau aktivitasnya dengan tenang.
        </p>

        <div class="d-flex gap-2">
            <a href="#" class="btn btn-success">
                📄 Lihat Laporan Anak
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
