<x-app-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-primary">
                <i class="bi bi-calendar-check"></i> Daftar Booking Layanan
            </h4>
            <a href="{{ route('parent.booking.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Booking
            </a>
        </div>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card shadow-sm d-none d-md-block">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Tanggal Booking</th>
                            <th>Layanan</th>
                            <th>Durasi</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $key => $booking)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $booking->child->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $booking->service_type)) }}</td>
                            <td>{{ $booking->duration_hours }} Jam</td>
                            <td>Rp{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $booking->status == 'menunggu' ? 'warning text-dark' : ($booking->status == 'disetujui' ? 'success' : 'danger') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('parent.booking.edit', $booking->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('parent.booking.destroy', $booking->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Yakin mau hapus?')">
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
            📱 Tampilan Card (Mobile)
        ======================== --}}
        <div class="d-block d-md-none">
            {{-- Card 1 --}}
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-1">Budi</h5>
                    <p class="mb-1"><i class="bi bi-calendar-event"></i> 25 Okt 2025</p>
                    <p class="mb-1"><i class="bi bi-gear"></i> Full Day Care (8 Jam)</p>
                    <p class="mb-2"><i class="bi bi-cash"></i> Rp150.000</p>
                    <span class="badge bg-warning text-dark mb-2">Menunggu</span>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('parent.booking.edit', 1) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-1">Sinta</h5>
                    <p class="mb-1"><i class="bi bi-calendar-event"></i> 20 Okt 2025</p>
                    <p class="mb-1"><i class="bi bi-gear"></i> Half Day (4 Jam)</p>
                    <p class="mb-2"><i class="bi bi-cash"></i> Rp90.000</p>
                    <span class="badge bg-success mb-2">Disetujui</span>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('parent.booking.edit', 2) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
