<x-app-layout>
    <div class="d-flex">
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
            <div class="card shadow-sm border-0 mx-auto" style="max-width: 600px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Data Anak</h5>
                </div>
                <div class="card-body">
                    {{-- Form Dinamis --}}
                    <form action="{{ route('parent.data-children.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Anak</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan nama anak" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" name="age" class="form-control" placeholder="Masukkan usia (tahun)" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-select" required>
                                <option selected disabled>Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alergi</label>
                            <input type="text" name="allergy" class="form-control" placeholder="Masukkan alergi (jika ada)">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Tambahan</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Masukkan catatan tambahan (opsional)"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('parent.data-children.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
