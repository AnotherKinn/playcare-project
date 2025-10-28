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

            {{-- Form Dummy --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama staff">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Masukkan email staff">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" placeholder="Masukkan nomor telepon">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="2" placeholder="Masukkan alamat staff"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password (dibuat oleh admin)</label>
                            <input type="text" class="form-control" placeholder="Masukkan password baru">
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="sendEmailInvite">
                            <label for="sendEmailInvite" class="form-check-label">Kirim email undangan ke staff</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan Staff</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
