<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-purple mb-4">📝 Laporan Review Parent</h3>

        @php
            $dummyReviews = [
                ['parent'=>'Sari', 'anak'=>'Alya', 'rating'=>5, 'review'=>'Sangat puas', 'catatan_admin'=>'-'],
                ['parent'=>'Budi', 'anak'=>'Bimo', 'rating'=>4, 'review'=>'Cukup baik', 'catatan_admin'=>'Perlu peningkatan komunikasi'],
                ['parent'=>'Tina', 'anak'=>'Daffa', 'rating'=>5, 'review'=>'Pelayanan ramah', 'catatan_admin'=>'-'],
                ['parent'=>'Rani', 'anak'=>'Eka', 'rating'=>3, 'review'=>'Kurang intensif', 'catatan_admin'=>'Perlu evaluasi'],
            ];
        @endphp

        <!-- Desktop Table -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Parent</th>
                        <th>Anak</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Catatan Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dummyReviews as $index => $review)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $review['parent'] }}</td>
                            <td>{{ $review['anak'] }}</td>
                            <td>{{ $review['rating'] }}</td>
                            <td>{{ $review['review'] }}</td>
                            <td>{{ $review['catatan_admin'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card -->
        <div class="d-block d-md-none">
            @foreach($dummyReviews as $index => $review)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">#{{ $index + 1 }} {{ $review['anak'] }}</h5>
                        <p class="mb-1"><strong>Parent:</strong> {{ $review['parent'] }}</p>
                        <p class="mb-1"><strong>Rating:</strong> {{ $review['rating'] }} ⭐</p>
                        <p class="mb-1"><strong>Review:</strong> {{ $review['review'] }}</p>
                        <p class="mb-0"><strong>Catatan Admin:</strong> {{ $review['catatan_admin'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
