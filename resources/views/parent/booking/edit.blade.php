<x-app-layout>
    <div class="container mt-4">
        <h4 class="fw-bold text-primary mb-3"><i class="bi bi-pencil"></i> Edit Booking</h4>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('parent.booking.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Anak</label>
                        <select name="child_id" class="form-select" required>
                            @foreach($children as $child)
                                <option value="{{ $child->id }}" {{ $booking->child_id == $child->id ? 'selected' : '' }}>
                                    {{ $child->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Booking</label>
                        <input type="date" name="booking_date" class="form-control" value="{{ $booking->booking_date }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Layanan</label>
                        <select name="service_type" class="form-select" required>
                            <option value="full_day" {{ $booking->service_type == 'full_day' ? 'selected' : '' }}>Full Day Care</option>
                            <option value="half_day" {{ $booking->service_type == 'half_day' ? 'selected' : '' }}>Half Day</option>
                            <option value="playground" {{ $booking->service_type == 'playground' ? 'selected' : '' }}>Playground</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Durasi (Jam)</label>
                        <input type="number" name="duration_hours" class="form-control" value="{{ $booking->duration_hours }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="notes" class="form-control" rows="3">{{ $booking->notes }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('parent.booking.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Perbarui Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
