<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold text-primary mb-3">📝 Review Baru dari Parent</h5>

                {{-- Paragraf pembuka --}}
                <p class="text-muted">
                    Seorang parent baru saja memberikan review terhadap layanan yang telah digunakan.
                    Silakan cek detail review di bawah ini untuk melihat penilaian dan masukan yang mereka berikan.
                </p>

                {{-- Detail Review --}}
                <p>
                    Parent: <strong>{{ $notification->review->parent->name ?? '-' }}</strong><br>
                    {{-- Kode Booking: <strong>#{{ $notification->review->booking->id ?? '-' }}</strong><br> --}}
                    Kategori Feedback:
                    <span class="badge bg-info text-dark">{{ ucfirst($notification->review->feedback_category ?? '-') }}</span><br>
                    Rating:
                    <span class="fw-bold text-warning">
                        ⭐ {{ $notification->review->rating ?? '0' }}/5
                    </span><br>
                    Komentar:
                    <em>"{{ $notification->review->comment ?? '-' }}"</em>
                </p>

                <p class="text-muted mt-3">
                    Ulasan dari parent sangat membantu untuk meningkatkan kualitas pelayanan.
                    Klik tombol di bawah ini untuk melihat detail lengkap review.
                </p>

                <div class="d-flex gap-2 mt-4">
                    {{-- Tombol lihat detail review --}}
                    <a href="{{ route('admin.report.parent-review') }}" class="btn btn-primary">
                        <i class="bi bi-eye me-2"></i> Lihat Detail Review
                    </a>

                    {{-- Tombol hapus notifikasi --}}
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
