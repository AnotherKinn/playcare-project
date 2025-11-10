<x-app-layout>
    <div class="container mt-4" x-data="{
        timeType: '{{ $booking->time_type }}'
    }">
        <h4 class="fw-bold text-primary mb-3">
            <i class="bi bi-pencil"></i> Edit Booking
        </h4>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('parent.booking.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- 🧒 Nama Anak --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Anak</label>
                        <select name="child_id" class="form-select" required>
                            @foreach($children as $child)
                                <option value="{{ $child->id }}"
                                    {{ $booking->child_id == $child->id ? 'selected' : '' }}>
                                    {{ $child->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 📅 Tanggal Booking --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Booking</label>
                        <input type="date" name="booking_date" class="form-control"
                            value="{{ $booking->booking_date }}" required>
                    </div>

                    {{-- ⏰ Tipe Waktu Penitipan --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tipe Waktu Penitipan</label>
                        <select name="time_type" class="form-select" x-model="timeType" required>
                            <option value="">-- Pilih Tipe Waktu --</option>
                            <option value="per_jam">Per Jam</option>
                            <option value="per_hari">Per Hari</option>
                            <option value="per_bulan">Per Bulan</option>
                        </select>
                    </div>

                    {{-- ⏱️ Durasi (muncul hanya kalau per_jam) --}}
                    <div class="mb-3" x-show="timeType === 'per_jam'" x-transition>
                        <label class="form-label fw-semibold">Durasi (Jam)</label>
                        <input type="number" name="duration" class="form-control"
                            value="{{ $booking->duration }}" min="1">
                        <small class="text-muted">Masukkan berapa jam penitipan yang diinginkan.</small>
                    </div>

                    {{-- 📝 Catatan Tambahan --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Tambahan</label>
                        <textarea name="notes" class="form-control" rows="3"
                            placeholder="Tulis catatan jika ada...">{{ $booking->notes }}</textarea>
                    </div>

                    {{-- 🔘 Tombol Aksi --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('parent.booking.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Perbarui Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ✅ Tambahkan Alpine.js jika belum ada --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
