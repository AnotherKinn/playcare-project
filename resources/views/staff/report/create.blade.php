<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">➕ Tambah Laporan Aktivitas</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                <form>
                    {{-- Pilih Booking --}}
                    <div class="mb-3">
                        <label for="booking" class="form-label fw-semibold">Pilih Booking (Selesai)</label>
                        <select id="booking" class="form-select" required>
                            <option value="">-- Pilih Booking --</option>
                            <option value="1">Alya - Playground (Completed)</option>
                            <option value="2">Rafi - Full Day Care (Completed)</option>
                        </select>
                    </div>

                    {{-- Aktivitas --}}
                    <div class="mb-3">
                        <label for="aktivitas" class="form-label fw-semibold">Aktivitas</label>
                        <textarea id="aktivitas" class="form-control" rows="4" placeholder="Tulis deskripsi aktivitas anak..." required></textarea>
                    </div>

                    {{-- Kondisi Anak --}}
                    <div class="mb-3">
                        <label for="kondisi" class="form-label fw-semibold">Kondisi Anak</label>
                        <select id="kondisi" class="form-select" required>
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="Baik">Baik</option>
                            <option value="Rewel">Rewel</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                    </div>

                    {{-- Upload Foto --}}
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">Upload Foto (Opsional)</label>
                        <input type="file" class="form-control" id="foto" accept="image/*">
                    </div>

                    {{-- Tombol --}}
                    <div class="text-end">
                        <a href="{{ route('staff.laporan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
