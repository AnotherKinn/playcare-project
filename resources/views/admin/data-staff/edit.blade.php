<x-app-layout>
    <div class="container py-4">

        <style>
            @media (max-width: 768px) {
                .edit-staff-container {
                    padding-top: 50px;
                    /* kasih jarak agar gak ketimpa navbar hamburger */
                }
            }

        </style>

        {{-- Dummy data staff --}}
        @php
        $staff = [
        'name' => 'Rina Putri',
        'email' => 'rina@daycare.com',
        'phone' => '08123456789',
        'address' => 'Bandung',
        'status' => 'active',
        ];
        @endphp


        <div class="edit-staff-container">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-warning mb-0">✏️ Edit Staff</h4>
                <a href="{{ route('admin.data-staff.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            {{-- Form Edit Dummy --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ $staff['name'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $staff['email'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" value="{{ $staff['phone'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="2">{{ $staff['address'] }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="active" @if($staff['status']=='active' ) selected @endif>Active</option>
                                <option value="disabled" @if($staff['status']=='disabled' ) selected @endif>Disabled
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
