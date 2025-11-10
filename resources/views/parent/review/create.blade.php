<x-app-layout>
    <div class="d-flex">
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary mb-0">✍️ Tambah Review</h4>
                <a href="{{ route('parent.review.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <form action="{{ route('parent.review.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori Feedback</label>
                            <select name="feedback_category" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Pelayanan">Pelayanan</option>
                                <option value="Kebersihan">Kebersihan</option>
                                <option value="Keamanan">Keamanan</option>
                                <option value="Kenyamanan">Kenyamanan</option>
                                <option value="Fasilitas">Fasilitas</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rating</label>
                            <select name="rating" class="form-select" required>
                                <option value="">Pilih Rating</option>
                                @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ str_repeat('⭐', $i) }} ({{ $i }})</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Komentar</label>
                            <textarea name="comment" class="form-control" rows="4"
                                placeholder="Tulis ulasan Anda di sini..." required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Kirim Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
