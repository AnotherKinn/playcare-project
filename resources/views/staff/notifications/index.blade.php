<x-app-layout>

    <div class="container py-4">
        <h4 class="fw-bold mb-4 text-primary">🔔 Notifikasi Staff</h4>

        @if($notifications->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada notifikasi untuk staff.
            </div>
        @else
            <div class="list-group shadow-sm rounded-3">

                @foreach($notifications as $notif)
                    <a href="{{ route('staff.notifications.show', $notif->id) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                        <div>
                            <div class="fw-semibold">
                                @switch($notif->type_notification)

                                    @case('assigned_staff')
                                        🧑‍💼 Kamu mendapat tugas baru dari admin.
                                        @break

                                    @default
                                        📢 Notifikasi baru untukmu.
                                @endswitch
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
