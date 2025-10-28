<!-- resources/views/staff/laporan/index.blade.php -->
<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">📝 Laporan Aktivitas Anak</h3>

        {{-- Tombol Tambah Laporan --}}
        <div class="mb-3 text-end">
            <a href="{{ route('staff.report.create') }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahLaporanModal">
                ➕ Tambah Laporan
            </a>
        </div>

        {{-- Filter Anak --}}
        <div class="mb-3">
            <label for="filterAnak" class="form-label fw-semibold">Filter per Anak:</label>
            <select id="filterAnak" class="form-select" style="max-width: 300px;">
                <option value="">Semua Anak</option>
                <option value="1">Alya</option>
                <option value="2">Dimas</option>
                <option value="3">Rafi</option>
            </select>
        </div>

        {{-- Tabel Data Dummy --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Anak</th>
                        <th>Aktivitas</th>
                        <th>Kondisi</th>
                        <th>Tanggal</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Alya</td>
                        <td>Bermain balok dan menggambar bersama teman.</td>
                        <td><span class="badge bg-success">Baik</span></td>
                        <td>27 Okt 2025</td>
                        <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                        <td>
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#previewLaporanModal">
                                👁️ Preview
                            </button>
                            <a href="{{ route('staff.report.edit', 1) }}" class="btn btn-sm btn-secondary">✏️ Edit</a>
                            <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Dimas</td>
                        <td>Tidur siang selama 1 jam, lalu makan siang.</td>
                        <td><span class="badge bg-success">Baik</span></td>
                        <td>27 Okt 2025</td>
                        <td><span class="badge bg-success">Terverifikasi</span></td>
                        <td>
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#previewLaporanModal">
                                👁️ Preview
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah Laporan --}}
    <div class="modal fade" id="tambahLaporanModal" tabindex="-1" aria-labelledby="tambahLaporanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tambahLaporanModalLabel">Tambah Laporan Aktivitas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        {{-- Pilih Booking --}}
                        <div class="mb-3">
                            <label for="booking" class="form-label">Pilih Booking (Selesai)</label>
                            <select id="booking" class="form-select" required>
                                <option value="">-- Pilih Booking --</option>
                                <option value="1">Alya - Playground (Completed)</option>
                                <option value="2">Rafi - Full Day Care (Completed)</option>
                            </select>
                        </div>

                        {{-- Aktivitas --}}
                        <div class="mb-3">
                            <label for="aktivitas" class="form-label">Aktivitas</label>
                            <textarea id="aktivitas" class="form-control" rows="3" placeholder="Tulis deskripsi aktivitas anak..." required></textarea>
                        </div>

                        {{-- Kondisi Anak --}}
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi Anak</label>
                            <select id="kondisi" class="form-select" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik">Baik</option>
                                <option value="Rewel">Rewel</option>
                                <option value="Sakit">Sakit</option>
                            </select>
                        </div>

                        {{-- Upload Foto --}}
                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Foto (Opsional)</label>
                            <input type="file" class="form-control" id="foto" accept="image/*">
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Preview Laporan --}}
    <div class="modal fade" id="previewLaporanModal" tabindex="-1" aria-labelledby="previewLaporanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="previewLaporanModalLabel">Preview Laporan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Nama Anak:</strong> Alya <br>
                        <strong>Tanggal:</strong> 27 Okt 2025 <br>
                        <strong>Kondisi:</strong> <span class="badge bg-success">Baik</span>
                    </div>
                    <div class="mb-3">
                        <strong>Aktivitas:</strong>
                        <p>Bermain balok dan menggambar bersama teman-teman. Anak tampak ceria dan bersemangat.</p>
                    </div>
                    <div>
                        <strong>Foto Aktivitas:</strong><br>
                        <img src="https://via.placeholder.com/400x250.png?text=Foto+Aktivitas" alt="Foto Aktivitas" class="img-fluid rounded shadow-sm mt-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
