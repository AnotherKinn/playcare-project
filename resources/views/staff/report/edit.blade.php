<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-secondary mb-4">✏️ Edit Laporan</h3>

        <form action="{{ route('staff.report.update', $report->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="meals" class="form-label">Kegiatan Makan</label>
                <textarea name="meals" id="meals" class="form-control" rows="2">{{ $report->meals }}</textarea>
            </div>

            <div class="mb-3">
                <label for="sleep" class="form-label">Kegiatan Tidur</label>
                <textarea name="sleep" id="sleep" class="form-control" rows="2">{{ $report->sleep }}</textarea>
            </div>

            <div class="mb-3">
                <label for="activities" class="form-label">Aktivitas</label>
                <textarea name="activities" id="activities" class="form-control" rows="3" required>{{ $report->activities }}</textarea>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea name="notes" id="notes" class="form-control" rows="2">{{ $report->notes }}</textarea>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Ganti Foto (Opsional)</label>
                <input type="file" class="form-control" name="photo" id="photo" accept="image/*">

                @if ($report->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $report->photo) }}" width="120" class="rounded shadow-sm">
                    </div>
                @endif
            </div>

            <div class="text-end">
                <a href="{{ route('staff.report.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>
