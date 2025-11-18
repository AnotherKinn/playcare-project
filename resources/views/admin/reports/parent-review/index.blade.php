<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-purple mb-4">📝 Laporan Review Parent</h3>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h6 class="text-muted mb-1">Total Review</h6>
                    <h4 class="fw-bold">{{ $reviews->count() }}</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h6 class="text-muted mb-1">Rata-rata Rating</h6>
                    <h4 class="fw-bold">
                        {{ number_format($reviews->avg('rating'), 1) ?? 0 }} ⭐
                    </h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h6 class="text-muted mb-1">Review Terbaru</h6>
                    <h4 class="fw-bold">
                        {{ $reviews->first()?->parent?->name ?? '-' }}
                    </h4>
                </div>
            </div>
        </div>


        <!-- Desktop Table -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Orang Tua</th>
                        <th>Kategori Feedback</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $index => $review)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $review->parent?->name ?? '-' }}</td>
                        <td>{{ $review->feedback_category ?? '-' }}</td>
                        <td>{{ $review->rating }} ⭐</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada review dari parent.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card -->
        <div class="d-block d-md-none">
            @forelse($reviews as $index => $review)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">#{{ $index + 1 }}</h5>
                    <p class="mb-1"><strong>Parent:</strong> {{ $review->parent?->name ?? '-' }}</p>
                    <p class="mb-1"><strong>Rating:</strong> {{ $review->rating }} ⭐</p>
                    <p class="mb-1"><strong>Review:</strong> {{ $review->comment }}</p>
                    <p class="mb-0"><strong>Tanggal:</strong> {{ $review->created_at->format('d M Y') }}</p>
                </div>
            </div>
            @empty
            <div class="alert alert-warning">Belum ada review dari parent.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
