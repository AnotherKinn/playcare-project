<x-app-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-primary">
                <i class="bi bi-calendar-check"></i> Daftar Booking Penitipan
            </h4>
            <a href="{{ route('parent.booking.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Booking
            </a>
        </div>

        {{-- ✅ Alert sukses --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- =======================
            💻 Tampilan Desktop
        ======================== --}}
        <div class="card shadow-sm d-none d-md-block">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Tanggal Booking</th>
                            <th>Tipe Waktu</th>
                            <th>Durasi</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $key => $booking)
                        @php
                        $statusMap = [
                        'pending' => ['label' => 'Menunggu Persetujuan', 'color' => 'warning text-dark'],
                        'approved' => ['label' => 'Disetujui Admin', 'color' => 'info text-dark'],
                        'assigned' => ['label' => 'Ditugaskan ke Staff', 'color' => 'primary'],
                        'in_progress' => ['label' => 'Sedang Dikerjakan', 'color' => 'warning text-dark'],
                        'completed' => ['label' => 'Selesai', 'color' => 'success'],
                        'cancelled' => ['label' => 'Dibatalkan', 'color' => 'danger'],
                        ];

                        $status = $statusMap[$booking->status] ?? ['label' => ucfirst($booking->status), 'color' =>
                        'secondary'];

                        // Hitung durasi berdasarkan tipe waktu
                        if ($booking->time_type === 'per_jam') {
                        $durasi = $booking->duration . ' Jam';
                        } elseif ($booking->time_type === 'per_hari') {
                        $durasi = '24 Jam';
                        } elseif ($booking->time_type === 'per_bulan') {
                        $durasi = '30 Hari';
                        } else {
                        $durasi = '-';
                        }
                        @endphp

                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $booking->child->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ $booking->timeType->name ?? ucfirst(str_replace('_', ' ', $booking->time_type)) }}
                            </td>
                            <td>{{ $durasi }}</td>
                            <td>Rp{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $status['color'] }}">
                                    {{ $status['label'] }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('parent.booking.edit', $booking->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('parent.booking.destroy', $booking->id) }}" method="POST"
                                    class="d-inline" data-confirm="true">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data booking.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- =======================
            📱 Tampilan Mobile
        ======================== --}}
        <div class="d-block d-md-none">
            @forelse ($bookings as $booking)
            @php
            $statusMap = [
            'pending' => ['label' => 'Menunggu Persetujuan', 'color' => 'warning text-dark'],
            'approved' => ['label' => 'Disetujui Admin', 'color' => 'info text-dark'],
            'assigned' => ['label' => 'Ditugaskan ke Staff', 'color' => 'primary'],
            'in_progress' => ['label' => 'Sedang Dikerjakan', 'color' => 'secondary'],
            'completed' => ['label' => 'Selesai', 'color' => 'success'],
            'cancelled' => ['label' => 'Dibatalkan', 'color' => 'danger'],
            ];

            $status = $statusMap[$booking->status] ?? ['label' => ucfirst($booking->status), 'color' => 'secondary'];

            // Durasi versi mobile juga sama
            if ($booking->time_type === 'per_jam') {
            $durasi = $booking->duration . ' Jam';
            } elseif ($booking->time_type === 'per_hari') {
            $durasi = '24 Jam';
            } elseif ($booking->time_type === 'per_bulan') {
            $durasi = '30 Hari';
            } else {
            $durasi = '-';
            }
            @endphp

            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-1">{{ $booking->child->name ?? '-' }}</h5>
                    <p class="mb-1">
                        <i class="bi bi-calendar-event"></i>
                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                    </p>
                    <p class="mb-1">
                        <i class="bi bi-gear"></i>
                        {{ $booking->timeType->name ?? ucfirst(str_replace('_', ' ', $booking->time_type)) }}
                        ({{ $durasi }})
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-cash"></i>
                        Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                    </p>

                    <span class="badge bg-{{ $status['color'] }} mb-2">{{ $status['label'] }}</span>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('parent.booking.edit', $booking->id) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('parent.booking.destroy', $booking->id) }}" method="POST"
                            data-confirm="true" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-muted py-4">
                Belum ada data booking.
            </div>
            @endforelse
        </div>
        {{-- Pagination --}}
        <div class="mt-3">
            {{ $bookings->withQueryString()->links() }}
        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ✅ Notifikasi Sukses --}}
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1800
        });

    </script>
    @endif

    {{-- ⚠️ Konfirmasi Hapus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('form[data-confirm]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin mau hapus?',
                        text: 'Data booking ini akan dihapus permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });

    </script>
</x-app-layout>
