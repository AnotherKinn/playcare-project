<x-app-layout>
    <div class="container py-4">

        <style>
            @media (max-width: 768px) {
                .edit-staff-container {
                    padding-top: 50px;
                    /* jarak biar gak ketimpa navbar hamburger */
                }
            }
        </style>

        <div class="edit-staff-container">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-warning mb-0">✏️ Edit Staff</h4>
                <a href="{{ route('admin.data-staff.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            {{-- Form Edit Dinamis --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.data-staff.update', $staff->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $staff->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $staff->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $staff->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required>{{ old('address', $staff->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ $staff->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="non-active" {{ $staff->status === 'non-active' ? 'selected' : '' }}>Non-Active</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
