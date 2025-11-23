<x-app-layout>
    <div class="container py-4">

        <h5 class="fw-bold mb-4 text-primary text-center text-md-start">Halaman Konfirmasi Pembayaran</h5>

        {{-- ======= BARIS 1: INFORMASI ANAK & BOOKING ======= --}}
        <div class="row g-4 mb-3">
            {{-- === INFORMASI ANAK === --}}
            <div class="col-md-6 col-12">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body bg-light">
                        <h6 class="fw-bold mb-3">Informasi Anak</h6>
                        <p class="mb-1"><strong>Nama :</strong> {{ $booking->child->name }}</p>
                        <p class="mb-1"><strong>Umur :</strong> {{ $booking->child->age }} Tahun</p>
                        <p class="mb-1"><strong>Jenis Kelamin :</strong> {{ ucfirst($booking->child->gender) }}</p>
                        <p class="mb-1"><strong>Alergi :</strong> {{ $booking->child->allergy ?? '-' }}</p>
                        <p class="mb-0"><strong>Catatan :</strong> {{ $booking->child->notes ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- === RINCIAN BOOKING === --}}
            <div class="col-md-6 col-12">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body bg-light">
                        <h6 class="fw-bold mb-3">Rincian Booking</h6>
                        <p class="mb-1"><strong>Tanggal Booking :</strong>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</p>
                        <p class="mb-1"><strong>Tipe Waktu Penitipan :</strong>
                            @if($booking->time_type == 'per_jam') Per Jam
                            @elseif($booking->time_type == 'per_hari') Per Hari
                            @elseif($booking->time_type == 'per_bulan') Per Bulan
                            @endif
                        </p>
                        <p class="mb-1"><strong>Durasi :</strong>
                            @if($booking->time_type == 'per_jam')
                            {{ $booking->duration }} Jam
                            @elseif($booking->time_type == 'per_hari')
                            24 Jam
                            @elseif($booking->time_type == 'per_bulan')
                            30 Hari
                            @endif
                        </p>
                        <p class="mb-0"><strong>Total Biaya :</strong>
                            <span class="text-success fw-bold">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======= BARIS 2: METODE & PEMBAYARAN ======= --}}
        <div class="row g-4" x-data="{ selectedMethod: '-' }">
            {{-- === METODE PEMBAYARAN === --}}
            <div class="col-md-6 col-12">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body bg-light">
                        <h6 class="fw-bold mb-3">Pilih Metode Pembayaran</h6>

                        <style>
                            .payment-option {
                                transition: all 0.2s ease;
                                cursor: pointer;
                            }

                            .payment-option:hover {
                                background-color: #f8f9fa;
                                border-color: #0d6efd !important;
                            }

                            .payment-option.selected {
                                border-color: #0d6efd !important;
                                box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
                                background-color: #f8faff;
                            }

                            .payment-option img {
                                width: 70px;
                                height: 50px;
                                object-fit: contain;
                            }

                            /* === Responsif Mobile === */
                            @media (max-width: 768px) {
                                .payment-option {
                                    flex-direction: column;
                                    text-align: center;
                                    padding: 1rem !important;
                                }

                                .payment-option img {
                                    width: 90px;
                                    height: auto;
                                    margin-bottom: 0.5rem;
                                }

                                .payment-option span {
                                    font-size: 0.9rem;
                                }
                            }

                        </style>

                        <div class="d-flex flex-column gap-2">
                            @foreach ([
                            ['value' => 'cod', 'img' => 'logo-cod.png', 'label' => 'COD'],
                            ['value' => 'dana', 'img' => 'logo-dana.png', 'label' => 'DANA'],
                            ['value' => 'bca', 'img' => 'logo-bca.png', 'label' => 'BCA'],
                            ['value' => 'mandiri', 'img' => 'logo-mandiri.png', 'label' => 'Mandiri'],
                            ] as $method)
                            <label class="payment-option border rounded-3 p-2 d-flex align-items-center"
                                :class="{ 'selected': selectedMethod === '{{ $method['value'] }}' }">
                                <input type="radio" name="payment_method" value="{{ $method['value'] }}"
                                    class="form-check-input me-2" @change="selectedMethod = '{{ $method['value'] }}'"
                                    required>
                                <img src="{{ asset('assets/images/' . $method['img']) }}" alt="{{ $method['label'] }}"
                                    class="me-2">
                                {{--<span>{{ $method['label'] }}</span>--}}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- === RINCIAN PEMBAYARAN === --}}
            <div class="col-md-6 col-12">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body bg-light">
                        <h6 class="fw-bold mb-3">Rincian Pembayaran</h6>

                        <form id="payment-form" action="{{ route('parent.payments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <input type="hidden" name="payment_method" :value="selectedMethod">

                            <p class="mb-1"><strong>ID Transaksi :</strong>
                                TRX{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</p>
                            <p class="mb-1"><strong>Tipe Waktu Penitipan :</strong>
                                @if($booking->time_type == 'per_jam') Per Jam
                                @elseif($booking->time_type == 'per_hari') Per Hari
                                @elseif($booking->time_type == 'per_bulan') Per Bulan
                                @endif
                            </p>
                            <p class="mb-1"><strong>Durasi :</strong>
                                @if($booking->time_type == 'per_jam')
                                {{ $booking->duration }} Jam
                                @elseif($booking->time_type == 'per_hari')
                                24 Jam
                                @elseif($booking->time_type == 'per_bulan')
                                30 Hari
                                @endif
                            </p>
                            <p class="mb-1"><strong>Metode Pembayaran :</strong>
                                <span x-text="selectedMethod !== '-' ? selectedMethod.toUpperCase() : '-'"></span>
                            </p>
                            <p class="mb-3"><strong>Total Biaya :</strong>
                                <span class="text-success fw-bold">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </span>
                            </p>

                            <div class="d-grid d-none d-md-block w-full">
                                <button type="submit" class="btn btn-primary fw-bold rounded-3 py-2 w-100">
                                    Bayar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- Tombol Sticky di Mobile --}}
        <div class="d-md-none fixed-bottom bg-white border-top p-3 shadow-sm">
            <form id="payment-form-mobile" action="{{ route('parent.payments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <input type="hidden" id="selected_method_mobile" name="payment_method">
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                    Bayar Sekarang
                </button>
            </form>
        </div>

        <!-- Modal QR Pembayaran DANA -->
        {{-- <div class="modal fade" id="modalDana" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Bayar QRIS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <p class="text-muted mb-2">Silakan scan QR berikut untuk membayar</p>

                        <img src="/mnt/data/7195b9f6-d7bc-4dbf-820d-81ac8ae9920c.png" alt="QRIS Dummy"
                            class="img-fluid rounded" style="max-width: 250px;">

                        <a href="{{ route('parent.transaction.index') }}" class="btn btn-primary fw-bold mt-4 w-100">
        Oke, Saya Sudah Bayar
        </a>
    </div>
    </div>
    </div>
    </div> --}}

    </div>
