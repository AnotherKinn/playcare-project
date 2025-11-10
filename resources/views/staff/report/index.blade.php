<!-- resources/views/staff/laporan/index.blade.php -->
<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">📝 Laporan Aktivitas Anak</h3>

        {{-- Tombol Tambah Laporan --}}
        <div class="mb-3 text-end">
            <a href="{{ route('staff.report.create') }}" class="btn btn-primary">➕ Tambah Laporan</a>
        </div>

        {{-- Filter Anak --}}
        <div class="mb-3">
            <label for="filterAnak" class="form-label fw-semibold">Filter per Anak:</label>
            <select id="filterAnak" class="form-select" style="max-width: 300px;">
                <option value="">Semua Anak</option>
                @foreach ($children as $child)
                <option value="{{ $child->id }}">{{ $child->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Anak</th>
                        <th>Makan</th>
                        <th>Tidur</th>
                        <th>Aktivitas</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th>Status Verifikasi</th>
                        <th>Foto</th> {{-- dipindah ke sini --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $index => $report)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $report->child->name ?? '-' }}</td>
                        <td>{{ $report->meals ?? '-' }}</td>
                        <td>{{ $report->sleep ?? '-' }}</td>
                        <td>{{ Str::limit($report->activities, 50) }}</td>
                        <td>{{ $report->notes ?? '-' }}</td>
                        <td>{{ $report->created_at->format('d M Y') }}</td>
                        <td>
                            @if ($report->approved_at)
                            <span class="badge bg-success">Terverifikasi</span>
                            @else
                            <span class="badge bg-warning text-dark">Menunggu</span>
                            @endif
                        </td>
                        <td>
                            @if ($report->photo_url)
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                data-bs-target="#fotoModal" data-photo="{{ $report->photo_url }}">
                                📷 Lihat Foto
                            </button>
                            @else
                            <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>

                        <td>
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                data-bs-target="#previewLaporanModal" data-child="{{ $report->child->name ?? '-' }}"
                                data-tanggal="{{ $report->created_at->format('d M Y') }}"
                                data-meals="{{ $report->meals }}" data-sleep="{{ $report->sleep }}"
                                data-activities="{{ $report->activities }}" data-notes="{{ $report->notes }}"
                                data-photo="{{ $report->photo_url ?? '' }}">
                                👁️ Preview
                            </button>

                            <a href="{{ route('staff.report.edit', $report->id) }}" class="btn btn-sm btn-secondary">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('staff.report.destroy', $report->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus laporan ini?')">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada laporan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Preview Laporan --}}
    <div class="modal fade" id="previewLaporanModal" tabindex="-1" aria-labelledby="previewLaporanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="previewLaporanModalLabel">Preview Laporan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Anak:</strong> <span id="preview-nama-anak">-</span></p>
                    <p><strong>Tanggal:</strong> <span id="preview-tanggal">-</span></p>
                    <p><strong>Makan:</strong> <span id="preview-meals">-</span></p>
                    <p><strong>Tidur:</strong> <span id="preview-sleep">-</span></p>
                    <p><strong>Aktivitas:</strong></p>
                    <p id="preview-activities">-</p>
                    <p><strong>Catatan:</strong></p>
                    <p id="preview-notes">-</p>
                    <div id="preview-photo-wrapper" class="mt-3 text-center d-none">
                        <img id="preview-photo" src="#" alt="Foto Aktivitas" class="img-fluid rounded shadow-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Lihat Foto --}}
    <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="fotoModalLabel">Foto Aktivitas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modal-foto-img" src="#" alt="Foto Aktivitas" class="img-fluid rounded shadow-sm">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // === Preview Modal ===
            const previewModal = document.getElementById('previewLaporanModal');
            previewModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                document.getElementById('preview-nama-anak').textContent = button.dataset.child || '-';
                document.getElementById('preview-tanggal').textContent = button.dataset.tanggal || '-';
                document.getElementById('preview-meals').textContent = button.dataset.meals || '-';
                document.getElementById('preview-sleep').textContent = button.dataset.sleep || '-';
                document.getElementById('preview-activities').textContent = button.dataset.activities ||
                    '-';
                document.getElementById('preview-notes').textContent = button.dataset.notes || '-';

                const photoUrl = button.dataset.photo;
                const wrapper = document.getElementById('preview-photo-wrapper');
                const img = document.getElementById('preview-photo');
                if (photoUrl) {
                    wrapper.classList.remove('d-none');
                    img.src = photoUrl;
                } else {
                    wrapper.classList.add('d-none');
                }
            });

            const fotoModal = document.getElementById('fotoModal');
            fotoModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const img = document.getElementById('modal-foto-img');
                const photoUrl = button.dataset.photo;
                img.src = photoUrl;
            });

        });

    </script>
    @endpush
</x-app-layout>
