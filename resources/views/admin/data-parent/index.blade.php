<x-app-layout>
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-0">📋 Kelola Data Parent</h3>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari parent..." aria-label="Search" id="searchInput">
            </form>
        </div>

        <!-- Tabel Data Parent -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Tanggal Registrasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="parentTable">
                    @forelse($parents as $index => $parent)
                        <tr>
                            <th>{{ $index + 1 }}</th>
                            <td>{{ $parent->name }}</td>
                            <td>{{ $parent->email }}</td>
                            <td>{{ $parent->phone ?? '-' }}</td>
                            <td>{{ $parent->address ?? '-' }}</td>
                            <td>{{ $parent->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $parent->id }}">Lihat Detail</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data parent.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal Detail Parent -->
        @foreach($parents as $parent)
        <div class="modal fade" id="detailModal{{ $parent->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $parent->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailModalLabel{{ $parent->id }}">Detail Parent - {{ $parent->name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama:</strong> {{ $parent->name }}</p>
                        <p><strong>Email:</strong> {{ $parent->email }}</p>
                        <p><strong>No. HP:</strong> {{ $parent->phone ?? '-' }}</p>
                        <p><strong>Alamat:</strong> {{ $parent->address ?? '-' }}</p>
                        <p><strong>Tanggal Registrasi:</strong> {{ $parent->created_at->format('Y-m-d') }}</p>
                        <hr>
                        <h6>Anak Terdaftar:</h6>
                        <div class="row g-3">
                            @forelse($parent->children as $child)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $child->name }}</h6>
                                            <p class="card-text mb-0"><strong>Umur:</strong> {{ $child->age ?? '-' }} tahun</p>
                                            <p class="card-text mb-0"><strong>Jenis Kelamin:</strong> {{ $child->gender ?? '-' }}</p>
                                            <p class="card-text mb-0"><strong>Catatan Alergi:</strong> {{ $child->allergy ?? 'Tidak ada' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">Belum ada data anak.</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Script untuk search filter sederhana -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#parentTable tr');
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>
