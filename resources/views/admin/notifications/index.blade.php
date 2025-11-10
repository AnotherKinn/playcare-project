<x-app-layout>
    <div class="container py-4">
        <h4 class="fw-bold mb-4 text-primary">🔔 Notifikasi Admin</h4>

        @if ($notifications->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada notifikasi masuk.
            </div>
        @else
            <div class="list-group shadow-sm rounded-3">
                @foreach ($notifications as $notif)
                    @php
                        $booking = $notif->booking;
                        $transaction = $notif->transaction;
                    @endphp

                    {{-- 💳 Notifikasi Booking Baru --}}
                    @if (
                        $notif->type_notification === 'booking_created' &&
                        $booking &&
                        $transaction &&
                        $booking->status === 'pending' &&
                        $transaction->status === 'pending_verification'
                    )
                        <a href="{{ route('admin.notifications.show', $notif->id) }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">
                                    Ada <strong>booking baru</strong> menunggu verifikasi pembayaran.
                                </div>
                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>
                    @endif

                    {{-- ✅ / ❌ Notifikasi Hasil Verifikasi Booking --}}
                    @if ($notif->type_notification === 'information' && $booking)
                        @if ($booking->status === 'approved')
                            <a href="{{ route('admin.notifications.show', $notif->id) }}"
                                class="list-group-item list-group-item-action border-success bg-light-success d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold text-success">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        Booking <strong>disetujui</strong> untuk anak
                                        <strong>{{ $booking->child->name ?? 'Tidak diketahui' }}</strong>.
                                    </div>
                                    <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                </div>
                                <i class="bi bi-chevron-right text-success"></i>
                            </a>
                        @elseif ($booking->status === 'cancelled')
                            <a href="{{ route('admin.notifications.show', $notif->id) }}"
                                class="list-group-item list-group-item-action border-danger bg-light-danger d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold text-danger">
                                        <i class="bi bi-x-circle-fill me-2"></i>
                                        Booking <strong>ditolak</strong> untuk anak
                                        <strong>{{ $booking->child->name ?? 'Tidak diketahui' }}</strong>.
                                    </div>
                                    <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                </div>
                                <i class="bi bi-chevron-right text-danger"></i>
                            </a>
                        @endif
                    @endif

                    {{-- 🧸 Notifikasi Laporan Anak --}}
                    @if ($notif->type_notification === 'report_child')
                        <a href="{{ route('admin.notifications.show', $notif->id) }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">
                                    Staff mengirim <strong>laporan kondisi anak</strong>.
                                </div>
                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>
                    @endif

                    {{-- 🏁 Notifikasi Anak Siap Dijemput --}}
                    @if ($notif->type_notification === 'pick_up_children')
                        <a href="{{ route('admin.notifications.show', $notif->id) }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">
                                    Booking telah selesai, anak siap dijemput.
                                </div>
                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>
                    @endif

                    {{-- ⭐ Notifikasi Ulasan --}}
                    @if ($notif->type_notification === 'review_parent')
                        <a href="{{ route('admin.notifications.show', $notif->id) }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">
                                    Parent mengirimkan <strong>ulasan layanan</strong>.
                                </div>
                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
