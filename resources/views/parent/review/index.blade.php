<x-app-layout>
    <div class="d-flex">
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary mb-0">⭐ Review Layanan</h4>
                <a href="{{ route('parent.review.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Review
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($reviews->isEmpty())
                <div class="text-center text-muted mt-5">
                    <i class="bi bi-chat-square-text fs-1 d-block mb-3"></i>
                    <p>Belum ada review yang kamu tulis.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($reviews as $review)
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <h5 class="fw-bold text-primary mb-2">
                                        {{ ucfirst(str_replace('_', ' ', $review->feedback_category)) }}
                                    </h5>
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-calendar"></i> {{ $review->created_at->translatedFormat('d F Y') }}
                                    </p>
                                    <p class="mb-2">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endfor
                                        @for ($i = $review->rating; $i < 5; $i++)
                                            <i class="bi bi-star text-warning"></i>
                                        @endfor
                                    </p>
                                    <p class="text-secondary">{{ $review->comment }}</p>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('parent.review.edit', $review->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                         <form action="{{ route('parent.review.destroy', $review->id) }}" method="POST"
                                        class="d-inline" data-confirm="true">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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

    {{-- ⚠️ Konfirmasi Hapus Data --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('form[data-confirm]');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Yakin mau hapus?',
                        text: 'Data anak ini akan dihapus secara permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });

    </script>
</x-app-layout>
