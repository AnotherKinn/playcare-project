<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">✏️ Edit Laporan Aktivitas</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                <form>
                    {{-- Booking (readonly karena tidak bisa diubah) --}}
                    <div class="mb-3">
                        <label for="booking" class="form-label fw-semibold">Booking</label>
                        <input type="text" id="booking" class="form-control" value="Alya - Playground (Completed)" readonly>
                    </div>

                    {{-- Aktivitas --}}
                    <div class="mb-3">
                        <label for="aktivitas" class="form-label fw-semibold">Aktivitas</label>
                        <textarea id="aktivitas" class="form-control" rows="4">Bermain balok dan menggambar bersama teman-teman.</textarea>
                    </div>

                    {{-- Kondisi Anak --}}
                    <div class="mb-3">
                        <label for="kondisi" class="form-label fw-semibold">Kondisi Anak</label>
                        <select id="kondisi" class="form-select">
                            <option value="Baik" selected>Baik</option>
                            <option value="Rewel">Rewel</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                    </div>

                    {{-- Foto --}}
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">Foto Aktivitas (Opsional)</label>
                        <input type="file" class="form-control" id="foto" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-end">
                        <a href="{{ route('staff.report.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
