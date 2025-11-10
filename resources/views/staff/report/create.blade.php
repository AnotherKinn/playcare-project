<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">➕ Tambah Laporan Aktivitas Anak</h3>

        <form action="{{ route('staff.report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Pilih Anak --}}
            <div class="mb-3">
                <label for="child_id" class="form-label">Pilih Anak yang Diasuh</label>
                <select name="child_id" id="child_id" class="form-select" required>
                    <option value="">-- Pilih Anak --</option>
                    @foreach ($children as $child)
                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Kegiatan Makan</label>
                <textarea name="meals" class="form-control" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kegiatan Tidur</label>
                <textarea name="sleep" class="form-control" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Aktivitas</label>
                <textarea name="activities" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="notes" class="form-control" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Foto</label>
                <input type="file" class="form-control" name="photo" accept="image/*">
            </div>

            <div class="text-end">
                <a href="{{ route('staff.report.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
