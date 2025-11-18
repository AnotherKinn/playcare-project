<x-app-layout>
    <div class="container py-4">

        {{-- Header --}}
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($staff->name) }}" class="rounded-circle me-3"
                    alt="Foto Profil" width="100" height="100">
                <div class="flex-grow-1">
                    <h4 class="fw-bold mb-0">Edit Profil Staff</h4>
                    <p class="text-muted mb-0">Perbarui data pribadi dan akun Anda di bawah ini.</p>
                </div>
            </div>
        </div>

        {{-- Form Edit Profil --}}
        <form method="POST" action="{{ route('staff.profile.update', $staff->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Informasi Pribadi --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="bi bi-person-badge me-2"></i> Informasi Pribadi
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $staff->name) }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $staff->phone) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="address" class="form-control"
                            rows="3">{{ old('address', $staff->address) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Informasi Akun --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="bi bi-person-circle me-2"></i> Informasi Akun
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $staff->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="bi bi-image me-2"></i> Foto Profil
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="fw-semibold">Foto Profil Saat Ini</label><br>
                        <img src="{{ $staff->photo ? asset('storage/profile_photos/' . $staff->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($staff->name) }}"
                            width="120" height="120" class="rounded-circle border mb-2">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Foto Baru</label>
                        <input type="file" name="photo" class="form-control">
                        <small class="text-muted">Format: JPG/PNG, maksimal 2MB.</small>
                    </div>
                </div>
            </div>


            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('staff.profile.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
