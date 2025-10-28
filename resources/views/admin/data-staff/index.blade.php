{{-- resources/views/admin/staff/index.blade.php --}}
<x-app-layout>
    <div class="d-flex">

        <style>
            @media (max-width: 768px) {
                .data-staff-container {
                    padding-top: 50px;
                    /* kasih jarak agar gak ketimpa navbar hamburger */
                }
            }

        </style>

        <div class="data-staff-container">

            {{-- Konten Utama --}}
            <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-primary mb-0">👥 Kelola Staff</h4>
                    <a href="{{ route('admin.data-staff.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Staff
                    </a>

                </div>

                {{-- Filter & Search --}}
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body d-flex flex-wrap gap-3 align-items-center">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control"
                                placeholder="Cari staff berdasarkan nama atau email...">
                        </div>
                        <select class="form-select w-auto">
                            <option value="">Semua Status</option>
                            <option value="active">Active</option>
                            <option value="disabled">Disabled</option>
                            <option value="busy">Sedang Bekerja</option>
                        </select>
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                </div>

                @php
                $staffs = [
                [
                'id' => 1,
                'name' => 'Rina Putri',
                'email' => 'rina@daycare.com',
                'phone' => '08123456789',
                'address' => 'Bandung',
                'status' => 'active',
                'is_busy' => false,
                'activity' => '🕓 No Jobs',
                ],
                [
                'id' => 2,
                'name' => 'Budi Santoso',
                'email' => 'budi@daycare.com',
                'phone' => '08567891234',
                'address' => 'Jakarta',
                'status' => 'active',
                'is_busy' => true,
                'activity' => '👶 Mengurus Anak: Dinda',
                ],
                [
                'id' => 3,
                'name' => 'Siti Lestari',
                'email' => 'siti@daycare.com',
                'phone' => '08765432109',
                'address' => 'Depok',
                'status' => 'disabled',
                'is_busy' => false,
                'activity' => '🕓 No Jobs',
                ],
                ];
                @endphp

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
                                    <th>Aktivitas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $i => $staff)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td class="fw-semibold">{{ $staff['name'] }}</td>
                                    <td>{{ $staff['email'] }}</td>
                                    <td>{{ $staff['phone'] }}</td>
                                    <td>{{ $staff['address'] }}</td>
                                    <td>
                                        @if ($staff['status'] === 'active')
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($staff['is_busy'])
                                        <span class="badge bg-warning text-dark">{{ $staff['activity'] }}</span>
                                        @else
                                        <span class="badge bg-light text-muted">{{ $staff['activity'] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.data-staff.edit', $staff['id']) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.data-staff.destroy', $staff['id']) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Yakin ingin menghapus staff ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small>Menampilkan 1–3 dari 3 staff</small>
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
                    @foreach ($staffs as $i => $staff)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">{{ $staff['name'] }}</h5>
                            <p class="mb-1"><strong>Email:</strong> {{ $staff['email'] }}</p>
                            <p class="mb-1"><strong>Telepon:</strong> {{ $staff['phone'] }}</p>
                            <p class="mb-1"><strong>Alamat:</strong> {{ $staff['address'] }}</p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                @if ($staff['status'] === 'active')
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Disabled</span>
                                @endif
                            </p>
                            <p class="mb-2">
                                <strong>Aktivitas:</strong>
                                @if ($staff['is_busy'])
                                <span class="badge bg-warning text-dark">{{ $staff['activity'] }}</span>
                                @else
                                <span class="badge bg-light text-muted">{{ $staff['activity'] }}</span>
                                @endif
                            </p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.data-staff.edit', $staff['id']) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('admin.data-staff.destroy', $staff['id']) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Yakin ingin menghapus staff ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('admin.data-staff.modals') {{-- Bisa buat partial agar bersih --}}

</x-app-layout>
