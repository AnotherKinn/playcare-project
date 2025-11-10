<x-app-layout>
    <div class="d-flex">
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
            <div class="card shadow-sm border-0 mx-auto" style="max-width: 600px;">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Edit Data Anak</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('parent.data-children.update', $child->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Anak</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $child->name) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" name="age" class="form-control" value="{{ old('age', $child->age) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-select" required>
                                <option value="" disabled>Pilih jenis kelamin</option>
                                <option value="Laki-laki"
                                    {{ old('gender', $child->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="Perempuan"
                                    {{ old('gender', $child->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alergi</label>
                            <input type="text" name="allergy" class="form-control"
                                value="{{ old('allergy', $child->allergy) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Tambahan</label>
                            <textarea name="notes" class="form-control"
                                rows="3">{{ old('notes', $child->notes) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('parent.data-children.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-warning text-dark">Update</button>
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
