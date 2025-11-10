<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold text-primary mb-3">📦 Booking Baru Menunggu Verifikasi</h5>

                <p>
                    Parent: <strong>{{ $notification->booking->parent->name ?? '-' }}</strong><br>
                    Kode Booking: <strong>#{{ $notification->booking->id }}</strong><br>
                    Status Booking: <span class="badge bg-warning text-dark">{{ $notification->booking->status }}</span><br>
                    Status Transaksi: <span class="badge bg-info text-dark">{{ $notification->transaction->status ?? '-' }}</span>
                </p>

                <p class="text-muted mt-3">
                    Mohon lakukan verifikasi pembayaran pada booking ini. Klik tombol di bawah untuk melihat detailnya.
                </p>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.booking.index') }}" class="btn btn-primary">
                        <i class="bi bi-eye me-2"></i> Lihat Detail Booking
                    </a>

                    <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">
                            <i class="bi bi-trash me-2"></i> Hapus Notifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
