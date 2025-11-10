<x-app-layout>
    <div class="container py-4">
        <h4 class="fw-bold mb-4 text-primary">🔔 Notifikasi</h4>

        @if($notifications->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada notifikasi.
        </div>
        @else
        <div class="list-group shadow-sm rounded-3">
            @foreach($notifications as $notif)
            <a href="{{ route('parent.notifications.show', $notif->id) }}"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-semibold">
                        @if ($notif->type_notification === 'information' && $notif->booking)
                        @if ($notif->booking->status === 'approved')
                        🎉 Selamat! Booking kamu telah disetujui oleh admin.
                        @elseif ($notif->booking->status === 'cancelled')
                        ❌ Maaf, booking kamu ditolak oleh admin.
                        @else
                        ℹ️ Booking sedang dalam proses verifikasi, mohon tunggu ya.
                        @endif
                        @elseif ($notif->type_notification === 'booking_created')
                        Bukti pembayaran berhasil diunggah, menunggu verifikasi admin.
                        @elseif ($notif->type_notification === 'assigned_staff')
                        Staff telah ditugaskan untuk booking kamu.
                        @elseif ($notif->type_notification === 'report_child')
                        Laporan anak telah dikirim oleh staff.
                        @elseif ($notif->type_notification === 'pick_up_children')
                        Anak telah dijemput oleh staff.
                        @elseif ($notif->type_notification === 'review_parent')
                        Silakan berikan ulasan untuk staff.
                        @elseif ($notif->type_notification === 'greeting')
                        Hai! Semoga harimu menyenangkan 😊
                        @else
                        📢 Notifikasi baru tersedia. Silakan cek detailnya.
                        @endif
                    </div>

                    <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                </div>

                <i class="bi bi-chevron-right text-muted"></i>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>
