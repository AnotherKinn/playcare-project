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
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Masukkan nama anak">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" name="age" value="{{ old('age') }}" class="form-control" placeholder="Masukkan usia (tahun)">
                            @error('age')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-select">
                                <option disabled selected>Pilih jenis kelamin</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alergi</label>
                            <input type="text" name="allergy" value="{{ old('allergy') }}" class="form-control" placeholder="Masukkan alergi (jika ada)">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Tambahan</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Masukkan catatan tambahan (opsional)">{{ old('notes') }}</textarea>
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

    {{-- SweetAlert Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Tampilkan error dari validasi --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menambahkan Data!',
                html: `
                    <ul style="text-align: center;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonText: 'Oke, Perbaiki',
                confirmButtonColor: '#d33',
            });
        </script>
    @endif
</x-app-layout>
