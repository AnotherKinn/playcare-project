{{-- resources/views/admin/booking/modals.blade.php --}}
{{-- ================================================ --}}
{{-- ========== MODAL UNTUK HALAMAN BOOKING ========== --}}
{{-- ================================================ --}}


{{-- Modal Bukti Transaksi --}}
<div class="modal fade" id="modalBukti" tabindex="-1" aria-labelledby="modalBuktiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <img id="buktiTransaksiImg" class="img-fluid rounded shadow-sm mx-auto d-block"
                    style="max-height: 400px; object-fit: contain;" alt="Bukti Transaksi">
            </div>
        </div>
    </div>
</div>



{{-- Modal Verifikasi Booking --}}
<div class="modal fade" id="modalVerifikasi" tabindex="-1" aria-labelledby="modalVerifikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formVerifikasi" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Verifikasi Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="textVerifikasi">Apakah Anda yakin ingin menyetujui booking ini?</p>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger me-2" id="btnTolak">Tolak</button>
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Assign Staff --}}
<div class="modal fade" id="modalAssign" tabindex="-1" aria-labelledby="modalAssignLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formAssign" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Assign Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="staffSelect" class="form-label">Pilih Staff</label>
                        <select id="staffSelect" name="staff_id" class="form-select" required>
                            <option value="">-- Pilih Staff --</option>
                            @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Assign</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



{{-- ========================= --}}
{{-- ========== SCRIPT ========= --}}
{{-- ========================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const routeVerify = document.querySelector('meta[name="route-verify"]').content;
        const routeReject = document.querySelector('meta[name="route-reject"]').content;
        const routeAssign = document.querySelector('meta[name="route-assign"]').content;

        // ====== Modal Verifikasi Booking ======
        const modalVerifikasi = document.getElementById('modalVerifikasi');
        modalVerifikasi.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const bookingId = button.getAttribute('data-id');
            const form = document.getElementById('formVerifikasi');
            const textVerifikasi = document.getElementById('textVerifikasi');

            form.action = routeVerify.replace(':id', bookingId);
            textVerifikasi.textContent = `Apakah Anda yakin ingin menyetujui booking #${bookingId}?`;

            document.getElementById('btnTolak').onclick = () => {
                form.action = routeReject.replace(':id', bookingId);
                form.submit();
            };
        });

        // ====== Modal Assign Staff ======
        const modalAssign = document.getElementById('modalAssign');
        modalAssign.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const bookingId = button.getAttribute('data-id');
            const form = document.getElementById('formAssign');
            form.action = routeAssign.replace(':id', bookingId);
        });

        // ====== Modal Bukti Transaksi ======
        const modalBukti = document.getElementById('modalBukti');
        modalBukti.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const imageUrl = button.getAttribute('data-img'); // sudah full URL
            const imageEl = document.getElementById('buktiTransaksiImg');

            if (imageUrl) {
                imageEl.src = imageUrl;
            } else {
                imageEl.src = ''; // atau tampilkan teks/placeholder
                imageEl.alt = 'Bukti tidak tersedia';
            }
        });
    });

</script>

