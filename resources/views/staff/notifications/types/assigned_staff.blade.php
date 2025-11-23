<x-app-layout>

    <div class="container py-4">

        <div class="card shadow-sm border-0 rounded-3 p-4">

            <h4 class="fw-bold text-primary mb-3">🧑‍💼 Tugas Baru Untukmu</h4>

            @if($notification->type_notification === 'assigned_staff')
                <div class="mt-3">
                    <h6 class="fw-bold">Detail Booking:</h6>
                    <p>Tipe Waktu Penitipan :
                        @if($notification->booking->time_type === 'per_jam')
                        {{ $notification->booking->duration }} Jam
                        @elseif($notification->booking->time_type === 'per_hari')
                        Sehari
                        @elseif($notification->booking->time_type === 'per_bulan')
                        Sebulan
                        @endif
                    </p>
                    <p>Nama Anak: {{ $notification->booking->child->name }}</p>
                    <p>Tanggal Booking: {{  date('d M Y', strtotime($notification->booking->booking_date)) }}</p>
                    <p>Catatan : {{ ucfirst($notification->booking->notes) }}</p>
                    <a href="{{ route('staff.task.index') }}"
                       class="btn btn-primary mt-2">
                       Lihat Detail Booking
                    </a>
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
