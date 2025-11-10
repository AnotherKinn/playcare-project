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
                    @forelse ($tasks as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->child->name }}</td>
                        @if($task->service_type === 'full_day')
                        <p>Full Day</td>
                        @elseif($task->service_type === 'half_day')
                        <td>Half Day</td>
                        @elseif($task->service_type === 'playground')
                        <td>Playground</td>
                        @else
                        <td>-</td>
                        @endif
                        <td>{{ \Carbon\Carbon::parse($task->booking_date)->translatedFormat('d M Y, H:i') }}</td>
                        <td>
                            @if ($task->status === 'assigned' || $task->status === 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif ($task->status === 'in_progress')
                            <span class="badge bg-primary">Berjalan</span>
                            @elseif ($task->status === 'completed')
                            <span class="badge bg-success">Selesai</span>
                            @else
                            <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $task->id }}">
                                Detail
                            </button>

                            <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#editStatusModal{{ $task->id }}">
                                Edit Status
                            </button>
                        </td>
                    </tr>

                    {{-- Modal Detail Anak --}}
                    <div class="modal fade" id="detailModal{{ $task->id }}" tabindex="-1"
                        aria-labelledby="detailModalLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="detailModalLabel{{ $task->id }}">Detail Anak</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <strong>Nama Anak:</strong>
                                        <p>{{ $task->child->name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Umur:</strong>
                                        <p>{{ $task->child->age }} tahun</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Jenis Layanan:</strong>
                                        @if($task->service_type === 'full_day')
                                        <p>Full Day</p>
                                        @elseif($task->service_type === 'half_day')
                                        <p>Half Day</p>
                                        @elseif($task->service_type === 'playground')
                                        <p>Playground</p>
                                        @else
                                        <p>-</p>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <strong>Jadwal:</strong>
                                        <p>{{ \Carbon\Carbon::parse($task->booking_date)->translatedFormat('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Alergi:</strong>
                                        <p>{{ $task->child->allergy ?? '-' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Catatan Khusus:</strong>
                                        <p>{{ $task->notes ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Edit Status --}}
                    <div class="modal fade" id="editStatusModal{{ $task->id }}" tabindex="-1"
                        aria-labelledby="editStatusLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-secondary text-white">
                                    <h5 class="modal-title" id="editStatusLabel{{ $task->id }}">Ubah Status Tugas</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('staff.task.update-status', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <p><strong>{{ $task->child->name }}</strong> — {{ $task->service_type }}</p>
                                        <div class="mb-3">
                                            <label for="statusSelect{{ $task->id }}" class="form-label">Status
                                                Baru</label>
                                            <select id="statusSelect{{ $task->id }}" name="status" class="form-select">
                                                <option value="in_progress"
                                                    {{ $task->status === 'in_progress' ? 'selected' : '' }}>Berjalan
                                                </option>
                                                <option value="completed"
                                                    {{ $task->status === 'completed' ? 'selected' : '' }}>Selesai
                                                </option>
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
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada tugas untuk saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</x-app-layout>
