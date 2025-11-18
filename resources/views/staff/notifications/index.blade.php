<x-app-layout>
    <div class="container py-4">
        <h4 class="fw-bold mb-4 text-primary">🔔 Notifikasi Staff</h4>

        @php
            // Dummy data sementara
            $notifications = [
                (object)[
                    'id' => 1,
                    'type_notification' => 'new_booking',
                    'message' => 'Ada booking baru yang membutuhkan penugasan.',
                    'created_at' => now()->subMinutes(15)
                ],
                (object)[
                    'id' => 2,
                    'type_notification' => 'child_report_request',
                    'message' => 'Kamu diminta mengisi laporan perkembangan anak.',
                    'created_at' => now()->subHours(2)
                ],
                (object)[
                    'id' => 3,
                    'type_notification' => 'schedule_update',
                    'message' => 'Jadwal kerjamu telah diperbarui.',
                    'created_at' => now()->subDay()
                ]
            ];
        @endphp

        @if(empty($notifications))
            <div class="alert alert-info text-center">
                Belum ada notifikasi untuk staff.
            </div>
        @else
            <div class="list-group shadow-sm rounded-3">

                @foreach($notifications as $notif)
                    <a href="#"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                        <div>
                            <div class="fw-semibold">

                                {{-- === LOGIKA DUMMY UNTUK MENENTUKAN PESAN BERDASARKAN TYPE === --}}
                                @if ($notif->type_notification === 'new_booking')
                                    🆕 Ada booking baru yang menunggu tindakan kamu.
                                @elseif ($notif->type_notification === 'child_report_request')
                                    📄 Kamu diminta mengisi laporan perkembangan anak.
                                @elseif ($notif->type_notification === 'schedule_update')
                                    🗓 Jadwal kerjamu sudah diperbarui oleh admin.
                                @else
                                    📢 Notifikasi baru untukmu. Silakan cek detailnya.
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
