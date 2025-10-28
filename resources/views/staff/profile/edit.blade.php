<!-- resources/views/staff/profile-edit.blade.php -->
<x-app-layout>
    <div class="container py-4">

        {{-- Header --}}
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body d-flex align-items-center">
                <img
                    src="https://via.placeholder.com/100"
                    class="rounded-circle me-3"
                    alt="Foto Profil"
                    width="100" height="100">
                <div class="flex-grow-1">
                    <h4 class="fw-bold mb-0">Edit Profil Staff</h4>
                    <p class="text-muted mb-0">Perbarui data pribadi dan akun Anda di bawah ini.</p>
                </div>
            </div>
        </div>

        {{-- Form Edit Profil --}}
        <form method="POST" action="#" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Informasi Pribadi --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="bi bi-person-badge me-2"></i> Informasi Pribadi
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="photo" class="form-label fw-semibold">Foto Profil</label><br>
                        <img src="https://via.placeholder.com/100" alt="Preview" class="rounded-circle mb-2" width="100" height="100">
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="Rina Hartati">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jabatan</label>
                            <input type="text" name="position" class="form-control" value="Pengasuh Anak">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="gender" class="form-select">
                                <option selected>Perempuan</option>
                                <option>Laki-laki</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control" value="1998-03-12">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" value="0812-3456-7890">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="address" class="form-control" rows="3">Jl. Melati No. 45, Bandung</textarea>
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
                            <input type="email" name="email" class="form-control" value="rina.hartati@playcare.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="username" class="form-control" value="rinahartati98">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
