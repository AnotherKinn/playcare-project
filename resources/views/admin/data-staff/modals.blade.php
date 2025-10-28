
    {{-- Modal Tambah Staff --}}
    <div class="modal fade" id="createStaffModal" tabindex="-1" aria-labelledby="createStaffModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="createStaffModalLabel">Tambah Staff Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
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

    {{-- Modal Edit Staff --}}
    <div class="modal fade" id="editStaffModal" tabindex="-1" aria-labelledby="editStaffModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title fw-bold" id="editStaffModalLabel">Edit Data Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="Rina Putri">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="rina@daycare.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" value="08123456789">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="2">Bandung</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>Active</option>
                                <option>Disabled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
