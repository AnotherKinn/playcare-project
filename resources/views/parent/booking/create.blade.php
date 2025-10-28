<x-app-layout>
    <div class="container mt-4">
        <h4 class="fw-bold text-primary mb-3"><i class="bi bi-plus-circle"></i> Tambah Booking Anak</h4>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('parent.booking.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Anak</label>
                        <select name="child_id" class="form-select" required>
                            <option value="">-- Pilih Anak --</option>
                            @foreach($children as $child)
                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Booking</label>
                        <input type="date" name="booking_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Layanan</label>
                        <select name="service_type" class="form-select" required>
                            <option value="full_day">Full Day Care</option>
                            <option value="half_day">Half Day</option>
                            <option value="playground">Playground</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Durasi (Jam)</label>
                        <input type="number" name="duration_hours" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('parent.booking.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
