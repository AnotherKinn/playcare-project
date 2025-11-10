<x-app-layout>
    <div class="d-flex">
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary">👶 Data Anak</h4>
                <a href="{{ route('parent.data-children.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Anak
                </a>
            </div>

            {{-- ===================== DESKTOP TABLE VIEW ===================== --}}
            <div class="card shadow-sm border-0 d-none d-md-block">
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Anak</th>
                                <th>Usia</th>
                                <th>Jenis Kelamin</th>
                                <th>Alergi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($children as $index => $child)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $child->name }}</td>
                                <td>{{ $child->age }} Tahun</td>
                                <td>{{ $child->gender }}</td>
                                <td>{{ $child->allergy ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('parent.data-children.edit', $child->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('parent.data-children.destroy', $child->id) }}" method="POST"
                                        class="d-inline" data-confirm="true">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data anak</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ===================== MOBILE CARD VIEW ===================== --}}
            <div class="d-block d-md-none">
                @forelse ($children as $child)
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0 text-primary">{{ $child->name }}</h5>
                            <div>
                                <a href="{{ route('parent.data-children.edit', $child->id) }}"
                                    class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="#" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="mb-1"><strong>Usia:</strong> {{ $child->age }} Tahun</p>
                        <p class="mb-1"><strong>Jenis Kelamin:</strong> {{ $child->gender }}</p>
                        <p class="mb-1"><strong>Alergi:</strong> {{ $child->allergy ?? '-' }}</p>
                        @if($child->notes)
                        <p class="mb-1"><strong>Catatan:</strong> {{ $child->notes }}</p>
                        @endif
                    </div>
                </div>
                @empty
                <p class="text-center text-muted">Belum ada data anak</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ✅ Notifikasi Sukses --}}
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1800
        });

    </script>
    @endif

    {{-- ⚠️ Konfirmasi Hapus Data --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('form[data-confirm]');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Yakin mau hapus?',
                        text: 'Data anak ini akan dihapus secara permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
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
