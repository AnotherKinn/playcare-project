<div class="modal fade" id="detailModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-body text-center px-4 py-3">

                @php
                switch ($transaction->status) {
                case 'success':
                $icon = 'bi-check-lg';
                $bgColor = 'bg-success';
                $iconColor = 'text-white';
                break;

                case 'pending_verification':
                $icon = 'bi-hourglass-split';
                $bgColor = 'bg-warning';
                $iconColor = 'text-dark';
                break;

                case 'pending':
                $icon = 'bi-clock';
                $bgColor = 'bg-info';
                $iconColor = 'text-dark';
                break;

                case 'failed':
                $icon = 'bi-x-lg';
                $bgColor = 'bg-danger';
                $iconColor = 'text-white';
                break;

                default:
                $icon = 'bi-question-lg';
                $bgColor = 'bg-secondary';
                $iconColor = 'text-white';
                break;
                }
                @endphp

                <!-- Dynamic Icon -->
                <div class="{{ $bgColor }} {{ $iconColor }} rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px;">
                    <i class="bi {{ $icon }} fs-4"></i>
                </div>


                <h5 class="fw-bold mb-2">Detail Transaksi</h5>
                <h3 class="fw-bold text-primary mb-4">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</h3>

                <!-- ====== Rincian Booking ====== -->
                <div class="text-start mx-auto mb-3" style="max-width: 360px;">
                    <h6 class="fw-bold text-secondary border-bottom pb-1 mb-2">📋 Rincian Booking</h6>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Tanggal Booking</span>
                        <span
                            class="fw-bold">{{ $transaction->booking->booking_date ? date('d M Y', strtotime($transaction->booking->booking_date)) : '-' }}</span>
                    </div>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Nama Anak</span>
                        <span class="fw-bold">{{ $transaction->booking->child->name ?? '-' }}</span>
                    </div>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Tipe Waktu</span>
                        <span class="fw-bold">
                            @if($transaction->booking->time_type === 'per_jam')
                            Per Jam
                            @elseif($transaction->booking->time_type === 'per_hari')
                            Per Hari
                            @elseif($transaction->booking->time_type === 'per_bulan')
                            Per Bulan
                            @else
                            -
                            @endif
                        </span>
                    </div>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Durasi</span>
                        <span class="fw-bold">{{ $transaction->booking->duration ?? '' }}
                            {{ $transaction->booking->time_type === 'per_jam' ? 'jam' : ($transaction->booking->time_type === 'per_hari' ? '1 hari' : 'bulan') }}</span>
                    </div>
                </div>

                <!-- ====== Informasi Pembayaran ====== -->
                <div class="text-start mx-auto" style="max-width: 360px;">
                    <h6 class="fw-bold text-secondary border-bottom pb-1 mb-2">💳 Informasi Pembayaran</h6>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Tanggal Transaksi</span>
                        <span class="fw-bold">{{ date('d M Y', strtotime($transaction->created_at)) }}</span>
                    </div>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Kode Transaksi</span>
                        <span class="fw-bold">{{ $transaction->transaction_code }}</span>
                    </div>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Metode</span>
                        <span class="fw-bold text-uppercase">{{ $transaction->payment_method ?? '-' }}</span>
                    </div>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Status</span>
                        <span class="fw-bold">
                            <span class="badge bg-{{
                                $transaction->status === 'success' ? 'success' :
                                ($transaction->status === 'pending_verification' ? 'warning' :
                                ($transaction->status === 'pending' ? 'info' : 'danger'))
                            }}">
                                {{ ucfirst($transaction->status) }}
                            </span>

                        </span>
                    </div>

                    <div class="d-flex justify-content-between small mb-1">
                        <span>Total Pembayaran</span>
                        <span
                            class="fw-bold text-primary">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-4 d-grid gap-2">
                    <button class="btn btn-primary rounded-pill py-2" data-bs-dismiss="modal">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