</x-app-layout>

{{-- ======= SCRIPT ======= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const radios = document.querySelectorAll('input[name="payment_method"]');
    const hiddenInput = document.getElementById('selected_method');
    const hiddenInputMobile = document.getElementById('selected_method_mobile');

    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            hiddenInput.value = radio.value;
            hiddenInputMobile.value = radio.value;
        });
    });

    // SweetAlert validasi
    document.querySelectorAll('#payment-form, #payment-form-mobile').forEach(form => {
        form.addEventListener('submit', e => {
            if (!hiddenInput.value && !hiddenInputMobile.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Pilih metode pembayaran terlebih dahulu!',
                    confirmButtonColor: '#3085d6'
                });
            }
        });
    });

    // Efek highlight
    const paymentOptions = document.querySelectorAll('.payment-option');
    paymentOptions.forEach(option => {
        option.addEventListener('click', () => {
            paymentOptions.forEach(o => o.classList.remove('selected'));
            option.classList.add('selected');
        });
    });

</script>

{{-- <script>
    // Trigger modal ketika metode pembayaran = DANA
    document.querySelector('#payment-form').addEventListener('submit', function (e) {
        const method = document.querySelector('input[name="payment_method"]:checked')?.value;

        if (method === 'dana') {
            e.preventDefault(); // hentikan submit form
            const modal = new bootstrap.Modal(document.getElementById('modalDana'));
            modal.show();
        }
    });

    // Versi mobile
    document.querySelector('#payment-form-mobile').addEventListener('submit', function (e) {
        const method = document.querySelector('input[name="payment_method"]:checked')?.value;

        if (method === 'dana') {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('modalDana'));
            modal.show();
        }
    });

</script> --}}

@if (session('success_payment'))
<script>
    const data = @json(session('success_payment'));

    Swal.fire({
            title: '<div style="text-align:center;">Pembayaran dengan ' + data.payment_method.toUpperCase() +
                '</div>',
            html: `
        <div style="text-align:center;">
            <p class="mb-2">Kode Transaksi: <strong>${data.kode_transaksi}</strong></p>
            <p>Silakan scan QR berikut:</p>
            <img src="${data.qr_base64}" style="max-width:220px; border-radius:10px; margin-top:10px; margin:auto;">
        </div>
    `,
            confirmButtonText: 'Oke, Saya Sudah Bayar',
            width: 400,
        })
        .then(() => {
            window.location.href = "{{ route('parent.transaction.index') }}";
        });

</script>
@endif

@if (session('success_va'))
<script>
    const dataVA = @json(session('success_va'));

    Swal.fire({
        title: "Virtual Account",
        html: `
            <p>Silakan transfer ke nomor VA berikut:</p>
            <h2 style="margin-top:10px; font-weight:bold">${dataVA.va}</h2>
            <button id="okBtn" class="swal2-confirm swal2-styled" style="margin-top:20px; width:100%;">
                Oke, Saya Sudah Transfer
            </button>
        `,
        showConfirmButton: false,
        width: 380,
    });

    document.addEventListener("click", function (e) {
        if (e.target.id === "okBtn") {
            window.location.href = "{{ route('parent.transaction.index') }}";
        }
    });
</script>
@endif




@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    })
</script>
@endif

@if (session('success_cod'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: true,
    }).then( () => {
        window.location.href = "{{ route('parent.transaction.index') }}"
    });
</script>
@endif
