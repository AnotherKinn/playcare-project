<x-app-layout>
    <div class="d-flex">
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary mb-0">🛠️ Edit Review</h4>
                <a href="{{ route('parent.review.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <form action="{{ route('parent.review.update', $review->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori Feedback</label>
                            <select name="feedback_category" class="form-select" required>
                                <option value="Pelayanan"
                                    {{ $review->feedback_category == 'Pelayanan' ? 'selected' : '' }}>Pelayanan</option>
                                <option value="Kebersihan"
                                    {{ $review->feedback_category == 'Kebersihan' ? 'selected' : '' }}>Kebersihan
                                </option>
                                <option value="Keamanan"
                                    {{ $review->feedback_category == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                                <option value="Kenyamanan"
                                    {{ $review->feedback_category == 'Kenyamanan' ? 'selected' : '' }}>Kenyamanan
                                </option>
                                <option value="Fasilitas"
                                    {{ $review->feedback_category == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rating</label>
                            <select name="rating" class="form-select" required>
                                @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                    {{ str_repeat('⭐', $i) }} ({{ $i }})
                                </option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Komentar</label>
                            <textarea name="comment" class="form-control" rows="4"
                                required>{{ $review->comment }}</textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
