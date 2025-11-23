<!-- resources/views/staff/laporan/index.blade.php -->
<x-app-layout>
    <div class="container py-4">

        <h3 class="fw-bold text-primary mb-4">📝 Laporan Aktivitas Anak</h3>

        {{-- Baris filter & aksi --}}
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">

            {{-- Form Pencarian --}}
            <form method="GET" class="d-flex align-items-end gap-2 flex-grow-1" style="max-width: 300px;">
                <div class="w-100">
                    <label class="form-label fw-semibold">Cari Nama Anak:</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama anak..."
                        class="form-control form-control-sm">
                </div>

                <button type="submit"
                    class="btn btn-info btn-md text-white d-flex align-items-center justify-content-center">
                    <i class="bi bi-search"></i>
                </button>
            </form>


            {{-- Tombol Tambah --}}
            <a href="{{ route('staff.report.create') }}" class="btn btn-primary h-50 align-self-end">
                ➕ Tambah Laporan
            </a>
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
                        {{-- <th>Status Verifikasi</th> --}}
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
                        {{--   <td>
                            @if ($report->approved_at)
                            <span class="badge bg-success">Terverifikasi</span>
                            @else
                            <span class="badge bg-warning text-dark">Menunggu</span>
                            @endif
                        </td> --}}
                        <td>
                            @if ($report->photo_url)
                            <img src="{{ $report->photo_url }}" alt="Foto Aktivitas" width="80"
                                class="img-thumbnail rounded shadow-sm">
                            @else
                            <span class="text-muted">Tidak ada</span>
                            @endif

                        </td>


                        <td>
                            <a href="{{ route('staff.report.edit', $report->id) }}" class="btn btn-sm btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form id="deleteForm-{{ $report->id }}"
                                action="{{ route('staff.report.destroy', $report->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btnDelete"
                                    data-id="{{ $report->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
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
                    <img id="modal-foto-img" src="" alt="Foto Aktivitas" class="img-fluid rounded shadow-sm">
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
                    img.src = "";
                }
            });

            // === Modal Lihat Foto ===
            const fotoModal = document.getElementById('fotoModal');
            fotoModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const img = document.getElementById('modal-foto-img');
                const photoUrl = button.dataset.photo || "";

                // Reset dulu agar browser reload ulang gambar
                img.src = "";

                // Delay kecil agar modal sempat render
                setTimeout(() => {
                    img.src = photoUrl;
                }, 10);
            });

        });

    </script>
    @endpush


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // === SweetAlert Session Success ===
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1800
            });
            @endif

            // === SweetAlert Session Error ===
            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
            @endif


            // === Konfirmasi Hapus Laporan ===
            document.querySelectorAll('.btnDelete').forEach(button => {
                button.addEventListener('click', function () {
                    let id = this.getAttribute('data-id');
                    let form = document.getElementById('deleteForm-' + id);

                    Swal.fire({
                        title: 'Hapus Laporan?',
                        text: "Laporan ini akan dihapus permanen.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

        });

    </script>

</x-app-layout>
