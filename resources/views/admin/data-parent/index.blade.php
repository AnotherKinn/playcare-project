<x-app-layout>
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-0">📋 Kelola Data Parent</h3>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari parent..." aria-label="Search" id="searchInput">
            </form>
        </div>

        <!-- Tabel Data Parent -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Tanggal Registrasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="parentTable">
                    <tr>
                        <th>1</th>
                        <td>Aji Pamungkas</td>
                        <td>aji@example.com</td>
                        <td>08123456789</td>
                        <td>Jl. Merdeka No. 12</td>
                        <td>2025-10-01</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal1">Lihat Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Siti Nurhaliza</td>
                        <td>siti@example.com</td>
                        <td>08234567890</td>
                        <td>Jl. Sudirman No. 45</td>
                        <td>2025-09-28</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal2">Lihat Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination Dummy -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>

        <!-- Modal Detail Parent 1 -->
        <div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="detailModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailModalLabel1">Detail Parent - Aji Pamungkas</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama:</strong> Aji Pamungkas</p>
                        <p><strong>Email:</strong> aji@example.com</p>
                        <p><strong>No. HP:</strong> 08123456789</p>
                        <p><strong>Alamat:</strong> Jl. Merdeka No. 12</p>
                        <p><strong>Tanggal Registrasi:</strong> 2025-10-01</p>
                        <hr>
                        <h6>Anak Terdaftar:</h6>
                        <div class="row g-3">
                            <!-- Data Dummy Child -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Raka Pamungkas</h6>
                                        <p class="card-text mb-0"><strong>Umur:</strong> 4 tahun</p>
                                        <p class="card-text mb-0"><strong>Jenis Kelamin:</strong> Laki-laki</p>
                                        <p class="card-text mb-0"><strong>Catatan Alergi:</strong> Tidak ada</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Rani Pamungkas</h6>
                                        <p class="card-text mb-0"><strong>Umur:</strong> 2 tahun</p>
                                        <p class="card-text mb-0"><strong>Jenis Kelamin:</strong> Perempuan</p>
                                        <p class="card-text mb-0"><strong>Catatan Alergi:</strong> Laktosa</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Parent 2 -->
        <div class="modal fade" id="detailModal2" tabindex="-1" aria-labelledby="detailModalLabel2" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailModalLabel2">Detail Parent - Siti Nurhaliza</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama:</strong> Siti Nurhaliza</p>
                        <p><strong>Email:</strong> siti@example.com</p>
                        <p><strong>No. HP:</strong> 08234567890</p>
                        <p><strong>Alamat:</strong> Jl. Sudirman No. 45</p>
                        <p><strong>Tanggal Registrasi:</strong> 2025-09-28</p>
                        <hr>
                        <h6>Anak Terdaftar:</h6>
                        <div class="row g-3">
                            <!-- Data Dummy Child -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Ali Nurhaliza</h6>
                                        <p class="card-text mb-0"><strong>Umur:</strong> 3 tahun</p>
                                        <p class="card-text mb-0"><strong>Jenis Kelamin:</strong> Laki-laki</p>
                                        <p class="card-text mb-0"><strong>Catatan Alergi:</strong> Tidak ada</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Script untuk search filter sederhana -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#parentTable tr');

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>
