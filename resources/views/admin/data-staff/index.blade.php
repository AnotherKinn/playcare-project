{{-- resources/views/admin/data-staff/index.blade.php --}}
<x-app-layout>

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">👥 Kelola Staff</h4>
        <a href="{{ route('admin.data-staff.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Staff
        </a>
    </div>

    {{-- Filter & Search --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.data-staff.index') }}"
                class="d-flex flex-wrap gap-3 align-items-center">
                <div class="flex-grow-1">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Cari staff berdasarkan nama atau email...">
                </div>
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
        </div>
    </div>


    {{-- Tabel Desktop --}}
    <div class="card border-0 shadow-sm d-none d-md-block">
        <div class="card-body table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($staffs as $i => $staff)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ $staff->name }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ $staff->phone ?? '-' }}</td>
                        <td>{{ $staff->address ?? '-' }}</td>
                        <td>
                            @php
                            $schedule = $staff->latestSchedule;
                            $status = $schedule->status ?? 'non-active';
                            @endphp

                            @if ($status === 'active')
                            <span class="badge bg-success">Aktif</span>

                            @elseif ($status === 'assigned')
                            <span class="badge bg-warning text-dark">Sedang Bertugas</span>

                            @elseif ($status === 'non-active')
                            <span class="badge bg-secondary">Nonaktif</span>

                            @else
                            <span class="badge bg-light text-muted">Unknown</span>
                            @endif
                        </td>


                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.data-staff.edit', $staff->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form id="deleteForm-{{ $staff->id }}"
                                    action="{{ route('admin.data-staff.destroy', $staff->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-sm btn-outline-danger btnDelete"
                                        data-id="{{ $staff->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-3">Belum ada data staff.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <small>Menampilkan {{ $staffs->count() }} staff</small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    {{-- Card Mobile --}}
    <div class="d-block d-md-none">
        @forelse ($staffs as $i => $staff)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-semibold">{{ $staff->name }}</h5>
                <p class="mb-1"><strong>Email:</strong> {{ $staff->email }}</p>
                <p class="mb-1"><strong>Telepon:</strong> {{ $staff->phone ?? '-' }}</p>
                <p class="mb-1"><strong>Alamat:</strong> {{ $staff->address ?? '-' }}</p>
                <p class="mb-1">
                    <strong>Status:</strong>
                    @if ($staff->status === 'active')
                    <span class="badge bg-success">Active</span>
                    @elseif ($staff->status === 'disabled')
                    <span class="badge bg-secondary">Disabled</span>
                    @else
                    <span class="badge bg-light text-muted">Unknown</span>
                    @endif
                </p>
                <p class="mb-2">
                    <strong>Aktivitas:</strong>
                    @if ($staff->is_busy ?? false)
                    <span class="badge bg-warning text-dark">👶 Sedang Bekerja</span>
                    @else
                    <span class="badge bg-light text-muted">🕓 No Jobs</span>
                    @endif
                </p>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.data-staff.edit', $staff->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <form id="deleteForm-{{ $staff->id }}" action="{{ route('admin.data-staff.destroy', $staff->id) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-sm btn-outline-danger btnDelete"
                            data-id="{{ $staff->id }}">
                            <i class="bi bi-trash"></i>
                        </button>

                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted">Belum ada data staff.</div>
        @endforelse
    </div>
    @include('admin.data-staff.modals', ['staffs' => $staffs])
</x-app-layout>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // === SweetAlert untuk Session Success ===
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1800
    });
    @endif

    // === SweetAlert untuk Session Error ===
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: "{{ session('error') }}",
        showConfirmButton: true
    });
    @endif


    // === Konfirmasi Hapus Staff ===
    document.querySelectorAll('.btnDelete').forEach(button => {
        button.addEventListener('click', function () {

            const staffId = this.getAttribute('data-id');
            const form = document.getElementById(`deleteForm-${staffId}`);

            Swal.fire({
                title: 'Hapus Staff?',
                text: "Data staff akan dihapus secara permanen.",
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

</script>
