<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-pencil-square me-2"></i> Edit Profil
            </div>
            <div class="card-body">
                <form action="{{ route('parent.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    {{-- Foto Profil --}}
                    <div class="mb-4 text-center">
                        <div class="position-relative d-inline-block">
                            <img id="preview"
                                src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/100?text=Parent' }}"
                                alt="Foto Profil" class="rounded-circle border"
                                style="width: 120px; height: 120px; object-fit: cover;">
                            <label for="photo"
                                class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2"
                                style="cursor:pointer;">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                        </div>
                        <input type="file" name="photo" id="photo" class="d-none" accept="image/*"
                            onchange="previewImage(event)">
                        <p class="text-muted mt-2 mb-0 small">Klik ikon kamera untuk mengubah foto profil</p>
                        @error('photo')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email (readonly) --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                        <small class="text-muted">Email tidak dapat diubah</small>
                    </div>

                    {{-- Telepon --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                            rows="2">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" name="birth_date"
                            class="form-control @error('birth_date') is-invalid @enderror"
                            value="{{ old('birth_date', $user->birth_date) }}">
                        @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                            <option value="" disabled {{ !$user->gender ? 'selected' : '' }}>Pilih jenis kelamin
                            </option>
                            <option value="Perempuan"
                                {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            <option value="Laki-laki"
                                {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('parent.profile.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script untuk preview foto --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

    </script>
</x-app-layout>
