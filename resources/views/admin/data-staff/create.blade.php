<x-app-layout>
    <div class="container py-4">

        <style>
            @media (max-width: 768px) {
                .create-staff-container {
                    padding-top: 50px;
                    /* kasih jarak agar gak ketimpa navbar hamburger */
                }
            }
        </style>

        <div class="create-staff-container">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary mb-0">➕ Tambah Staff Baru</h4>
                <a href="{{ route('admin.data-staff.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            {{-- Form Tambah Staff Dinamis --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.data-staff.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Masukkan nama staff" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="Masukkan email staff" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" placeholder="Masukkan nomor telepon" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address"
                                class="form-control @error('address') is-invalid @enderror"
                                rows="2" placeholder="Masukkan alamat staff" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password (dibuat oleh admin)</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password baru" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="form-check mb-3">
                            <input type="checkbox" name="send_email" class="form-check-input" id="sendEmailInvite"
                                {{ old('send_email') ? 'checked' : '' }}>
                            <label for="sendEmailInvite" class="form-check-label">
                                Kirim email undangan ke staff
                            </label>
                        </div> --}}

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-1"></i> Simpan Staff
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
