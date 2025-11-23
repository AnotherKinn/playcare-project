<x-app-layout>
    @section('title', 'Manajemen Booking')

    {{-- Simpan di bagian atas halaman --}}
    <meta name="route-verify" content="{{ route('admin.booking.verify', ':id') }}">
    <meta name="route-reject" content="{{ route('admin.booking.reject', ':id') }}">
    <meta name="route-assign" content="{{ route('admin.booking.assign', ':id') }}">
    <div class="d-flex">
        <style>
            @media (max-width: 768px) {
                .booking-container {
                    padding-top: 50px;
                }
            }

        </style>

        <div class="booking-container">
            <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h4 class="fw-bold text-primary mb-2 mb-md-0">📅 Data Booking</h4>

                    {{-- 🔍 Form Pencarian --}}
                    <form class="d-flex" method="GET" action="{{ route('admin.booking.index') }}">
                        <input type="text" name="search" class="form-control me-2"
                            placeholder="Cari nama parent atau anak..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                        @if (request('search'))
                        <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary ms-2">Reset</a>
                        @endif
                    </form>
                </div>

                {{-- Statistik --}}
                {{--<div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Total Booking</h6>
                                <h4 class="fw-bold text-primary">{{ $stats['total'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted mb-1">Pending</h6>
                <h4 class="fw-bold text-warning">{{ $stats['pending'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted mb-1">Disetujui</h6>
                <h4 class="fw-bold text-success">{{ $stats['approved'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted mb-1">Selesai</h6>
                <h4 class="fw-bold text-secondary">{{ $stats['completed'] }}</h4>
            </div>
        </div>
    </div>
    </div>--}}

    {{-- Tabel --}}
    <div class="card shadow-sm border-0 d-none d-md-block">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Parent</th>
                        <th>Nama Anak</th>
                        <th>Foto Anak</th>
                        <th>Tanggal Booking</th>
                        <th>Tipe Waktu Penitipan</th>
                        <th>Status</th>
                        <th>Total Biaya</th>
                        <th>Metode Pembayaran</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $i => $b)
                    @php
                    $badge = match ($b->status) {
                    'pending' => 'bg-warning',
                    'approved' => 'bg-success',
                    'assigned' => 'bg-success',
                    'completed' => 'bg-primary',
                    'in_progress' => 'bg-warning',
                    default => 'bg-light text-dark',
                    };
                    @endphp
                    <tr>
                        <td>{{ $bookings->firstItem() + $i }}</td>
                        <td>{{ $b->parent->name ?? '-' }}</td>
                        <td>{{ $b->child->name ?? '-' }}</td>
                        <td>
                            @if ($b->child && $b->child_photo)
                            <button class="btn btn-sm btn-warning btn-photo-child" data-bs-toggle="modal"
                                data-bs-target="#modalFotoAnak" data-img="{{ Storage::url($b->child_photo) }}">
                                Lihat Foto
                            </button>
                            @else
                            <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>

                        <td>{{ $b->booking_date->format('Y-m-d') }}</td>
                        @if($b->time_type === 'per_hari')
                        <td>Sehari</td>
                        @elseif($b->time_type === 'per_jam')
                        <td>{{ $b->duration }} Jam</td>
                        @elseif($b->time_type === 'per_bulan')
                        <td>Sebulan</td>
                        @endif
                        <td>
                            <span class="badge {{ $badge }}">
                                {{ ucwords(str_replace('_', ' ', $b->status)) }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($b->total_price, 0, ',', '.') }}</td>
                        @if($b->transaction->payment_method === 'cod')
                        <td>COD</td>
                        @elseif($b->transaction->payment_method === 'dana')
                        <td>DANA</td>
                        @elseif($b->transaction->payment_method === 'bca')
                        <td>Bank BCA</td>
                        @elseif($b->transaction->payment_method === 'mandiri')
                        <td>Bank Mandiri</td>
                        @endif
                        <td>
                            @if ($b->transaction && $b->transaction->payment_proof)
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalBukti"
                                data-img="{{ $b->proof_url }}">
                                Lihat Bukti
                            </button>
                            @else
                            <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                {{-- Tombol Verifikasi --}}
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalVerifikasi" data-id="{{ $b->id }}" @if($b->status ===
                                    'completed') disabled @endif
                                    >
                                    Verifikasi
                                </button>

                                {{-- Tombol Assign Staff --}}
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalAssign" data-id="{{ $b->id }}" @if($b->status === 'completed')
                                    disabled @endif
                                    >
                                    Assign Staff
                                </button>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Belum ada data booking</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 🔁 Pagination --}}
    <div class="mt-3">
        {{ $bookings->links() }}
    </div>

    {{-- Modal --}}
    @include('admin.booking.modals')
    </div>

    </div>
    </div>


    <!-- Modal Foto Anak -->
    <div class="modal fade" id="modalFotoAnak" tabindex="-1" aria-labelledby="fotoAnakLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="fotoAnakLabel">Foto Anak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 400px;">
                    <img id="fotoAnakPreview" src="" alt="Foto Anak" class="img-fluid rounded shadow"
                        style="max-height: 90%; object-fit: contain;">
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

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

@elseif(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: "{{ session('error') }}",
        showConfirmButton: true,
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


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modalFoto = document.getElementById('modalFotoAnak');
        const fotoPreview = document.getElementById('fotoAnakPreview');

        document.querySelectorAll('.btn-photo-child').forEach(btn => {
            btn.addEventListener('click', function () {
                fotoPreview.src = this.getAttribute('data-img');
            });
        });
    });

</script>
