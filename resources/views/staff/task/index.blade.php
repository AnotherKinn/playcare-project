<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">📋 Daftar Tugas Staff</h3>

        {{-- Filter Status --}}
        <form method="GET" class="mb-3">
            <div class="d-flex align-items-center gap-2">
                <label for="filterStatus" class="fw-semibold">Filter:</label>
                <select name="status" id="filterStatus" class="form-select w-auto">
                    <option value="all">Semua</option>
                    <option value="today">Hari Ini</option>
                    <option value="completed">Selesai</option>
                </select>
            </div>
        </form>

        {{-- Tabel Data Tugas --}}
        <div class="table-responsive bg-white shadow-sm rounded p-3">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Anak</th>
                        <th>Jenis Layanan</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data Dummy --}}
                    @php
                        $tasks = [
                            [
                                'id' => 1,
                                'nama_anak' => 'Aulia Putri',
                                'umur' => '5 tahun',
                                'layanan' => 'Daycare Full Day',
                                'jadwal' => '28 Okt 2025, 08:00 - 16:00',
                                'status' => 'Menunggu',
                                'alergi' => 'Susu sapi',
                                'catatan' => 'Suka bermain puzzle, moody saat bangun tidur',
                            ],
                            [
                                'id' => 2,
                                'nama_anak' => 'Rafi Ahmad',
                                'umur' => '4 tahun',
                                'layanan' => 'Playground',
                                'jadwal' => '28 Okt 2025, 10:00 - 12:00',
                                'status' => 'Berjalan',
                                'alergi' => '-',
                                'catatan' => 'Aktif, perlu pengawasan ekstra saat bermain air',
                            ],
                            [
                                'id' => 3,
                                'nama_anak' => 'Nayla Zahra',
                                'umur' => '6 tahun',
                                'layanan' => 'Daycare Half Day',
                                'jadwal' => '27 Okt 2025, 08:00 - 12:00',
                                'status' => 'Selesai',
                                'alergi' => 'Udang',
                                'catatan' => 'Sudah bisa membaca dasar',
                            ],
                        ];
                    @endphp

                    @foreach ($tasks as $index => $task)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $task['nama_anak'] }}</td>
                            <td>{{ $task['layanan'] }}</td>
                            <td>{{ $task['jadwal'] }}</td>
                            <td>
                                @if ($task['status'] === 'Menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif ($task['status'] === 'Berjalan')
                                    <span class="badge bg-primary">Berjalan</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $task['id'] }}">
                                    Detail
                                </button>

                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#editStatusModal{{ $task['id'] }}">
                                    Edit Status
                                </button>
                            </td>
                        </tr>

                        {{-- Modal Detail Anak --}}
                        <div class="modal fade" id="detailModal{{ $task['id'] }}" tabindex="-1"
                            aria-labelledby="detailModalLabel{{ $task['id'] }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="detailModalLabel{{ $task['id'] }}">Detail Anak</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <strong>Nama Anak:</strong>
                                            <p>{{ $task['nama_anak'] }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Umur:</strong>
                                            <p>{{ $task['umur'] }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Jenis Layanan:</strong>
                                            <p>{{ $task['layanan'] }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Jadwal:</strong>
                                            <p>{{ $task['jadwal'] }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Alergi:</strong>
                                            <p>{{ $task['alergi'] }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Catatan Khusus:</strong>
                                            <p>{{ $task['catatan'] }}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Edit Status --}}
                        <div class="modal fade" id="editStatusModal{{ $task['id'] }}" tabindex="-1"
                            aria-labelledby="editStatusLabel{{ $task['id'] }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary text-white">
                                        <h5 class="modal-title" id="editStatusLabel{{ $task['id'] }}">Ubah Status Tugas</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form>
                                        <div class="modal-body">
                                            <p><strong>{{ $task['nama_anak'] }}</strong> — {{ $task['layanan'] }}</p>
                                            <div class="mb-3">
                                                <label for="statusSelect{{ $task['id'] }}" class="form-label">Status
                                                    Baru</label>
                                                <select id="statusSelect{{ $task['id'] }}" class="form-select">
                                                    @if ($task['status'] === 'Menunggu')
                                                        <option value="in_progress">Berjalan</option>
                                                    @elseif ($task['status'] === 'Berjalan')
                                                        <option value="completed">Selesai</option>
                                                    @else
                                                        <option disabled selected>Tugas Selesai</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
