<x-app-layout>
    <div class="container mt-4" x-data="{ timeType: 'per_jam' }">
        <h4 class="fw-bold text-primary mb-3"><i class="bi bi-plus-circle"></i> Tambah Booking Anak</h4>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('parent.booking.store') }}" method="POST">
                    @csrf
                    {{-- 🧒 Pilih Anak --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Anak</label>
                        <select name="child_id" class="form-select" required>
                            <option value="">-- Pilih Anak --</option>
                            @foreach($children as $child)
                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 📅 Tanggal Booking --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Booking</label>
                        <input type="date" name="booking_date" class="form-control" required>
                    </div>

                    {{-- ⏱️ Tipe Waktu Penitipan --}}
                    <div class="mb-3">
                        <label class="form-label">Tipe Waktu Penitipan</label>
                        <select name="time_type" class="form-select" x-model="timeType" required>
                            <option value="per_jam">Per Jam</option>
                            <option value="per_hari">Per Hari</option>
                            <option value="per_bulan">Per Bulan</option>
                        </select>
                    </div>

                    {{-- ⌛ Input Durasi (muncul hanya jika per_jam) --}}
                    <div class="mb-3" x-show="timeType === 'per_jam'" x-transition>
                        <label class="form-label">Durasi (Jam)</label>
                        <input type="number" name="duration" min="1" class="form-control" placeholder="Masukkan durasi jam penitipan">
                    </div>

                    {{-- 📝 Catatan --}}
                    <div class="mb-3">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Opsional"></textarea>
                    </div>

                    {{-- 🎯 Tombol Aksi --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('parent.booking.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ✅ Tambahkan AlpineJS --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>
