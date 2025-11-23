{{-- resources/views/admin/notifications/types/report_child.blade.php --}}
<x-app-layout>

    <div class="container py-4">

        <div class="card shadow-sm border-0 rounded-3 p-4">

            <h4 class="fw-bold text-primary mb-3">🧸 Laporan Anak dari Staff</h4>

            {{-- Info dasar laporan --}}
            <p class="mb-3">
                Staff <strong>{{ $notification->user->name }}</strong> telah mengirim laporan kondisi anak.
            </p>

            @php
                // Cari laporan berdasarkan booking_id dan staff_id
                $report = \App\Models\Report::where('booking_id', $notification->booking_id)
                    ->where('staff_id', $notification->user_id)
                    ->latest()
                    ->first();
            @endphp

            @if($report)

                <div class="mt-3">
                    <h5 class="fw-bold text-secondary mb-3">📄 Detail Laporan</h5>

                    <p><strong>Nama Anak:</strong> {{ $report->child->name }}</p>
                    <p><strong>Tanggal Booking:</strong> {{ $report->booking->booking_date->format('d M Y') }}</p>

                    <hr>

                    <p><strong>Aktivitas:</strong><br>{{ $report->activities }}</p>

                    @if($report->meals)
                        <p><strong>Makanan:</strong><br>{{ $report->meals }}</p>
                    @endif

                    @if($report->sleep)
                        <p><strong>Tidur:</strong><br>{{ $report->sleep }}</p>
                    @endif

                    @if($report->notes)
                        <p><strong>Catatan Tambahan:</strong><br>{{ $report->notes }}</p>
                    @endif

                    @if($report->photo)
                        <div class="mt-3">
                            <strong>Foto Laporan:</strong><br>
                            <img src="{{ asset('storage/' . $report->photo) }}"
                                 class="img-fluid rounded mt-2 shadow-sm"
                                 style="max-width: 300px;">
                        </div>
                    @endif
                </div>

                <div class="d-flex mt-4 gap-2">

                    {{-- tombol untuk lihat booking --}}
                    <a href="{{ route('admin.booking.show', $report->booking->id) }}"
                       class="btn btn-primary">
                        📘 Lihat Booking
                    </a>

                    {{-- tombol lihat semua laporan anak --}}
                    <a href="{{ route('admin.report.index') }}"
                       class="btn btn-outline-secondary">
                        📂 Semua Laporan Anak
                    </a>

                </div>

            @else

                <div class="alert alert-warning mt-3">
                    Laporan tidak ditemukan. Mungkin staff belum mengirim laporan lengkap.
                </div>

            @endif

        </div>

    </div>

</x-app-layout>
